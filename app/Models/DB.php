<?php
// dir: App/Models/DB.php

namespace App\Models;

use Exception;
use PDO;
use PDOException;

class DB
{

    private $conn;

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

            $this->conn = new PDO($dsn, $config['db_username'], $config['db_password'], $options);
        } catch (PDOException $error) {
            error_log('Database connection error. ErrorType: ' . $error->getMessage());
        } catch (Exception $error) {
            error_log('Something went wrong in the DB class. ErrorType: ' . $error->getMessage());
        }
    }


    public function connection()
    {
        if (!isset($this->conn)) {
            $db = new DB();
            $this->conn = $db;
            return $this->conn;
        }
        return $this->conn;
    }

    public function closeConnection()
    {
        $this->conn = null;
    }

    /**
     * executes all SQL queries such as SELECT,UPDATE, DELETE
     * @param string $query stores the SQL query to be execured
     * @param array $params is an associative array for the prepared statement
     */

    public function execute(string $query, $params = [])
    {

        // Verify connection
        if (!$this->conn) {
            throw new PDOException("Database exception failed to execute this query.");
        }
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($params);
    }

    /**
     * fetchSingleData obtains a single data using the SELECT stmt
     * @param string $query stores the SQL query to be execured
     * @param array $params is an associative array for the prepared statement
     */

    public function fetchSingleData(string $query, $params = [])
    {
        if (!$this->conn) {
            throw new PDOException("Database connection not established, failed to retrieve single data.");
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    /**
     * fetchAllData obtains all data using the SELECT stmt
     * @param string $query stores the SQL query to be execured
     * @param array $params is an associative array for the prepared statement
     */

    public function fetchAllData(string $query, $params = [])
    {
        if (!$this->conn) {
            throw new PDOException("Database connection not established, failed to retrieve ALL data.");
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}
