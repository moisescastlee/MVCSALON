<?php 
namespace Controllers;

use Model\Usuario;
use MVC\Router;

class LoginController {
   public static function login(Router $router) {
      $router->render('auth/login');
  }

 public static function logout() {
    echo "Desde logOUT";
 }

 public static function olvide(Router $router) {
    $router->render('auth/olvide-cuenta', [

    ]);
 }

 public static function recuperar() {
   echo "Desde recuperar";
}

public static function crear(Router $router) {
   
   if($_SERVER['REQUEST_METHOD'] === 'POST' ) {

      $usuario = new Usuario($_POST);

      debuguear($usuario);
   }

   $router->render('auth/crear-cuenta', [

      ]);
   }
}