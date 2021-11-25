<?php

namespace App\Model;

use App\Model\AbstractManager;

class AlbumManager extends AbstractManager
{
    public const TABLE = "album";

    public function add(array $params): void
    {
        $query = "INSERT INTO album(id, title, artist_id, year) 
        VALUES(:id, :title, :artist_id, :year)";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $params["id"], \PDO::PARAM_STR);
        $stmt->bindValue(":title", $params["title"], \PDO::PARAM_STR);
        $stmt->bindValue(":artist_id", $params["artist_id"], \PDO::PARAM_INT);
        $stmt->bindValue(":year", $params["year"], \PDO::PARAM_INT);

        $stmt->execute();
    }

    public function selectByArtist(int $artistId)
    {
        $query = "SELECT * FROM " . static::TABLE . " JOIN releases ON album_id=album.id WHERE artist_id = :artistId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":artistId", $artistId, \PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
