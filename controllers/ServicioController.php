<?php 

namespace Controllers;

use MVC\Router;

class ServicioController {

public static function index (Router $router){



       $router->render('servicio/index', [
        'nombre'=> $_SESSION['nombre']

       ]);
}

public static function crear (Router $router){
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        }
   
       $router->render('servicio/crear', [
        'nombre' => $_SESSION['nombre']
    ]);
}


public static function actualizar (Router $router){

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

    }
}

public static function eliminar (Router $router){

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

    }
}

}