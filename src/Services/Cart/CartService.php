<?php

namespace App\Service\Cart;
use App\Repository\ProductRepository;
use  Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    protected $session;
     protected $repository;
    public function __construct(SessionInterface $session,  ProductRepository $repository) {
        $this->session = $session;
        $this->repository= $repository;
    }
     
    public function add(int $id)
    {
         $panier = $this->session->get('panier',[]);
    if(!empty($panier[$id]))
        $panier[$id]++;
 else
        $panier[$id]= 1;
 
    $this->session->set('panier',$panier);
    }
   
    public function remove(int $id)
    {
         $panier = $this->session->get('panier',[]);
        if(!empty($panier[$id]))
        {
            unset($panier[$id]);
        }
        $this->session->set('panier',$panier);
    }
   
    public function fulCart():array
    {
         $panier = $this->session->get('panier',[]);
        $data= [];
        foreach($panier as $id => $quantity)
        {
            $data[]= [
                'product' => $this->repository->find($id),
                'quantity' => $quantity
            ];
    }  
    return $data;
  }
}
