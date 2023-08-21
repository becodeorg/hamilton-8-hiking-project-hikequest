<?php

declare(strict_types=1);

namespace Controllers;

use Exception;
use Models\Database;
use Models\Hike;
use Models\Tags;
use PDO;

class HikeController
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function index()
    {
        try {
            $hikes = (new Hike())->findAllHikes(60);

            // 3 - Affichage de la liste des produits
            include 'views/layout/header.view.php';
            include 'views/index.view.php';
            include 'views/layout/footer.view.php';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    public function DisplayProduct(string $idHike){
        try {
            $hike = (new Hike())->findOneHike($idHike);

            if (empty($idHike)) {
                echo "empty hike";
            }

            // 3 - Afficher la page
            include 'views/layout/header.view.php';
            include 'views/hike.view.php';
            include 'views/layout/footer.view.php';

        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function showEditHike(string $idHike)
    {
        try {
            $hike = (new Hike())->findOneHike($idHike);
            $tagsChecked = $this->findTagByHike($idHike);
            $tagsNotLied = $this->findTagNotLied($idHike);

            if (empty($hike)) {
                echo "Hike not found";
                return;
            }

            // Display the page
            include 'views/layout/header.view.php';
            include 'views/edit.view.php';
            include 'views/layout/footer.view.php';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function updateHike(string $idHike, $name, $distance, $duration, $elevation_gain, $description)
    {
        try {
            $UpdateHike = (new Hike())->updateHike($idHike, $name, $distance, $duration, $elevation_gain, $description);
            if (empty($UpdateHike)) {
                echo "Hike not saved";
                return;
            }
//            header('location: /');
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function findAllTagsFilter()
    {
        try {
            $tags = (new Tags())->findAllTags();
            return $tags;

        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function findTagByHike($hikeId){
        $tagsChoice = (new Tags())->findTagByHikeId($hikeId);
        return $tagsChoice;
    }

    public function findTagNotLied($hikeId){
        $tagsNotLied = (new Tags())->findTagsNotLied($hikeId);
        return $tagsNotLied;
    }

    public function updateHikeTags(array $tags_Del,array $tags_add, string $id)
    {
        try {
            $tags = (new Tags())->findTagByHikeId($id);

            $tagsIdByTags = array();
            foreach ($tags as $tag) {
                $tagsIdByTags[] = $tag["Tags_Id"];
            }

            $tagsIdByTagsDel = array();
            foreach ($tags_Del as $key => $value) {
                $tagsIdByTagsDel[] = $value;
            }


                $resultArr = array_diff($tagsIdByTags, $tagsIdByTagsDel);
                foreach ($resultArr as $key => $value){
                    $tags = (new Tags())->deleteTagsRelation($value, $id);
                }

            if (!empty($tags_add)) {
                foreach ($tags_add as $key => $value){
                    if ($value){
                        $tags = (new Tags())->addTagsRelation($value,$id);
                    }
                }
            }
            return $tags;
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function showTagsByHike(string $idHike){
        try {
            $tags = (new Tags())->findTagByHike($idHike);

            if (empty($tags)) {
                echo "Tags not found";
                return;
            }

        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}