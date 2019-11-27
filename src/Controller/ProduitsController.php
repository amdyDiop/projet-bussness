<?php

namespace  App\Controller;

 use App\Entity\Produit;
 use App\Entity\PropertySearch;
 use App\Form\ContactType;
 use App\Entity\Contact;
 use App\Form\PropertySearchType;
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
      * @Route("/produits", name="produits")
      *
      *
      */
     public function index(PaginatorInterface $pagination,Request $request,CartService $cartService):Response
     {
         $search = new PropertySearch();
         $form = $this->createForm(PropertySearchType::class,$search);
         $form->handleRequest($request);
        $produits = $pagination->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page',1),
             12
        );
         $data= $cartService->fulCart();

         $total = 0;
         foreach($data as $item)
         {
             $totalItem = $item['produit']->getPrix()*$item['quantity'];
             $total += $totalItem;

         }


         return $this->render('produits/index.html.twig',[
             'produits' => $produits,
             'form' => $form->createView(),
             'item' => $data,
             'total' =>$total
         ]);

     }

     /**
      * @Route("/produit/{slug}-{id}",name="produit_show",requirements={"slug": "[a-z0-9\-]*"} )
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

         $contact = new  Contact();
         $contact->setProduit($produits);
         $form = $this->createForm(ContactType::class,$contact);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()){
             $notification->notify($contact);
             $this->addFlash('success','votre email a bien été envoyé');
             return  $this->redirectToRoute('produit_show',[
                 'id' => $produits->getId(),
                 'slug' => $produits->getSlug(),
                 'item' => $data,
                 'total' =>$total
             ]);
         }

         $contact = new  Contact();
         $contact->setProduit($produits);
         $form = $this->createForm(ContactType::class,$contact);


         return  $this->render('produits/show.html.twig',[
             'produits' => $produits,
             'form'  =>$form->createView(),
             'item' => $data,
             'total' =>$total
         ]);
     }

 }
