<?php

namespace App\Http\Controllers\Book;

use Exception;
use PDOException;
use App\Models\Books;

class BookController
{
    public function addRecord()
    {
        if (!isset($_POST['addNewRecord'])) {
            $_SESSION['erorr'] = '';
            header('Location: /record_management_system/admin/add-book');
            exit;
        }

        try {
            $bookController = new Books();
            $validatedInput = [
                ':title' => htmlspecialchars(trim($_POST['title'])),
                ':ath' => htmlspecialchars(trim($_POST['author'])),
                ':pub_year' => htmlspecialchars(trim($_POST['published_year'])),
                ':gen' => htmlspecialchars(trim($_POST['genre'])),
                ':tot_cpy' => htmlspecialchars(trim($_POST['total_copies'])),
                ':avail_cpy' => htmlspecialchars(trim($_POST['available_copies']))
            ];

            $bookController->manageBook('create', $validatedInput); //add a new record

            $_SESSION['success'] = 'New Record Added Successfully!';

            header('Location: /record_management_system/admin/add-book');
            exit;
        } catch (PDOException $e) {
            error_log('Database Error. Failed to add a new record at BookController::addRecord. ErrorType: ' . $e->getMessage());
        } catch (Exception $e) {
            error_log('Something went wrong at BookController::addRecord. ErrorType: ' . $e->getMessage());
        }
    }

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

        $unreturned_books_by_client = $db_books->getUnreturnedBorrowedBooksByUser((int) $user_id);
        $books_data = [
            'counter' => $counter,
            'number_of_books' => $number_of_books,
            'books' => $books,
            'borrowed_books_ids' => $borrowed_books_ids,
            'borrowed_readers_list' => $borrowed_readers_list,
            'borrowed_books' => $borrowed_books,
            'rented' => $rented,
            'unreturned_books_by_client' => $unreturned_books_by_client
        ];
        return $books_data;
    }
}
