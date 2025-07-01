<?php

use App\Core\BaseController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use CustomRouter\Route;

require __DIR__ . '/../vendor/autoload.php';

Route::get('/record_management_system/', [PagesController::class, 'renderLandingPage']);

// Authenticate User
Route::get('/record_management_system/login', [PagesController::class, 'renderLoginPage']);
Route::post('/record_management_system/login', [AuthController::class, 'processLogin']);

Route::get('/record_management_system/register', [PagesController::class, 'renderRegisterPage']);
Route::post('/record_management_system/register', [AuthController::class, 'processRegister']);
