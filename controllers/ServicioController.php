<?php 

namespace Controllers;

use Model\ApiServicio;
use MVC\Router;

class ServicioController {

public static function index (Router $router){

    isAdmin();

    $apiservicio = ApiServicio::all();

    $router->render('servicio/index', [
        'nombre'=> $_SESSION['nombre'],
        'apiservicio' => $apiservicio

       ]);
}

public static function crear (Router $router){

    isAdmin();

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

    isAdmin();

    if(!is_numeric($_GET['id'])) return;

    $apiservicio =  ApiServicio::find($_GET['id']);
    $alertas = [];
    

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $apiservicio->sincronizar($_POST);

        $alertas = $apiservicio->validar();

        if(empty($alertas)) {
            $apiservicio->guardar();
            header('Location: /servicios');
        }
    }

    $router->render('servicio/actualizar', [
        'nombre' => $_SESSION['nombre'],
        'apiservicio' => $apiservicio,
        'alertas' => $alertas
    ]);
}

public static function eliminar() {

    isAdmin();

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        
        $id = $_POST['id'];
        $apiservicio = ApiServicio::find($id);
        $apiservicio->eliminar();
        header('Location: /servicios');
        

        }
    }
}