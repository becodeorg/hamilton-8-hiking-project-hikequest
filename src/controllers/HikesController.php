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
    public function DisplayProduct(string $nameOfHick){
        try {
            $hike = (new Hike())->findOneHike($nameOfHick);

            if (empty($nameOfHick)) {
                echo "empty product name";
            }

            // 3 - Afficher la page
            include 'views/layout/header.view.php';
            include 'views/hike.view.php';
            include 'views/layout/footer.view.php';

        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}