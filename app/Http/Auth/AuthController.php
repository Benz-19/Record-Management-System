<?php

namespace App\Http\Auth;

use App\Core\BaseController;
use App\Models\User;

class AuthController
{

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
            $input_email = htmlspecialchars(trim($_POST['email']));
            $input_password = htmlspecialchars(trim($_POST['password']));

            // Validate if this is a user
            $is_user =  User::isUser((string)$input_email, (string)$input_password);

            if (empty($is_user) || $is_user === null) {
                $_SESSION['error'] = 'User does not exists';
                header('Location: /record_management_system/');
                exit;
            } else {
                if ($is_user['user_type'] === 'admin') {
                    header('Location: /record_management_system/admin/dashboard');
                    exit;
                } elseif ($is_user['user_type'] === 'client') {
                    header('Location: /record_management_system/client/dashboard');
                    exit;
                } else {
                    $_SESSION['error'] = 'Login process failed';
                    header('Location: /record_management_system/login');
                    exit;
                }
            }
        }
    }

    public static function register()
    {
        //
    }
}
