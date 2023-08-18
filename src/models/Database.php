<?php
declare(strict_types=1);

namespace Models;

use Exception;
use PDO;
//Utiliser PDO
use PDOStatement;
// Utiliser PDO statement

class Database
{
    private PDO $pdo;
    
    public function __construct()
        //fonction pour creer les parametres de la future fonction
    {
        $this->pdo = new PDO(
            'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_DATABASE'),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD')
        );

        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function exec(string $sql, array $param): bool
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($param);
    }

    public function query(string $query, array $params = []): PDOStatement
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return $stmt;
    }

    public function lastInsertId(): string|int
    {
        return $this->pdo->lastInsertId();
    }
}
