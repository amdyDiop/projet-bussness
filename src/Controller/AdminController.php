<?php


namespace App\Controller;
use App\Entity\User;
use App\Repository\BoutiqueRepository;
use App\Repository\UserRepository;
use \App\Services\Cart\CartService;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use  Symfony\Component\HttpFoundation\Session\SessionInterface;


class AdminController extends AbstractController
{

    /**
     * @Route("/admin", name="admin")
     */
    public function index(BoutiqueRepository $boutiqueRepository, UserRepository $userRepository,ProduitRepository $produitRepository): Response
    {
        $nombreBoutique= count($boutiqueRepository->findAll());
        $nombreUser= count($userRepository->findAll());
        $nombreProduit= count($produitRepository->findAll());


        return $this->render('admin/index.html.twig',[
            'produits' => $produitRepository->findAll(),
            'newBoutique'=>$boutiqueRepository->findNEW(),
            'newProduit'=>$produitRepository->findNEW(),
            'nombreProduit'=> $nombreProduit,
            'nombreUser' =>$nombreUser,
            'nombreBoutique'=> $nombreBoutique,
            'users' =>$userRepository->findAll()

        ]);


    }


}