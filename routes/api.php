<?php

use App\Http\Controllers\Api\ClientApiController;
use CustomRouter\Route;

require __DIR__ . '/../vendor/autoload.php';

Route::get('/record_management_system/api/client/books', [ClientApiController::class, 'getAvailableBooks']);
