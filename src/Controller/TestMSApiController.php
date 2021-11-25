<?php

namespace App\Controller;

use App\Model\MusicStoryApi;

class TestMSApiController extends AbstractController
{
    /**
     * List items
     */
    public function index(): string
    {
        $MSAPI = new MusicStoryApi(APP_API_CONSUMERKEY, APP_API_CONSUMERSECRET, APP_API_ACCESSTOKEN,
        APP_API_TOKENSECRET);

        $genre = $MSAPI->getGenre(66);

        return $this->twig->render('Genre/index.html.twig', ['genre' => $genre]);
    }
}
