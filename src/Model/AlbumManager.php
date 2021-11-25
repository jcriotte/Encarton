<?php

namespace App\Model;

use App\Model\AbstractManager;

class AlbumManager extends AbstractManager
{
    public const TABLE = "album";

    public function add($params)
    {
        $query = "INSERT INTO album(id, title, artist_id, year) 
        VALUES(:id, :title, :artist_id, :year)";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $params["id"], \PDO::PARAM_STR);
        $stmt->bindValue(":title", $params["title"], \PDO::PARAM_STR);
        $stmt->bindValue(":artist_id", $params["artist_id"], \PDO::PARAM_INT);
        $stmt->bindValue(":year", $params["year"], \PDO::PARAM_INT);

        $stmt->execute();

        return $this->pdo->lastInsertId();
    }
}
