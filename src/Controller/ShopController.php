<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Contact;
use App\Entity\Boutique;
use App\Entity\Produit;
use App\Form\PropertySeachType;
use\App\Form\PropertySearchType;
use App\Form\BoutiqueType;
use App\Form\ContactType;
use App\Form\Produit1Type;
use App\Entity\PropertySearch;
use App\notification\ContactNotification;
use App\Repository\BoutiqueRepository;
use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use App\Services\Cart\CartService;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{





    /**
     * @var CommandeRepository
     */
    private $em;
    private $repository;
    protected $session;

    public function __construct(SessionInterface $session, CommandeRepository $commandeRepository,ObjectManager $em)
    {
        $this->repository = $commandeRepository;
        $this->em  = $em;
        $this->session = $session;

    }
    /**
     * @Route("/shop", name="shop")
     */
    public function index(Request $request,PaginatorInterface $paginator ,  ProduitRepository $produitRepository,BoutiqueRepository $repository,CartService $cartService,BoutiqueRepository $boutiqueRepository)
    {

        $search = new PropertySearch();
        $form = $this->createForm(PropertySeachType::class,$search);
        $form->handleRequest($request);
        $boutique = $paginator->paginate(
            $repository->findAllBoutique($search),
            $request->query->getInt('page',1),8);
        $data= $cartService->fulCart();
        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }
        return $this->render('shop/index.html.twig', [
            'boutiques' => $boutique,
            'nbBoutique'=>count($boutiqueRepository->findAll()),
            'item' => $data,
            'total' =>$total,
            'form' => $form->createView(),
            'best'=> $produitRepository->best()

        ]);
    }
    /**
     * @Route("/shop/{slug}-{id}",name="shop_show",requirements={"slug": "[a-z0-9\-]*"} )
     * @return Response
     */
    public  function  show(PaginatorInterface $paginator,Boutique $boutique, string $slug, Request $request, CartService $cartService,ProduitRepository $produitRepository) :Response
    {
        if ($boutique->getSlug() !==$slug)
        {
            return  $this->redirectToRoute('shop_show',[
                'id' => $boutique->getId(),
                'slug' => $boutique->getSlug()
            ],301);
        }

        $search = new PropertySearch();
        $form = $this->createForm(PropertySeachType::class,$search);
        $form->handleRequest($request);
        $produit = $paginator->paginate(
            $produitRepository->findAllProduit($search),
            $request->query->getInt('page',1),8);

        $data= $cartService->fulCart();
        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;
        }
        return  $this->render('shop/show.html.twig',[
            'boutiques' => $boutique,
            'prosuit'=>$produit,
            'produits' =>$boutique->getProduits(),
            'item' => $data,
            'total' =>$total,
            'form'=>$form->createView(),

        ]);


    }


    /**
     * @Route("/{id}/edit", name="shop_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Boutique $boutique,CartService $cartService): Response
    {
        $form = $this->createForm(BoutiqueType::class, $boutique);
        $form->handleRequest($request);
        $data= $cartService->fulCart();

        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shop');
        }

        return $this->render('shop/edit.html.twig', [
            'boutique' => $boutique,
            'form' => $form->createView(),
            'item' => $data,
            'total' =>$total
        ]);
    }


    /**
     * @Route("/shop//detailCommande/{id}", name="detail_commande", methods={"GET"})
     *
     */
    public function detaiCommande(CommandeRepository $commandeRepository ,CartService $cartService)
    {


        $data= $cartService->fulCart();

        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }

        return $this->render('shop/comande.html.twig', [
            'commandes' => $commandeRepository->findAll(),
            'item' => $data,
            'total' =>$total
        ]);
    }

}
