<?php

namespace App\Model;

use App\Model\AbstractManager;
use PDO;

class ArtistManager extends AbstractManager
{
    public const TABLE = "artist";

    public function add(array $params): void
    {
        $query = "INSERT INTO artist(id, name, picture) VALUES(:id, :name, :picture)";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $params["id"], \PDO::PARAM_STR);
        $stmt->bindValue(":name", $params["name"], \PDO::PARAM_STR);
        $stmt->bindValue(":picture", $params["url_400"], \PDO::PARAM_STR);

        $stmt->execute();
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

    public function selectByIdWithAlbum($id)
    {
        $query = "SELECT * FROM artist ar JOIN album al ON ar.id = al.artist_id JOIN releases re ON al.id = re.album_id WHERE ar.id = :id;";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id, \PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
