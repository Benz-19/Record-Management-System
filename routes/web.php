<?php

use CustomRouter\Route;
use App\Core\BaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Auth\AuthController;

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


// Client Functionalities
Route::get('/record_management_system/client/dashboard', [PagesController::class, 'renderClientDashboard']);
