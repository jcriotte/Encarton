<?php

namespace App\Controller;

use App\Model\AlbumManager;
use App\Model\MusicStoryApi;
use App\Model\ArtistManager;
use App\Model\ReleasesManager;

class ArtistController extends AbstractController
{
    public function SearchArtist(string $input)
    {
        //1) il faut voir si l'artiste existe dans la bd
        $artistManager = new ArtistManager();
        $input = "%" . $input . "%";
        //$artists = $artistManager->selectByNameLike($input);

        if (empty($artists)) {
            $albumManager = new AlbumManager;
            $releasesManager = new ReleasesManager;
            $MSAPI = new MusicStoryApi(
                APP_API_CONSUMERKEY,
                APP_API_CONSUMERSECRET,
                APP_API_ACCESSTOKEN,
                APP_API_TOKENSECRET
            );

            $artistsResultApi = $MSAPI->searchArtist(array('name' => $input), 1, 100);

            $artistForBd = [];
            foreach ($artistsResultApi as $artistResultApi) {
                $artistForBd['id'] = $artistResultApi->id;
                $artistForBd['name'] = $artistResultApi->name;
                $artistForBd['url_400'] = "";
                try {
                    $artistManager->add($artistForBd);
                } catch (\Exception $e) {
                    continue;
                }
                
                $releasesResultApi = $MSAPI->searchRelease(array('artist' => $artistForBd['id'], 'support' => 'LP'), 1, 100);
                foreach ($releasesResultApi as $releaseResultApi) {
                    if (!$albumManager->selectOneById($releaseResultApi->id_album)) {
                        $albumForBd['id'] = $releaseResultApi->id_album;
                        $albumForBd['title'] = $releaseResultApi->title;
                        $albumForBd['artist_id'] = $artistForBd['id'];
                        $albumForBd['year'] = "";
                        try {
                            $albumManager->add($albumForBd);
                        } catch (\Exception $e) {
                            continue;
                        }      
                    }
                    if (!$releasesManager->selectOneById($releaseResultApi->id)) {
                        $releaseForBd['id'] = $releaseResultApi->id;
                        $releaseForBd['album_id'] = $releaseResultApi->id_album;
                        $releaseForBd['support'] = $releaseResultApi->support;
                        $releaseForBd['year'] = $releaseResultApi->publication_date;
                        $releaseForBd['picture'] = "";
                        $releaseForBd['deezer_url'] = "";
                        try {
                            $releasesManager->add($releaseForBd);
                        } catch (\Exception $e) {
                            continue;
                        }
                    }
                }
            }
        } else {
            return "" ;//$this->twig->render('Result/artist.html.twig', ['artists' => $artists]);
        }
    }
}
