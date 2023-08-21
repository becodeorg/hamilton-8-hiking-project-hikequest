<?php
declare(strict_types=1);

namespace Models;

use PDO;

class Tags extends Database
{
    public function findAllTags(): array
    {
        $sql = "SELECT * FROM Tags";
        $stmt = $this->query($sql);
        $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $tags;
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
}
