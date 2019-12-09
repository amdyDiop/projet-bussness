<?php

namespace App\Controller;

use App\Entity\Boutique;
use App\Entity\Produit;
use App\Form\Produit1Type;
use App\Repository\ProduitRepository;
use App\Services\Cart\CartService;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/produit")
 */
class ProduitController extends AbstractController
{


    /**
     * @var ProduitRepository
     */
    private $em;
    private $repository;

    public function __construct(ProduitRepository $repository,ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em  = $em;
    }
    /**
     * @Route("/", name="produit_index", methods={"GET"})
     */
    public function index(ProduitRepository $produitRepository,CartService $cartService,PaginatorInterface $pagination,Request $request): Response
    {

        $data= $cartService->fulCart();

        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }
        $produitfilter = $pagination->paginate(
            $produitRepository->findAll(),
            $request->query->getInt('page',1),12);

        return $this->render('admin/produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
            'produit' => $produitfilter,
            'item' => $data,
            'total' =>$total
        ]);
    }

    /**
     * @Route("/new", name="produit_new", methods={"GET","POST"})
     */
    public function new(Request $request,CartService $cartService): Response
    {
        $produit = new Produit();
        $form = $this->createForm(Produit1Type::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($produit);
            $entityManager->flush();



            return $this->redirectToRoute('produit_index');
        }

        $data= $cartService->fulCart();

        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }

        return $this->render('admin/produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
            'item' => $data,
            'total' =>$total
        ]);
    }

    /**
     * @Route("/addProduitBoutique/{id}", name="add_produit_boutique", methods={"GET","POST"})
     */
    public function addProduitBoutique(Request $request,CartService $cartService,Boutique $boutique): Response
    {
        $produit = new Produit();
        $form = $this->createForm(Produit1Type::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $produit->setCreatedAt(new \ DateTime());
            $produit->setBoutique($boutique);
            $produit->setStock($produit->getStockinit());
            $entityManager->flush();
            return $this->redirectToRoute('shop');
        }

        $data= $cartService->fulCart();

        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }

        return $this->render('admin/produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
            'item' => $data,
            'total' =>$total
        ]);
    }

    /**
     * @Route("/{id}", name="crud_produit_show", methods={"GET"})
     */
    public function show(Produit $produit,CartService $cartService): Response
    {
        $data= $cartService->fulCart();

        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }
        return $this->render('admin/produit/show.html.twig', [
            'produit' => $produit,
            'item' => $data,
            'total' =>$total
        ]);
    }

    /**
     * @Route("/{id}/edit", name="produit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Produit $produit,CartService $cartService): Response
    {
        $form = $this->createForm(Produit1Type::class, $produit);
        $form->handleRequest($request);

        $data= $cartService->fulCart();

        $total = 0;
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
           // $this->addFlash('success', 'votre produit a été modifié avec succès');
            return $this->redirectToRoute('shop');
        }


        return $this->render('admin/produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
            'item' => $data,
            'total' =>$total
        ]);
    }

    /**
     * @Route("/{id}", name="produit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Produit $produit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produit_index');
    }
}
