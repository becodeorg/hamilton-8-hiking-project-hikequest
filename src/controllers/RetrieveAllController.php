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
}
