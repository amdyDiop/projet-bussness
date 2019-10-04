<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dofbi/admin")
 */
class PropertyController extends AbstractController
{
    /**
     * @Route("/", name="property_index", methods={"GET"})
     */
    public function index(PropertyRepository $repository,PaginatorInterface $pagination,Request $request): Response
    {

        $property = $pagination->paginate(
        $repository->findAll(),
            $request->query->getInt('page',1),
            12
        );
        return $this->render('property/index.html.twig', [
            'properties' => $property
        ]);
    }

    /**
     * @Route("/new", name="property_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($property);
            $entityManager->flush();

            return $this->redirectToRoute('property_index');
        }

        return $this->render('property/new.html.twig', [
            'property' => $property,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="property_show", methods={"GET"})
     */
    public function show(Property $property): Response
    {
        return $this->render('property/show.html.twig', [
            'property' => $property,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="property_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Property $property): Response
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('property_index');
        }

        return $this->render('property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="property_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Property $property): Response
    {
        if ($this->isCsrfTokenValid('delete'.$property->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($property);
            $entityManager->flush();
        }

        return $this->redirectToRoute('property_index');
    }
}
