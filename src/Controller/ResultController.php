<?php

namespace App\Controller;

use App\Model\ArtistManager;

class ResultController extends AbstractController
{
    public function artist($id)
    {
        $artistManager = new ArtistManager();
        $result = $artistManager->selectByIdWithAlbum($id);

        $artist['name'] = $result[0]['name'];
        $artist['id'] = $result[0]['artist_id'];

        return $this->twig->render('Result/artist.html.twig', ["artist" => $artist, "albums" => $result]);
    }

    public function album($id)
    {
        return $this->twig->render('Result/album.html.twig');
    }

    public function contact()
    {
        $messages = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $messages[] = "Merci pour votre message !";
            return $this->twig->render('Item/contact.html.twig', ['messages' => $messages]);
        }
        return $this->twig->render('Item/contact.html.twig');
    }
}
