<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\notification\ContactNotification;
use App\Services\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(CartService $cartService,Request $request,ContactNotification $notification)
    {


        $data= $cartService->fulCart();

        $total = 0;
        foreach($data as $item)
        {
            $totalItem = $item['produit']->getPrix()*$item['quantity'];
            $total += $totalItem;

        }

        $contact = new Contact();
        $form =$this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $notification->notify($contact);
            $this->addFlash('succes','Nous vous remercions pour votre message qui a été transmis au service de Séen Guinaar.
             Nous tentons de répondre à toutes les requêtes dans un délai de 24h. Un membre de notre équipe reviendra vers vous dans les plus brefs délais');
            return $this->redirectToRoute('contact',[
                'item' => $data,
                'total' =>$total,
                'form' => $form->createView()

            ]);
        }

        return $this->render('contact/index.html.twig', [
            'item' => $data,
            'total' =>$total,
            'form' => $form->createView()
        ]);
    }
}
