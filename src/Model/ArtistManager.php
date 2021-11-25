<?php

namespace App\Model;

use App\Model\AbstractManager;
use PDO;

class ArtistManager extends AbstractManager
{
    public const TABLE = "artist";

    public function add(array $params)
    {
        $query = "INSERT INTO artist(id, name, picture) VALUES(:id, :name, :picture)";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $params["id"], \PDO::PARAM_STR);
        $stmt->bindValue(":name", $params["name"], \PDO::PARAM_STR);
        $stmt->bindValue(":picture", $params["url_400"], \PDO::PARAM_STR);

        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

    public function selectByNameLike(string $input, string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE . ' WHERE name LIKE :input';
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":input", $input, \PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
