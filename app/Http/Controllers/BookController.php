<?php

namespace App\Http\Controllers;

use App\Models\Books;

class BookController
{

    public function retrieveAllBooksData()
    {
        $db_books = new Books();
        $books = $db_books->getAllBooks() ?: null;
        $counter = 0;
        $number_of_books = count($books) ?: 0;
        $borrowed_books = $db_books->getAllBorrowedBooks();

        $borrowed_books_ids = array_column($borrowed_books, 'book_id');
        $books_data = [
            'counter' => $counter,
            'number_of_books' => $number_of_books,
            'books' => $books,
            'borrowed_books_ids' => $borrowed_books_ids,
            'borrowed_books' => $borrowed_books
        ];
        return $books_data;
    }
}
