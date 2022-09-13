<?php

namespace Controllers;
use Model\ApiServicio;
use Model\Cita;
use MVC\Router;

class ApiController {

    public static function index( Router $router){
        $ApiServicio = ApiServicio::all();
        echo json_encode($ApiServicio);
    }

    public static function guardar(){
        $cita = new Cita($_POST);

        $resultado = $cita->guardar();

        echo json_encode($resultado);
    }
}