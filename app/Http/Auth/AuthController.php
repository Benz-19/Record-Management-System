<?php

namespace App\Http\Auth;

use App\Core\BaseController;
use App\Models\User;

class AuthController
{

    /**
     * Login processes the login functionality of any user (admin, client)
     * @param string $_SESSION['error'] stores potential error to display to
     * the user but would be unset after use
     * @param array $is_user stores the user data obtained form the db such as. username,user_type etc.
     */

    public static function login()
    {
        if (!isset($_POST['loginBtn'])) {
            $_SESSION['error'] = 'Something went wrong...';
            header('Location: /record_management_system/login');
            exit;
        }

        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            $_SESSION['error'] = 'Ensure all fields are filled...';
            header('Location: /record_management_system/login');
            exit;
        } else {
            // Sanitize input
            $input_email = strtolower(htmlspecialchars(trim($_POST['email'])));
            $input_password = htmlspecialchars(trim($_POST['password']));

            // Validate if this is a user
            $is_user =  (new User)->isUser((string)$input_email, (string)$input_password);

            if (empty($is_user) || $is_user === null) {
                $_SESSION['error'] = 'User does not exists';
                header('Location: /record_management_system/login'); //redirect to login page if not a user
                exit;
            } else {
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_data'] = [
                    'id' => $is_user['id'],
                    'username' => $is_user['id'],
                    'user_type' => $is_user['user_type'],
                    'id' => $is_user['id'],
                ];
                if ($is_user['user_type'] === 'admin') {
                    header('Location: /record_management_system/admin/dashboard'); //redirects to admin dashboard
                    exit;
                } elseif ($is_user['user_type'] === 'client') {
                    header('Location: /record_management_system/client/dashboard'); //redirects to client dashboard
                    exit;
                } else {
                    $_SESSION['error'] = 'Login process failed';
                    header('Location: /record_management_system/login'); //redirect to login page on failed attempt
                    exit;
                }
            }
        }
    }

    public static function register()
    {
        if (!isset($_POST['registerBtn'])) {
            $_SESSION['error'] = 'Something went wrong...';
            header('Location: /record_management_system/landing');
            exit;
        }

        if (!isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password'])) {
            $_SESSION['error'] = 'Ensure all fields are filled...';
            header('Location: /record_management_system/register');
            exit;
        } else {
            // Check if user exists
            $email = (string)strtolower(htmlspecialchars(trim($_POST['email'])));
            $username = (string)strtolower(htmlspecialchars(trim($_POST['username'])));
            $password = (string)strtolower(htmlspecialchars(trim($_POST['password'])));

            $user_credentials = (new User)->getUserCredentials($email); //is exists in the database

            if (!empty($user_credentials) || $user_credentials !== null) {
                $_SESSION['error'] = 'User Already Exists...';
                header('Location: /record_management_system/register');
                exit;
            } else {

                // Create a nse user
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $user_type = 'client'; //default
                $new_user = [
                    'username' => $username,
                    'email' => $email,
                    'password' => $hashed_password,
                    'user_type' => $user_type
                ];

                $result = (new User)->createUser($new_user);

                if ($result) {
                    $_SESSION['success'] = 'Account Created Successfully...';
                    header('Location: /record_management_system/register');
                    exit;
                } else {
                    $_SESSION['error'] = 'Failed to create account...';
                    header('Location: /record_management_system/register');
                    exit;
                }
            }
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );

            session_destroy();

            header('Location: /record_management_system/');
            exit;
        }
    }
}
