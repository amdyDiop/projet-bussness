<?php
    namespace App\Controller;


    use App\Repository\PropertyRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

    class HomeController extends  AbstractController
    {
        private $repository;

        /**
         * @Route("/",name="home")
         * @param PropertyRepository $repository
         * @return Response
         */
        public function home(PropertyRepository $repository)
    {
        $properties = $repository->findlast();
          return $this->render('pages/home.html.twig',[
                'properties' => $properties
              ]) ;
    }

        /**
         * @Route("/cv", name="cv")
         * @return Response
         */
        public function cv(PropertyRepository $repository)
        {
            $properties = $repository->findlast();
            return $this->render('pages/CV.html.twig') ;
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


