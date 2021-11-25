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
}