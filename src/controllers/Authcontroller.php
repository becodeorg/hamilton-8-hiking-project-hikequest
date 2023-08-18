<?php
declare(strict_types=1);

namespace Controllers;

use Exception;
use Models\Database;
use Models\User;
use Models\EmailSender;

class AuthController
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function register(string $firstnameInput, string $lastnameInput, string $nicknameInput, string $emailInput, string $passwordInput)
    {
        if (empty($firstnameInput) || empty($lastnameInput) || empty($nicknameInput)|| empty($emailInput)|| empty($passwordInput)) {
            throw new Exception('Formulaire non complet');
        }

        $firstname = htmlspecialchars($firstnameInput);
        $lastname = htmlspecialchars($lastnameInput);
        $nickname = htmlspecialchars($nicknameInput);
        $email = filter_var($emailInput, FILTER_SANITIZE_EMAIL);
        $passwordHash = password_hash($passwordInput, PASSWORD_DEFAULT);
        try{
            $registerForm = (new User())->register($firstname, $lastname, $nickname,$email,$passwordHash);
            $sessionStart = (new User())->session($nickname, $email);
            $mailSender = (new EmailSender())->SendRegConfMail($email, $nickname);
            http_response_code(302);
            header('location: /');
        } catch (Exception $e) {
            print_r($e->getMessage());
        } 
    }
    public function showRegistrationForm()
    {
        include 'views/layout/header.view.php';
        include 'views/register.view.php';
        include 'views/layout/footer.view.php';
    }
    public function login(string $nicknameInput, $passwordInput)
    {
        if (empty($nicknameInput) || empty($passwordInput))
        {
            throw new Exception('Formulaire non complet');
        }
        $nickname = htmlspecialchars($nicknameInput);
        $user = (new User())->login($nicknameInput);        
        if (empty($user)) {
            throw new Exception('Mauvais nom d\'utilisateur');
        }
        if (password_verify($passwordInput, $user['password']) === false) {
            throw new Exception('Mauvais mot de passe');
        }
        (new User())->session($nickname, $user['email'], $user['firstname'], $user['lastname'], $user['User_id']);

        // Redirect to home page
        http_response_code(302);
        header('location: /');
    }
    public function showLoginForm()
    {
        include 'views/layout/header.view.php';
        include 'views/login.view.php';
        include 'views/layout/footer.view.php';
    }
    public function logout()
    {
        unset($_SESSION['user']);
        http_response_code(302);
        header('location: /');
    }
    public function showProfilForm()
    {
        include 'views/layout/header.view.php';
        include 'views/profile.view.php';
        include 'views/layout/footer.view.php';
    }

    public function updateProfil(array $post)
    {
        try {
            if (empty($post['nickname']) || empty($post['email']) || empty($post['firstname']) || empty($post['lastname'])) {
                throw new Exception('Formulaire non complet');
            }

            $nickname = htmlspecialchars($post['nickname']);
            $lastname = htmlspecialchars($post['lastname']);
            $firstname = htmlspecialchars($post['firstname']);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('le mail est incorrect');
            }


            $edit = (new User())->editUser(
                [$nickname, $email, $firstname, $lastname, $_SESSION['user']['id']]
            );
            if (!$edit) {
                throw new Exception("Ca ne fonctionne pas!");
            }

            (new User())->session($nickname, $email, $firstname, $lastname, $_SESSION['user']['id']);
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

}