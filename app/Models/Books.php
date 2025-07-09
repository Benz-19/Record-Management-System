<?php

namespace App\Models;

use Exception;
use PDOException;
use App\Models\DB;

class Books extends DB
{
    /**
     * Performs actions such as create, update, delete for a given book.
     *
     * @param string $action store the action to be executed.
     * @param string $query store the necessary SQL query to be executed.
     * @param array $params an associative array used in a prepared statement.
     */
    public function manageBook(string $action, array $params)
    {
        $query = '';

        switch ($action) {
            case 'create':
                $query = "INSERT INTO
                books (title, author, published_year, genre, total_copies, available_copies)
                VALUES
                (:title, :ath, :pub_year, :gen, :tot_cpy, :avail_cpy)";
                break;
            case 'update':
                $query = "UPDATE
                books SET title=:title, author=:ath, published_year=:pub_year, genre=:gen, total_copies=:tot_cpy, available_copies=:avail_cpy
                WHERE id=:id";
                break;
            case 'delete':
                $query = "DELETE * FROM books WHERE id=:id";
                break;

            default:
                error_log("Something went wrong at Books::manageBook");
                throw new \InvalidArgumentException("Unsupported action '$action'");
                break;
        }

        // execute the appropriate query
        $this->execute($query, $params);
    }


    /**
     * Responsible for retrieving a single books based on its id.
     *
     * @param int $id is the id of the book
     * @return array|null The book data as an associative array, or null if not found.
     */
    public function getBookById(int $id): ?array
    {
        $query = "SELECT * FROM books WHERE id=:id LIMIT 1";
        $params = [':id' => $id];

        $singleBook =  $this->fetchSingleData($query, $params);

        return $singleBook;
    }


    /**
     * Responsible for retrieving a single books based on its id.
     *
     * @return array|null All the book data as an associative array, or null if not found.
     */
    public function getAllBooks(): ?array
    {
        try {
            $query = "SELECT * FROM books ORDER BY created_at DESC";
            $singleBook =  $this->fetchAllData($query);
            return $singleBook;
        } catch (PDOException $error) {
            error_log("Execution Failure: Database error retrieving all books in Books::getAllBooks. ErrorType: " . $error->getMessage());
            return null;
        } catch (Exception $error) {
            error_log("Something went wrong: An unexpected error occurred in Books::getAllBooks. ErrorType: " . $error->getMessage());
            return null;
        }
    }


    public function getAllBorrowedBooks(int $user_id): ?array
    {
        try {
            $query = "SELECT * FROM borrowed_books WHERE user_id=:u_id ORDER BY borrow_date DESC";
            $params = [':u_id' => $user_id];
            $borrowedBook =  $this->fetchAllData($query, $params);
            return $borrowedBook;
        } catch (PDOException $error) {
            error_log("Execution Failure: Database error retrieving all books in Books::getAllBorrowedBooks. ErrorType: " . $error->getMessage());
            return null;
        } catch (Exception $error) {
            error_log("Something went wrong: An unexpected error occurred in Books::getAllBorrowedBooks. ErrorType: " . $error->getMessage());
            return null;
        }
    }

    // returns all the unreturned books by a given user
    public function getUnreturnedBorrowedBooksByUser(int $user_id): ?array
    {
        try {
            $query = "SELECT
                        b.id, b.title, b.author, b.published_year, b.genre, b.total_copies, b.available_copies
                         FROM books AS b
                         JOIN borrowed_books AS bb ON b.id=bb.book_id
                         WHERE bb.user_id=:u_id AND bb.is_returned = 0";
            $params = [':u_id' => $user_id];
            $borrowedBook =  $this->fetchAllData($query, $params);
            return $borrowedBook ?: null;
        } catch (PDOException $error) {
            error_log("Execution Failure: Database error retrieving all books in Books::getUnreturnedBorrowedBooksByUser. ErrorType: " . $error->getMessage());
            return null;
        } catch (Exception $error) {
            error_log("Something went wrong: An unexpected error occurred in Books::getUnreturnedBorrowedBooksByUser. ErrorType: " . $error->getMessage());
            return null;
        }
    }
}
