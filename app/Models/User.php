<?php

namespace App\Models;

use PDOException;
use App\Models\DB;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public static function isUser(string $email, string $password)
    {
        $db = new DB();

        try {
            $query = "SELECT * FROM users WHERE email=:email AND password=:pass";
            $params = [
                ':email' => $email,
                ':pass' => $password
            ];
            $result = $db->execute($query, $params);

            return $result ?: null; //returns the user data

        } catch (PDOException $error) {
            error_log('Failed to validate user. ErrorType: ' . $error->getMessage());
            return null;
        }

        return null;
    }
}
