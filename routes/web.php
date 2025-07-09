<?php

use CustomRouter\Route;
use App\Core\BaseController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Pages\PagesController;


require __DIR__ . '/../vendor/autoload.php';

Route::get('/record_management_system/', [PagesController::class, 'renderLandingPage']);

// Authenticate User
Route::get('/record_management_system/login', [PagesController::class, 'renderLoginPage']);
Route::post('/record_management_system/login', [AuthController::class, 'login']);
Route::get('/record_management_system/logout', [AuthController::class, 'logout']);

Route::get('/record_management_system/register', [PagesController::class, 'renderRegisterPage']);
Route::post('/record_management_system/register', [AuthController::class, 'register']);


// Admin Functionalities
Route::get('/record_management_system/admin/dashboard', [PagesController::class, 'renderAdminDashboard']);
Route::get('/record_management_system/admin/add-book', [PagesController::class, 'renderAddNewBookRecord']);
Route::get('/record_management_system/admin/display-all-books', [PagesController::class, 'displayAllBookRecords']);
Route::get('/record_management_system/admin/view-users', [PagesController::class, 'renderViewUsers']);
Route::post('/record_management_system/admin/process-add-book', [BookController::class, 'addRecord']);


// Client Functionalities
Route::get('/record_management_system/client/dashboard', [PagesController::class, 'renderClientDashboard']);
