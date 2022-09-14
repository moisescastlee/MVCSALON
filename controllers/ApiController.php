<?php

namespace Controllers;
use Model\ApiServicio;
use Model\Cita;
use Model\CitaServicios;
use MVC\Router;

class ApiController {

public static function index( Router $router){
        $ApiServicio = ApiServicio::all();
        echo json_encode($ApiServicio);
    }

public static function guardar(){
//Almacena la cita y devuelve el ID

       $cita = new Cita($_POST);
       $resultado = $cita->guardar();

       $id = $resultado['id'];

//Almacena los servicios con el ID de la cita
    $idServicios = explode(",", $_POST['servicios']);
        foreach($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicios($args);
            $citaServicio->guardar();
        }
        
//retornar una respuesta
        echo json_encode(['resultado' => $resultado]);
    }
}