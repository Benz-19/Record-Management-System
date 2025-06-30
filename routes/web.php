<?php

use App\Core\BaseController;
use CustomRouter\Route;

require __DIR__ . '/../vendor/autoload.php';

Route::get('/record%20management%20system/', function () {
    $controller = new BaseController();
    $controller->renderView('pages/landing');
});
