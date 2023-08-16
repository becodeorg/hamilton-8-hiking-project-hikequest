<?php
declare(strict_types=1);

namespace Models;

use PDO;

class Hike extends Database
{
    public function findAllHikes(int $limit = 0): array
    {
        if ($limit === 0) {
            $sql = "SELECT * FROM Hikes";
        } else {
            $sql = "SELECT * FROM Hikes LIMIT " . $limit;
        }
        $stmt = $this->query($sql);
        $hikes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $hikes;
    }
    
    public function findOneHike(int $idHike): array|false
    {
        $stmt = $this->query(
            "SELECT * FROM Hikes WHERE id = ?",
            [$idHike]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
