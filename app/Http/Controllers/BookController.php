<?php

namespace App\Http\Controllers;

use App\Models\Books;

class BookController
{

    public function retrieveAllBooksData()
    {
        $user_id = htmlspecialchars($_SESSION['user_data']['id']);
        $db_books = new Books();
        $books = $db_books->getAllBooks() ?: null;
        $counter = 0;
        $number_of_books = count($books) ?: 0;
        $borrowed_books = $db_books->getAllBorrowedBooks((int) $user_id);

        $borrowed_readers_list = array_column($borrowed_books, 'user_id');

        $is_returned = array_column($borrowed_books, 'is_returned');
        $rented = (count($is_returned) > 0) ? true : false;

        $borrowed_books_ids = array_column($borrowed_books, 'book_id');
        rsort($borrowed_books_ids);
        rsort($borrowed_books);
        $books_data = [
            'counter' => $counter,
            'number_of_books' => $number_of_books,
            'books' => $books,
            'borrowed_books_ids' => $borrowed_books_ids,
            'borrowed_readers_list' => $borrowed_readers_list,
            'borrowed_books' => $borrowed_books,
            'rented' => $rented
        ];
        return $books_data;
    }
}
