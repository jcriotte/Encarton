<?php

namespace App\Controller;

class ResultController extends AbstractController
{
    public function artist()
    {
        return $this->twig->render('Result/artist.html.twig');
    }

    public function album()
    {
        return $this->twig->render('Result/album.html.twig');
    }

    public function contact()
    {
        $message = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $messages [] = "Merci pour votre message !";
            return $this->twig->render('Item/contact.html.twig',['messages' => $messages]);
        }
        return $this->twig->render('Item/contact.html.twig');
    }
}
