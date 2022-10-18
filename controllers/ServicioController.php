<?php 

namespace Controllers;

use Model\ApiServicio;
use MVC\Router;

class ServicioController {

public static function index (Router $router){

    $apiservicio = ApiServicio::all();

    $router->render('servicio/index', [
        'nombre'=> $_SESSION['nombre'],
        'apiservicio' => $apiservicio

       ]);
}

public static function crear (Router $router){

    $apiservicio = new ApiServicio();
    $alertas = [];
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $apiservicio->sincronizar($_POST);
        $alertas = $apiservicio->validar();

    if(empty($alertas)) {
        
        $apiservicio->guardar();
        header('Location: /servicios');
        }
    }
   
    $router->render('servicio/crear', [
    'nombre' => $_SESSION['nombre'],
    'apiservicio' => $apiservicio,
    'alertas' => $alertas
        
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