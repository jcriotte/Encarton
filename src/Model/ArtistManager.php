<?php

namespace App\Model;

use App\Model\AbstractManager;
use PDO;

class ArtistManager extends AbstractManager
{
    public const TABLE = "artist";

    public function add($params)
    {
        $query = "INSERT INTO artist(id, name, picture) VALUES(:id, :name, :picture)";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $params["id"], \PDO::PARAM_STR);
        $stmt->bindValue(":name", $params["name"], \PDO::PARAM_STR);
        $stmt->bindValue(":picture", $params["url_400"], \PDO::PARAM_STR);

        $stmt->execute();

        return $this->pdo->lastInsertId();
    }
}
