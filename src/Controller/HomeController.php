<?php
    namespace App\Controller;


    use App\Repository\BoutiqueRepository;
    use App\Repository\ProduitRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use \App\Services\Cart\CartService;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

    class HomeController extends  AbstractController
    {
        private $repository;

        /**
         * @Route("/",name="home")
         * @param ProduitRepository $repository
         * @return Response
         */
        public function home(ProduitRepository $repository,CartService $cartService ,BoutiqueRepository $boutiqueRepository)
    {

        $data= $cartService->fulCart();
        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;
        }
        $produits = $repository->findlast();
  //dd($produits);
          return $this->render('home/home.html.twig',[
                'topBoutique' => $boutiqueRepository->marchand(),
                'produits' => $produits ,
                'top1Produit' =>$repository->topProduit1(),
                'top2Produit' =>$repository->topProduit2(),
                'item' => $data,
                'total' =>$total
              ]) ;
    }
        /**
         * @Route("/amdy", name="cvAmdy")
         * @return Response
         */
        public function cv(ProduitRepository $repository)
        {

            return $this->render('Cv/CV.html.twig' );
        }
        /**
         *
         * @Route("/promotions",name="promos" ,methods={"GET", "POST"})
         *
         */


         public function promos(CartService $cartService )
        {


            $data= $cartService->fulCart();
            $total = 0;
            foreach($data as $item)
            {
                $totalItem = $item['produit']->getPrix()*$item['quantity'];
                $total += $totalItem;
            }
            return $this->render('home/promos.html.twig',[
                'item' => $data,
                'total' =>$total

            ]);

        }


    }


