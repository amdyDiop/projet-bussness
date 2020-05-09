<?php


namespace App\Controller;
use App\Entity\Commande;
use App\Entity\Produit;
use App\Entity\User;
use App\Form\Produit1Type;
use App\Repository\BoutiqueRepository;
use App\Repository\CommandeRepository;
use App\Repository\UserRepository;
use \App\Services\Cart\CartService;
use App\Repository\ProduitRepository;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use  Symfony\Component\HttpFoundation\Session\SessionInterface;


class AdminController extends AbstractController
{

    /**
     * @Route("/admin", name="admin")
     */
    public function index(BoutiqueRepository $boutiqueRepository,CommandeRepository $commandeRepository, UserRepository $userRepository,ProduitRepository $produitRepository): Response
    {

        if ($this->getUser()== null)
            return $this->redirectToRoute('login');


        $nombreBoutique= count($boutiqueRepository->findAll());
        $nombredeVente= count($commandeRepository->findAll());
        $nombreUser= count($userRepository->findAll());
        $nombreProduit= count($produitRepository->findAll());
        return $this->render('admin/index.html.twig',[
            'produits' => $produitRepository->findAll(),
            'commande' =>$commandeRepository->findAll(),
            'newBoutique'=>$boutiqueRepository->findAll(),
            'newProduit'=>$produitRepository->findNEW(),
            'nombreProduit'=> $nombreProduit,
            'nombreUser' =>$nombreUser,
            'vente'=>$nombredeVente,
            'nombreBoutique'=> $nombreBoutique,
            'users' =>$userRepository->findAll()

        ]);


    }


    /**
     * @Route("/produit/{id}", name="admin_produit_edit", methods={"GET","POST"})
     */
    public function adminProduitEdit(Request $request, Produit $produit): Response
    {
        $form = $this->createForm(Produit1Type::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
           // $this->addFlash('success', 'votre produit a été modifié avec succès');
            return $this->redirectToRoute('admin');
        }


        return $this->render('admin/adminProduitEdit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),

        ]);
    }


    /**
     * @Route("/vente", name="admin_vente", methods={"GET","POST"})
     */

    public function vente(CommandeRepository $commandeRepository , CartService $cartService ,ProduitRepository $produitRepository)
    {


        return $this->render('admin/vente/venteIndex.html.twig', [
            'commande' => $commandeRepository->findAll()

        ]);
    }
}