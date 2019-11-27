<?php

namespace App\Controller;
use \App\Services\Cart\CartService;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use  Symfony\Component\HttpFoundation\Session\SessionInterface;


class CartController extends AbstractController
{
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
    public  function add($id , CartService  $cartService)
    {
        $cartService->add($id);
        return $this->redirectToRoute("cart_index");

    }
    /**
     *
     * @Route("/panier/remove/{id}",name="cart_remove")
     *
     */
    public function remove($id, CartService $cartService)
    {
        $cartService->remove($id);
        return $this->redirectToRoute("cart_index");

    }


}
