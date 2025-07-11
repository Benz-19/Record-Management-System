<?php

namespace App\Http\Controllers\Pages;

use App\Core\BaseController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Users\UserController;


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

    public static function renderViewUsers()
    {
        if ((!isset($_SESSION['user_data']['user_type']) || $_SESSION['user_data']['user_type'] === 'admin') && $_SESSION['is_logged_in'] !== true) {
            header('Location: /record_management_system/login');
            exit;
        }
        $userController = new UserController();
        $users = $userController->renderAllUsers();

        require __DIR__ . '/../../../../resources/Views/admin/displayUsers.php';
        exit;
    }

    public function renderAddNewBookRecord()
    {
        if ((!isset($_SESSION['user_data']['user_type']) || $_SESSION['user_data']['user_type'] === 'admin') && $_SESSION['is_logged_in'] !== true) {
            header('Location: /record_management_system/login');
            exit;
        }
        $controller = new BaseController();
        $controller->renderView('/admin/addNewBookRecord');
    }

    public function renderUpdateRecord()
    {
        if ((!isset($_SESSION['user_data']['user_type']) || $_SESSION['user_data']['user_type'] === 'admin') && $_SESSION['is_logged_in'] !== true) {
            header('Location: /record_management_system/login');
            exit;
        }

        $book_id = $_GET['id'] ?? null;
        if (!$book_id) {
            require __DIR__ . '/../../../../resources/Views/admin/dashboard.php';
            exit;
        }

        $controller = new BookController();
        $books_id = htmlspecialchars(trim($book_id));
        $book_data = $controller->retrieveSingleBooksData($book_id);
        require __DIR__ . '/../../../../resources/Views/admin/updateBookRecord.php';
        exit;
    }


    public function displayAllBookRecords()
    {
        if ((!isset($_SESSION['user_data']['user_type']) || $_SESSION['user_data']['user_type'] === 'admin') && $_SESSION['is_logged_in'] !== true) {
            header('Location: /record_management_system/login');
            exit;
        }
        $controller = new BaseController();
        $controller->renderView('/admin/displayAllBookRecords');
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
        $unreturned_books_by_client = $books_data['unreturned_books_by_client'];
        require __DIR__ . '/../../../../resources/Views/client/dashboard.php';
    }
}
