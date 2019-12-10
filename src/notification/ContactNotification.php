<?php
namespace App\notification;
use App\Entity\Contact;
use Twig\Environment;

class ContactNotification{


    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $env;

    public function __construct(\Swift_Mailer $mailer, Environment $env)
    {

        $this->mailer = $mailer;
        $this->env = $env;
    }

    public  function notify(Contact $contact)
    {
        $message =(new \Swift_Message('guinar : ' ))
            ->setFrom('bouletontu@mourid.com')
            ->setTo('amdymila@gmail.com')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->env->render('contact/email.html.twig',[
                'contact' => $contact

            ]), 'text/html');
        $this->mailer->send($message);



    }

}