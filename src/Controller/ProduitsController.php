<?php
namespace  App\Controller;
use App\Entity\Produit;
use App\Entity\PropertySearch;
use App\Form\PropertySeachType;
use App\notification\ContactNotification;
use App\Repository\ProduitRepository;
use App\Services\Cart\CartService;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class ProduitsController extends  AbstractController
{
    /**
     * @var ProduitRepository
     */
    private $em;
    private $repository;
    public function __construct(ProduitRepository $repository,ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em  = $em;
    }


    /**
     * @Route("/panier/add/{id}",name="cart_add")
     */
    public  function add($id ,Request $request, CartService  $cartService)
    {
        $cartService->add($id);
        return $this->redirectToRoute("produits");

    }
    /**
     * @Route("/produits", name="produits")
     *
     *
     */
    public function index(PaginatorInterface $pagination, ProduitRepository  $repository,Request $request,CartService $cartService):Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySeachType::class,$search);
        $form->handleRequest($request);
        $produits = $pagination->paginate(
            $repository->findAllProduit($search),
            $request->query->getInt('page',1),12);
        $data= $cartService->fulCart();
        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;
        }
        return $this->render('produits/index.html.twig',[
            'produits' => $produits,
            'totalP' => count($repository->findAll()),
            'form' => $form->createView(),
            'item' => $data,
            'total' =>$total,
            'best' =>$repository->best()
        ]);
    }
    /**
     * @Route("/produits/{slug}-{id}",name="produit_show",requirements={"slug": "[a-z0-9\-]*"} )
     * @return Response
     */
    public  function  show(Produit $produits,string $slug,ContactNotification $notification,Request $request,CartService $cartService ) :Response
    {
        if ($produits->getSlug() !==$slug)
        {
            return  $this->redirectToRoute('produit_show',[
                'id' => $produits->getId(),
                'slug' => $produits->getSlug()
            ],301);
        }
        $data= $cartService->fulCart();
        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;
        }

        return  $this->render('produits/show.html.twig',[
            'produits' => $produits,
            'item' => $data,
            'total' =>$total
        ]);
    }
}