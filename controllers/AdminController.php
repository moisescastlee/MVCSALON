<?php

namespace Controllers;

use MVC\Router;

class AdminController {
    public static function index( Router $router ) {
        isAuth();
        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre']     
        ]);
    }

}