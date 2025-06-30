<?php
// dir: App/Models/DB.php

namespace App\Models;

use Exception;
use PDO;
use PDOException;

class DB
{

    private $db;

    public function __construct()
    {
        try {
            $config = require __DIR__ . '/../../config/config.php';
            $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};port={$config['port']};charset={$config['charset']};";

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            $this->db = new PDO($dsn, $config['db_username'], $config['db_password'], $options);
        } catch (PDOException $error) {
            error_log('Database connection error. ErrorType: ' . $error->getMessage());
        } catch (Exception $error) {
            error_log('Something went wrong in the DB class. ErrorType: ' . $error->getMessage());
        }
    }


    public function connection()
    {
        return $this->db;
    }
}
