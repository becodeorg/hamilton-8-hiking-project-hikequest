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

    public function findTagByHike($hikeId): array
    {
        $sql = "SELECT Hikes_Id, H_User_Id, Htr_hikes_Id, Htr_Tags_Id, Tags_Id, Tags_Name FROM Hikes h INNER JOIN HikesTagsRelation htr ON htr.Htr_hikes_Id = h.Hikes_Id INNER JOIN Users u ON u.User_id = h.H_User_Id INNER JOIN Tags t ON t.Tags_Id = htr.Htr_Tags_Id WHERE h.Hikes_Id = 2";
        $stmt = $this->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
