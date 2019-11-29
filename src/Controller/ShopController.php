<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Boutique;
use App\Form\ContactType;
use App\notification\ContactNotification;
use App\Repository\BoutiqueRepository;
use App\Services\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/shop", name="shop")
     */
    public function index(CartService $cartService,BoutiqueRepository $boutiqueRepository)
    {
        $data= $cartService->fulCart();
        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }
        return $this->render('shop/index.html.twig', [
            'boutiques' => $boutiqueRepository->findAll(),
            'item' => $data,
            'total' =>$total

        ]);
    }
    /**
     * @Route("/shop/{slug}-{id}",name="shop_show",requirements={"slug": "[a-z0-9\-]*"} )
     * @return Response
     */
    public  function  show(Boutique $boutique,string $slug,ContactNotification $notification,Request $request,CartService $cartService ) :Response
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
