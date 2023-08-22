<?php
declare(strict_types=1);

namespace Models;

use Controllers\MailController;
use PDO;

class retrieveAll extends Database
{
    public function findAll(): array
    {
        $sql = "SELECT 
        h.*,
        GROUP_CONCAT(t.Tags_Name) AS Tags,
        u.nickname 
    FROM Hikes h 
    INNER JOIN HikesTagsRelation htr ON htr.Htr_hikes_Id = h.Hikes_Id 
    INNER JOIN Tags t ON t.Tags_Id = htr.Htr_Tags_Id 
    RIGHT JOIN Users u ON u.User_id = h.H_User_Id 
    GROUP BY h.Hikes_Id, h.Hikes_Name, h.distance, h.duration, h.elevation_gain, h.description, u.nickname
    ";
        $stmt = $this->query($sql);
        $allDatas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $allDatas;
    }

    public function FindOneData(string $idHike): array|false
    {
        $stmt = $this->query(
            "SELECT h.*, GROUP_CONCAT(t.Tags_Name) AS Tags, u.nickname 
            FROM Hikes h 
            INNER JOIN HikesTagsRelation htr ON htr.Htr_hikes_Id = h.Hikes_Id 
            INNER JOIN Tags t ON t.Tags_Id = htr.Htr_Tags_Id 
            RIGHT JOIN Users u ON u.User_id = h.H_User_Id 
            WHERE h.Hikes_Id = ?
            GROUP BY h.Hikes_Id, h.Hikes_Name, h.distance, 
            h.duration, h.elevation_gain, h.description, u.nickname",
            [$idHike]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function findAllTags(): array
    {
        $sql = "SELECT * FROM Tags";
        $stmt = $this->query($sql);
        $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $tags;
    }
    public function deleteHike(string $idHike)
    {
        $sqlDeleteRelations = "DELETE FROM `HikesTagsRelation` WHERE Htr_hikes_Id = ?";
        $sqlDeleteHike = "DELETE FROM `Hikes` WHERE Hikes_Id = ?";

        $this->query($sqlDeleteRelations, [$idHike]);
        $this->query($sqlDeleteHike, [$idHike]);
    }
    /////////////////////////////////
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
    public function findTagByHikeId($hikeId) {
        $sql = "SELECT t.*
        FROM Tags t
        JOIN HikesTagsRelation htr ON t.Tags_Id = htr.Htr_Tags_Id
        WHERE htr.Htr_hikes_Id = $hikeId;
        ;
        ";
        $stmt = $this->query($sql);
        $tagsChoice = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tagsChoice;
    }

    public function findTagsNotLied($hikeId){
        $sql = "SELECT t.*
        FROM Tags t
        WHERE t.Tags_Id NOT IN (SELECT htr.Htr_Tags_Id
        FROM HikesTagsRelation htr
        WHERE htr.Htr_hikes_Id = $hikeId)";

        $stmt = $this->query($sql);
        $tagsNotLied = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tagsNotLied;
    }

    public function deleteTagsRelation($idTags, $idHike) {
        $sql = "DELETE  FROM HikesTagsRelation WHERE Htr_Tags_Id = ? AND Htr_hikes_Id = ?";
        $stmt = $this->query($sql, [$idTags, $idHike]);
        return $stmt;
    }

    public function addTagsRelation($idTags, $idHike) {
        $sql = "INSERT INTO HikesTagsRelation (Htr_Tags_Id, Htr_hikes_Id)
        SELECT Tags_Id, Hikes_Id
        FROM Tags, Hikes
        WHERE Tags_Id = ?
          AND Hikes_Id = ?
          AND NOT EXISTS (
            SELECT 1
            FROM HikesTagsRelation
            WHERE Htr_Tags_Id = Tags_Id
              AND Htr_Hikes_Id = Hikes_Id
        )";

        $stmt = $this->query($sql, [$idTags, $idHike]);
        return $stmt;
    }

    public function createHike(string $name, string $distance, string $duration, string $elevation, string $description, int $userId)
    {
        $sql = "INSERT INTO `Hikes`(`Hikes_Name`, `distance`, `duration`, `elevation_gain`, `description`, `H_User_Id`, `created_at`, `updated_at`) 
                VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";

        $this->query($sql, [$name, $distance, $duration, $elevation, $description, $userId]);

        return $this->lastInsertId();
    }
}
    
