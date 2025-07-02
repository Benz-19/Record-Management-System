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
            header('Location: /record_management_system/login');
            exit;
        }

        if (!isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password'])) {
            $_SESSION['error'] = 'Ensure all fields are filled...';
            header('Location: /record_management_system/login');
            exit;
        } else {
        }
    }
}
