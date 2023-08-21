<?php

declare(strict_types=1);

namespace Controllers;

use Exception;
use Models\retrieveAll;

class retrieveAllController
{
    public function DisplayAllDatas()
    {
        try {
            $datas = (new retrieveAll())->findAll();
            $tags = (new retrieveAll())->findAllTags();
            // Display the list of hikes
            include 'views/layout/header.view.php';
            include 'views/index.view.php';
            include 'views/layout/footer.view.php';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function DisplayOneData(string $idHike)
    {
        try {
            $data = (new retrieveAll())->FindOneData($idHike);

            if (empty($data)) {
                echo "Empty hike";
            }

            // Display the hike details page
            include 'views/layout/header.view.php';
            include 'views/hike.view.php';
            include 'views/layout/footer.view.php';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    public function showdeleteForm(string $id)
    {
        $data = (new retrieveAll())->FindOneData($id);
        include 'views/layout/header.view.php';
        include 'views/delete.view.php';
        include 'views/layout/footer.view.php';
    }
    public function deleteHike(string $id)
    {
        try {
            (new retrieveAll())->deleteHike($id);
            header('Location: /');
            exit(); 
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }
    /////////////////////////////////////////////
    public function showEditHike(string $idHike)
    {
        try {
            $hike = (new retrieveAll())->findOneHike($idHike);
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
            $UpdateHike = (new retrieveAll())->updateHike($idHike, $name, $distance, $duration, $elevation_gain, $description);
            if (empty($UpdateHike)) {
                echo "Hike not saved";
                return;
            }
            header('location: /');
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


    public function findTagByHike($hikeId){
        $tagsChoice = (new retrieveAll())->findTagByHikeId($hikeId);
        return $tagsChoice;
    }

    public function findTagNotLied($hikeId){
        $tagsNotLied = (new retrieveAll())->findTagsNotLied($hikeId);
        return $tagsNotLied;
    }

    public function updateHikeTags(array $tags_Del,array $tags_add, string $id)
    {
        try {
            $tags = (new retrieveAll())->findTagByHikeId($id);

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
                    $tags = (new retrieveAll())->deleteTagsRelation($value, $id);
                }

            if (!empty($tags_add)) {
                foreach ($tags_add as $key => $value){
                    if ($value){
                        $tags = (new retrieveAll())->addTagsRelation($value,$id);
                    }
                }
            }
            return $tags;
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
}
