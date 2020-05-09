<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use App\Services\Cart\CartService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/admin/commande/{id}", name="admin_commnande_show", methods={"GET"})
     */
    public function show(Commande $commande,ProduitRepository $produitRepository)
    {

        return $this->render('admin/admin_commnande/show.html.twig', [
            'commande' => $commande,


        ]);
    }

    /**
     * @Route("/admin/commande/edit/{id}/", name="admin_commande_edit", methods={"GET","POST"})
     */
    public function edit(Request $request ,Commande $commande ):Response
    {
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            // $this->addFlash('success', 'votre produit a été modifié avec succès');
            return $this->redirectToRoute('admin_commnande_list');
        }


        return $this->render('admin/admin_commnande/edit.html.twig', [
            'form' => $form->createView(),
            'commande' => $commande
        ]);
    }
}
