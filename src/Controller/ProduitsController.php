<?php

namespace  App\Controller;

 use App\Entity\Property;
 use App\Entity\PropertySearch;
 use App\Form\ContactType;
 use App\Entity\Contact;
 use App\Form\PropertySearchType;
 use App\notification\ContactNotification;
 use App\Repository\PropertyRepository;
 use Doctrine\Common\Persistence\ObjectManager;
 use Knp\Component\Pager\PaginatorInterface;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Annotation\Route;

 class MaisonController extends  AbstractController
 {
     /**
      * @var PropertyRepository
      */
     private $em;
     private $repository;

     public function __construct(PropertyRepository $repository,ObjectManager $em)
     {
         $this->repository = $repository;
         $this->em  = $em;
     }


     /**
      * @Route("/produits", name="produits")
      *
      *
      */
     public function produits(PaginatorInterface $pagination,Request $request):Response
     {
         $search = new PropertySearch();
         $form = $this->createForm(PropertySearchType::class,$search);
         $form->handleRequest($request);
        $property = $pagination->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page',1),
             12
        );

         return $this->render('pages/maison.html.twig',[
             'properties' => $property,
             'form' => $form->createView()
         ]);

     }

     /**
      * @Route("/maison{slug}-{id}",name="page_view",requirements={"slug": "[a-z0-9\-]*"} )
      * @return Response
      */
     public  function  view(Property $property,string $slug,ContactNotification $notification,Request $request) :Response
     {
         if ($property->getSlug() !==$slug)
         {
         return  $this->redirectToRoute('page_view',[
             'id' => $property->getId(),
             'slug' => $property->getSlug()
         ],301);
             }

         $contact = new  Contact();
         $contact->setProperty($property);
         $form = $this->createForm(ContactType::class,$contact);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()){
             $notification->notify($contact);
             $this->addFlash('success','votre email a bien été envoyé');
             return  $this->redirectToRoute('page_view',[
                 'id' => $property->getId(),
                 'slug' => $property->getSlug()
             ]);
         }

         $contact = new  Contact();
         $contact->setProperty($property);
         $form = $this->createForm(ContactType::class,$contact);


         return  $this->render('pages/view.html.twig',[
             'property' => $property,
             'form'  =>$form->createView()
         ]);
     }

 }
