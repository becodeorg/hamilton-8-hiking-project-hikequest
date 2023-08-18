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
    public function editForm(string $idHikeInput, string $nameInput, string $distanceInput, string $durationInput, string $elevationGainInput, string $descriptionInput)
    {
        if (empty($idHikeInput) || empty($nameInput) || empty($distanceInput) || empty($durationInput) || empty($elevationGainInput) || empty($descriptionInput)) {
            throw new Exception('Incomplete form');
        }
        
        $name = htmlspecialchars($nameInput);
        $distance = htmlspecialchars($distanceInput);
        $duration = htmlspecialchars($durationInput);
        $elevation_gain = htmlspecialchars($elevationGainInput);
        $description = htmlspecialchars($descriptionInput);

        (new retrieveAll())->editHike($idHikeInput, $name, $distance, $duration, $elevation_gain, $description);
        
        http_response_code(302);
        header('Location: /');

    }

    public function showEditForm(string $id)
    {
        $data = (new retrieveAll())->FindOneData($id);
        include 'views/layout/header.view.php';
        include 'views/edit.view.php';
        include 'views/layout/footer.view.php';
    }
}
