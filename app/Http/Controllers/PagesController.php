<?php

namespace App\Http\Controllers;

use App\Core\BaseController;

class PagesController
{

    public static function renderLandingPage()
    {
        $controller = new BaseController();
        $controller->renderView('/pages/landing');
    }

    public static function renderLoginPage()
    {
        $controller = new BaseController();
        $controller->renderView('/auth/login');
    }

    public static function renderRegisterPage()
    {
        $controller = new BaseController();
        $controller->renderView('/auth/register');
    }

    public static function renderAdminDashboard()
    {
        $controller = new BaseController();
        $controller->renderView('/admin/dashboard');
    }

    public static function renderClientDashboard()
    {
        $controller = new BaseController();
        $controller->renderView('/client/dashboard');
    }
}
