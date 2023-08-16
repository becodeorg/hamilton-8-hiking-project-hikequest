<?php

declare(strict_types=1);

namespace Controllers;

use Exception;
use Models\Database;
use Models\Hike;
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
            header('location: /');
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}