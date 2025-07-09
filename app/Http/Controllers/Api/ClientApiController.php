<?php

namespace App\Http\Controllers\Api;

use App\Models\Books;
use App\Http\Controllers\Book\BookController;

define('BASEPATH', dirname(__DIR__, 3));

if (file_exists(BASEPATH . '/Helper/functions.php')) {
    require_once BASEPATH . '/Helper/functions.php';
}

class ClientApiController
{
    public function getAvailableBooks()
    {
        $bookController = new Books();
        $books_data = $bookController->getAllBooks() ?: null;


        $available_books = array_filter($books_data, function ($book) {
            return $book;
        });

        jsonResponse([
            'books' => array_values($available_books)
        ]);
    }
}
