<?php

namespace App\Controller;

use App\Repository\BoutiqueRepository;
use App\Services\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
