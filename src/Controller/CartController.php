<?php

namespace App\Controller;
use App\Entity\Commande;
use App\Entity\User;
use App\Repository\CommandeRepository;
use \App\Services\Cart\CartService;
use App\Repository\ProduitRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use  Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class CartController extends AbstractController
{



    /**
     * @var CommandeRepository
     */
    private $em;
    private $repository;
    protected $session;

    public function __construct(SessionInterface $session, CommandeRepository $repository,ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em  = $em;
        $this->session = $session;

    }
    /**
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(CartService $cartService )
    {
        $data= $cartService->fulCart();

        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }

        return $this->render('cart/index.html.twig', [
            'item' => $data,
            'total' =>$total

        ]);
    }

    /**
     * @Route("/panier/add/{id}",name="cart_add")
     */
    public  function add($id ,Request $request, CartService  $cartService)
    {
        $cartService->add($id);
        return $this->redirectToRoute("home");

    }
    /**
     *
     * @Route("/panier/remove/{id}",name="cart_remove")
     *
     */
    public function remove($id, CartService $cartService)
    {

        $data= $cartService->fulCart();

        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }

        $cartService->remove($id);
        return $this->redirectToRoute("cart_index");

    }



    /**
     *
     * @Route("/panier/finaliser/",name="finaliser_commande")
     *
     */
    public function finaliserCommande(CartService $cartService ,ProduitRepository $produitRepository )

    {
        $data= $cartService->fulCart();

        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }


        $commande = new Commande();

        foreach($data as $item)
        {
            $commande->addProduit($item['produit']) ;
        }
        if ($this->getUser()!= null){
            $commande->setTht($total);
            $commande->setDateCommande(new \ DateTime());
            $commande->addUser( $this->getUser());

            $numeroCommande =$commande->getId();
            $numeroCommande++;
            $commande->setNumcommande($numeroCommande);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commande);
            $entityManager->flush();
          $data=[];
          $total=0;
            $this->addFlash('success', 'merci d\'avoir complété votre paiement en ligne. Vous recevez votre commande dans sous peut');
        }


        else
            return $this->redirectToRoute('login');
        return $this->render('home/home.html.twig',[
            'item' => $data,
            'total' =>$total,
            'produits' =>$produitRepository->findlast()
        ]);


}
}