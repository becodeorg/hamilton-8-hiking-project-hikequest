<?php
declare(strict_types=1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use Controllers\HikeController;
use Controllers\AuthController;

session_start();

try {
    $url_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
    $method = $_SERVER['REQUEST_METHOD']; // GET -- POST
    switch ($url_path) {
        case "":
        case "/index.php":
            $hikeController = new HikeController();
            $hikeController->index();
            break;
        case "hike":
            $hikeController = new HikeController();
            $hikeController->DisplayProduct($_GET['id']);
            break;
        case "edit":
            $hikeController = new HikeController();
            if ($method === "GET") {
                $tags = $hikeController->findAllTagsFilter();
                $hikeController->showEditHike($_GET['id']);
            }
            if ($method === "POST") $hikeController->updateHike(
                $_GET['id'],
                $_POST['name'],
                $_POST['distance'],
                $_POST['duration'],
                $_POST['elevation_gain'],
                $_POST['description'],
            );
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
    }
} catch (Exception $e) {
    print_r($e->getMessage());
    var_dump($_GET);
}
?>
