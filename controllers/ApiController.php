<?php

namespace Controllers;
use Model\ApiServicio;
use MVC\Router;

class ApiController {

    public static function index( Router $router){
        $ApiServicio = ApiServicio::all();
        echo json_encode($ApiServicio);
    }

    public static function guardar(){
        $respuesta = [
            'mensaje' => 'Muy bien!'
        ];

        echo json_encode($respuesta);
    }
}