<?php

namespace App\Controller;
use \App\Services\Cart\CartService;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use  Symfony\Component\HttpFoundation\Session\SessionInterface;


class FinaliserController extends AbstractController
{
    /**
     * @Route("/finaliser", name="finaliser")
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

        return $this->render('finaliserComande/index.html.twig', [
            'item' => $data,
            'total' =>$total

        ]);
    }

}
