<?php

namespace App\Controller;

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
use App\Services\Cart\CartService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/shop", name="shop")
     */
    public function index(Request $request,PaginatorInterface $paginator ,BoutiqueRepository $repository,CartService $cartService,BoutiqueRepository $boutiqueRepository)
    {

        $search = new PropertySearch();
        $form = $this->createForm(PropertySeachType::class,$search);
        $form->handleRequest($request);
        $boutique = $paginator->paginate(
            $repository->findAllBoutique($search),
            $request->query->getInt('page',1),12);
        $data= $cartService->fulCart();
        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }
        return $this->render('shop/index.html.twig', [
            'boutiques' => $boutique,
            'item' => $data,
            'total' =>$total,
            'form' => $form->createView()

        ]);
    }
    /**
     * @Route("/shop/{slug}-{id}",name="shop_show",requirements={"slug": "[a-z0-9\-]*"} )
     * @return Response
     */
    public  function  show(Boutique $boutique, string $slug, ContactNotification $notification, Request $request, CartService $cartService,BoutiqueRepository $boutiqueRepository) :Response
    {
        if ($boutique->getSlug() !==$slug)
        {
            return  $this->redirectToRoute('shop_show',[
                'id' => $boutique->getId(),
                'slug' => $boutique->getSlug()
            ],301);
        }
        $data= $cartService->fulCart();
        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;
        }
        return  $this->render('shop/show.html.twig',[
            'boutiques' => $boutique,
            'produits' =>$boutique->getProduits(),
            'item' => $data,
            'total' =>$total
        ]);


    }




}
