<?php

namespace App\Models;

use App\Models\DB;
use PDOException;

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
    public function getBookById(int $id)
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
    public function getAllBooks()
    {
        $query = "SELECT * FROM books ORDER BY created_at DESC";
        $singleBook =  $this->fetchSingleData($query);
        return $singleBook;
    }
}
