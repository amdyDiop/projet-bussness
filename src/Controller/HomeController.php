<?php
    namespace App\Controller;


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
        public function home(ProduitRepository $repository,CartService $cartService )
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
                'produits' => $produits ,
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
         * @Route("/login",name="login" ,methods={"GET", "POST"})
         *
         */

       /**
        *
        * public function login(AuthenticationUtils $authenti)
        {
            $lastuser =$authenti->getLastUsername();
            $error= $authenti->getLastAuthenticationError();
            return $this->render('pages/login.html.twig',[
                'user' => $lastuser,
                'error' =>$error
            ]);

        }
**/


    }


