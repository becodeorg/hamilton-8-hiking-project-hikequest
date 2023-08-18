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
        return $stmt->fetch();
    }
    public function session(string $nickname, string $email, string $firstname, string $lastname, string|int $id = null): void
    {
        if ($id == null) {
            $_SESSION['user'] = [
                'id' => Database::lastInsertId(),
                'username' => $nickname,
                'email' => $email,
                'firstname' => $firstname,
                'lastname' => $lastname
            ];
        } else {
            $_SESSION['user'] = [
                'id' => $id,
                'username' => $nickname,
                'email' => $email,
                'firstname' => $firstname,
                'lastname' => $lastname
            ];
        }
    }

    public function editUser(array $param): bool
    {
        $sql = "UPDATE Users SET nickname= ?, email= ?, firstname= ?, lastname= ? WHERE User_id=?";
        return Database::exec($sql, $param);
    }
}