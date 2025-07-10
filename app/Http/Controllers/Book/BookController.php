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
            $_SESSION['erorr'] = 'Something went wrong in updating this book data...';
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

    public function retrieveSingleBooksData(int $book_id): ?array
    {
        $book = new Books();

        try {
            $data = $book->getBookById($book_id);
            return $data;
        } catch (PDOException $e) {
            error_log('Database Error. Failed to add a new record at BookController::addRecord. ErrorType: ' . $e->getMessage());
            return null;
        } catch (Exception $e) {
            error_log('Something went wrong at BookController::addRecord. ErrorType: ' . $e->getMessage());
            return null;
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

    public function updateRecord()
    {

        if (!isset($_POST['updateBtn'])) {
            $_SESSION['erorr'] = 'Something went wrong in updating this book data...';
            header('Location: /record_management_system/admin/add-book');
            exit;
        }

        try {
            $bookController = new Books();
            $validatedInput = [
                ':id' => htmlspecialchars(trim($_POST['id'])),
                ':title' => htmlspecialchars(trim($_POST['title'])),
                ':ath' => htmlspecialchars(trim($_POST['author'])),
                ':pub_year' => htmlspecialchars(trim($_POST['published_year'])),
                ':gen' => htmlspecialchars(trim($_POST['genre'])),
                ':tot_cpy' => htmlspecialchars(trim($_POST['total_copies'])),
                ':avail_cpy' => htmlspecialchars(trim($_POST['available_copies']))
            ];

            $bookController->manageBook('update', $validatedInput); //updates a book record

            $_SESSION['success'] = 'Successfully Updated the Record!';

            header('Location: /record_management_system/admin/update-book');
            exit;
        } catch (PDOException $e) {
            error_log('Database Error. Failed to update record at BookController::updateRecord. ErrorType: ' . $e->getMessage());
        } catch (Exception $e) {
            error_log('Something went wrong at BookController::updateRecord. ErrorType: ' . $e->getMessage());
        }
    }

    /**
     * Responsible for deleting any book
     */
    public function deleteRecord()
    {
        if (!isset($_POST['deleteBtn'])) {
            $_SESSION['erorr'] = 'Something went wrong in updating this book data...';
            header('Location: /record_management_system/admin/display-all-books');
            exit;
        }

        try {
            $bookController = new Books();
            $validatedInput = [
                ':id' => htmlspecialchars(trim($_POST['id'])),
            ];

            $bookController->manageBook('delete', $validatedInput); //delete a book record

            $_SESSION['success'] = 'Successfully deleted the Record!';

            header('Location: /record_management_system/admin/display-all-books');
            exit;
        } catch (PDOException $e) {
            error_log('Database Error. Failed to delete record at BookController::deleteRecord. ErrorType: ' . $e->getMessage());
        } catch (Exception $e) {
            error_log('Something went wrong at BookController::deleteRecord. ErrorType: ' . $e->getMessage());
        }
    }
}
