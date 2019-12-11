<?php

namespace App\Controller;

use App\Entity\Boutique;
use App\Form\BoutiqueType;
use App\Repository\BoutiqueRepository;
use App\Services\Cart\CartService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/boutique")
 */
class BoutiqueController extends AbstractController
{
    /**
     * @Route("/", name="boutique_index", methods={"GET"})
     */
    public function index(BoutiqueRepository $boutiqueRepository,Request $request,CartService $cartService,PaginatorInterface $pagination): Response
    {
        $boutiquePag  = $pagination->paginate(
            $boutiqueRepository->findAll(),
            $request->query->getInt('page',1),16);
        $data= $cartService->fulCart();

        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }
        return $this->render('admin/boutique/index.html.twig', [
            'boutiques' => $boutiqueRepository->findAll(),
            'item' => $data,
            'boutiquePag'=>$boutiquePag,
            'total' =>$total
        ]);
    }

    /**
     * @Route("/new", name="boutique_new", methods={"GET","POST"})
     */
    public function new(Request $request,CartService $cartService): Response
    {
        $boutique = new Boutique();
        $form = $this->createForm(BoutiqueType::class, $boutique);
        $form->handleRequest($request);
        $data= $cartService->fulCart();

        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($boutique);
            $entityManager->flush();

            return $this->redirectToRoute('boutique_index');
        }

        return $this->render('admin/boutique/new.html.twig', [
            'boutique' => $boutique,
            'form' => $form->createView(),
            'item' => $data,
            'total' =>$total
        ]);
    }

    /**
     * @Route("/{id}", name="boutique_show", methods={"GET"})
     */
    public function show(Boutique $boutique,CartService $cartService ): Response
    {
        $data= $cartService->fulCart();

        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }
        return $this->render('admin/boutique/show.html.twig', [
            'boutique' => $boutique,
            'item' => $data,
            'total' =>$total
        ]);
    }

    /**
     * @Route("/{id}/edit", name="boutique_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Boutique $boutique,CartService $cartService): Response
    {
        $form = $this->createForm(BoutiqueType::class, $boutique);
        $form->handleRequest($request);
        $data= $cartService->fulCart();

        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('boutique_index');
        }

        return $this->render('admin/boutique/edit.html.twig', [
            'boutique' => $boutique,
            'form' => $form->createView(),
            'item' => $data,
            'total' =>$total
        ]);
    }

    /**
     * @Route("/{id}", name="boutique_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Boutique $boutique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$boutique->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($boutique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('boutique_index');
    }
}
