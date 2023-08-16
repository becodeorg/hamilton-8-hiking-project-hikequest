<?php
declare(strict_types=1);

namespace Models;

use PDO;

class User extends Database 
{
    public function register(string $firstname, string $lastname, string $nickname, string $email, string $passwordHash)
    {
        $sql = "INSERT INTO Users (firstname, lastname, nickname, email, password) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = Database::query($sql, [$firstname, $lastname, $nickname, $email, $passwordHash]);
    }
    public function login(string $nickname)
    {
        $sql ="SELECT * FROM Users WHERE nickname = ?";
        $stmt = Database::query($sql, [$nickname]);
        $user = $stmt->fetch();
        return $user;
    }
    public function session(string $nickname, string $email, string $firstname, string $lastname ){
        $_SESSION['user'] = [
            'id' => $this->lastInsertId(),
            'username' => $nickname,
            'email' => $email,
            'firstname' => $firstname,
            'lastname' => $lastname
        ];
    }

    public function editUser(array $param): bool{
        $sql = "UPDATE Users SET lastname= ? AND firstname= ? AND email= ? AND nickname= ? WHERE id=?";
        return Database::exec($sql, $param);

    }


}