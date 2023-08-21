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

    public function findOneHike(string $idHike): array|false
    {
        $stmt = $this->query(
            "SELECT * FROM Hikes WHERE Hikes_Id = ?",
            [$idHike]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateHike(string $idHike, string $name, string $distance, string $duration, string $elevation_gain, string $description)
    {
        $sql = "UPDATE Hikes SET Hikes_Name = ?, distance = ?, duration = ?, elevation_gain = ?, description = ? WHERE Hikes_Id = ?";
        $idOfHike = htmlspecialchars($idHike);
        return $this->query($sql, [$name, $distance, $duration, $elevation_gain, $description, $idOfHike]);
    }
}