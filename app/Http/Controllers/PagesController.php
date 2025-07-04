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
        $controller = new BaseController();
        $controller->renderView('/admin/dashboard');
    }

    public static function renderClientDashboard()
    {

        $bookController = new BookController();
        $books_data = $bookController->retrieveAllBooksData();
        $books = $books_data['books'];
        $counter = $books_data['counter'];
        $number_of_books = $books_data['number_of_books'];
        $borrowed_books = $books_data['borrowed_books'];
        $borrowed_books_ids = $books_data['borrowed_books_ids'];
        require __DIR__ . '/../../../resources/Views/client/dashboard.php';
        // $controller = new BaseController();
        // $controller->renderView('/client/dashboard');
    }
}
