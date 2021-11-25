<?php

namespace App\Controller;

use App\Model\MusicStoryApi;
use App\Model\ArtistManager;

class ArtistController extends AbstractController
{
    public function SearchArtist(string $input)
    {
        //1) il faut voir si l'artiste existe dans la bd
        $artistManager = new ArtistManager();
        $input = "%" . $input . "%";
        $artists = $artistManager->selectByNameLike($input);

        if (empty($artists)) {
            $MSAPI = new MusicStoryApi(
                APP_API_CONSUMERKEY,
                APP_API_CONSUMERSECRET,
                APP_API_ACCESSTOKEN,
                APP_API_TOKENSECRET
            );

            $objectsResultApi = $MSAPI->searchArtist(array('name'=>$input),1,100);
            $artistForBd = [];
            foreach($objectsResultApi as $objectResultApi) {
                $artistForBd ['id'] = $objectResultApi->id;
                $artistForBd ['name'] = $objectResultApi->name;
                $artistForBd ['url_400'] = "";
                $artistManager->add($artistForBd);
            }
        } else {
            return $this->twig->render('Result/artist.html.twig', ['artists' => $artists]);
        }
    }
}
