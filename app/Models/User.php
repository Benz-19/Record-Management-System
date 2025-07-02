<?php

namespace App\Models;

use Exception;
use PDOException;
use App\Models\DB;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function isUser(string $email, string $password)
    {
        $db = new DB();

        try {
            $user_credentials = $this->getUserCredentials($email);

            if (empty($user_credentials) || $user_credentials === null) {
                $_SESSION['error'] = 'User does not exists!!!';
                header('Location: /record_management_system/login');
                exit;
            } else {
                if (password_verify($password, $user_credentials['password'])) {
                    return $user_credentials;  //return the entire array for validation at login
                }

                return null;
            }
        } catch (PDOException $error) {
            error_log('Failed to validate user. ErrorType: ' . $error->getMessage());
            return null;
        }
        return null;
    }

    public function getUserCredentials(string $email)
    {
        $db = new DB();

        try {
            $query = "SELECT * FROM users WHERE email=:email";
            $params = [':email' => strtolower(htmlspecialchars(trim($email)))];

            $user_credentials = $db->fetchSingleData($query, $params);

            return $user_credentials ?: null; //returns the user data
        } catch (PDOException $error) {
            error_log('Failed to get user credentials user. ErrorType: ' . $error->getMessage());
            return null;
        } catch (Exception $error) {
            error_log('Something went wrong at User::getUserCredentials. ErrorType: ' . $error->getMessage());
            return null;
        }

        return null;
    }

    public function createUser($new_user = [])
    {
        $db = new DB();

        try {
            $query = "INSERT INTO users(username, email, password, user_type) VALUES (:user, :email, :pass, :utype)";
            $params = [
                ':user' => $new_user['username'],
                ':pass' => $new_user['password'],
                ':email' => $new_user['email'],
                ':utype' => $new_user['user_type']
            ];
            $result = $db->execute($query, $params);
            return $result ?: false;
        } catch (PDOException $error) {
            error_log('Failed to get user credentials user. ErrorType: ' . $error->getMessage());
            return false;
        } catch (Exception $error) {
            error_log('Something went wrong at User::createUser. ErrorType: ' . $error->getMessage());
            return false;
        }
    }
}
