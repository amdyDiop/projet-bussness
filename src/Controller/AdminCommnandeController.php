<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Repository\BoutiqueRepository;
use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use App\Services\Cart\CartService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class AdminCommnandeController extends AbstractController
{



    /**
     * @var CommandeRepository
     */
    private $em;
    private $repository;
    protected $session;

    public function __construct(SessionInterface $session, CommandeRepository $repository,ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em  = $em;
        $this->session = $session;

    }
    /**
     * @Route("/admin/commnande", name="admin_commnande_list")
     */
    public function index(CommandeRepository $commandeRepository , CartService $cartService ,ProduitRepository $produitRepository)
    {


        return $this->render('admin/admin_commnande/index.html.twig', [
            'commande' => $commandeRepository->findAll()

        ]);
    }

    /**
     * @Route("/admin/commnande/{id}", name="admin_commnande_show")
     */
    public function show(CommandeRepository $commandeRepository , CartService $cartService ,ProduitRepository $produitRepository)
    {

        $commande=$commandeRepository->findAll();

        return $this->render('admin/admin_commnande/show.html.twig', [
            'commande' => $commandeRepository->findAll()


        ]);
    }
}
