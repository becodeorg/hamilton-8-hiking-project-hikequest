<?php
declare(strict_types=1);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use Controllers\AuthController;
use Controllers\retrieveAllController;

session_start();

try {
    $url_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
    $method = $_SERVER['REQUEST_METHOD']; 
    switch ($url_path) {
        case "":
        case "/index.php":
            $retrievecontroller = new retrieveAllController();
            $retrievecontroller->DisplayAllDatas();
            break;
        case "hike":
            $retrievecontroller = new retrieveAllController();
            $retrievecontroller->DisplayOneData($_GET['Hikes_Id']);
            break;
        case "edit":
            $retrievecontroller = new retrieveAllController();
            if ($method === "GET") $retrievecontroller->showEditForm($_GET['Hikes_Id']);
            if ($method === "POST") $retrievecontroller->editForm($_POST['id'], $_POST['name'], $_POST['distance'],$_POST['duration'], $_POST['elevation_gain'], $_POST['description']);
            break;
        case "register":
            $authController = new AuthController();
            if ($method === "GET") $authController->showRegistrationForm();
            if ($method === "POST") $authController->register($_POST['firstname'], $_POST['lastname'],$_POST['nickname'], $_POST['email'], $_POST['password']);
            break;
        case "login":
            $authController = new AuthController();
            if ($method === "GET") $authController->showLoginForm();
            if ($method === "POST") $authController->login($_POST['nickname'], $_POST['password']);
            break;
        case "logout":
            $authController = new AuthController();
            $authController->logout();
            break;
        case "profil":
            $authController = new AuthController();
            if ($method === "GET") $authController->showProfilForm();
            if ($method === "POST") $authController->updateProfil($_POST);
            $authController->showProfilForm();
            break;
    }
} catch (Exception $e) {
    print_r($e->getMessage());
}
?>
