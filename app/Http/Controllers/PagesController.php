<?php

namespace App\Http\Controllers;

use App\Core\BaseController;

class PagesController
{

    public static function renderLandingPage()
    {
        $controller = new BaseController();
        $controller->renderView('/pages/landing');
    }

    public static function renderLoginPage()
    {
        $controller = new BaseController();
        $controller->renderView('/auth/login');
    }

    public static function renderRegisterPage()
    {
        $controller = new BaseController();
        $controller->renderView('/auth/register');
    }

    public static function renderAdminDashboard()
    {
        if ((!isset($_SESSION['user_data']['user_type']) || $_SESSION['user_data']['user_type'] === 'admin') && $_SESSION['is_logged_in'] !== true) {
            header('Location: /record_management_system/login');
            exit;
        }
        $controller = new BaseController();
        $controller->renderView('/admin/dashboard');
    }

    public static function renderClientDashboard()
    {
        if ((!isset($_SESSION['user_data']['user_type']) || $_SESSION['user_data']['user_type'] === 'client') && $_SESSION['is_logged_in'] !== true) {
            header('Location: /record_management_system/login');
            exit;
        }
        $bookController = new BookController();
        $books_data = $bookController->retrieveAllBooksData();
        $books = $books_data['books'];
        $index = 0; //index postion for each value in the borrowed_books array
        $counter = $books_data['counter'];
        $number_of_books = $books_data['number_of_books'];
        $number_of_borrowed_books = count($books_data['borrowed_books']);
        $borrowed_books = $books_data['borrowed_books'];
        $borrowed_books_ids = $books_data['borrowed_books_ids'];
        $borrowed_readers_list = $books_data['borrowed_readers_list'];
        $rented = $books_data['rented'];
        require __DIR__ . '/../../../resources/Views/client/dashboard.php';
        // $controller = new BaseController();
        // $controller->renderView('/client/dashboard');
    }
}
