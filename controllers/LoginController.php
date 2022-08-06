<?php 
namespace Controllers;

use Classes\Email;
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

   $usuario = new Usuario($_POST);
   //Alertas vacias
   $alertas = [];
   
   if($_SERVER['REQUEST_METHOD'] === 'POST' ) {

      $usuario->sincronizar($_POST);
      $alertas = $usuario->validarNuevaCuenta();

      //Revisar que alerta este vacio
      if(empty($alertas)) {
         //Verificar que el usuario no este registrado
         $resultado = $usuario->existeUsuario();
         
         if($resultado->num_rows){

            $alertas = Usuario::getAlertas();

         } else {
            // hASHEAR el Password
            $usuario->hashPassword();

            //Generar token unico
            $usuario->crearToken();

            //enviar el email
            $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
            
            $email->enviarConfirmacion();

            // debuguear($usuario);
            //Crear el usuario
            $resultado = $usuario->guardar();
            
            if($resultado) {
               header('Location:/public/mensaje');
            }
           
         }
      }
   }

   $router->render('auth/crear-cuenta', [
      'usuario' => $usuario,
      'alertas' => $alertas
      
   ]);
}

   public static function mensaje(Router $router) {
      $router->render('auth/mensaje');
   }

   public static function confirmar(Router $router) {

      $alertas = [];
      $token = s($_GET['token']);
      $usuario = Usuario::where('token', $token);
      
      if(empty($usuario)){

         //Mostrar mensaje de error
         Usuario::setAlerta('error', 'Token No Valido!');

      } else {

         //Modificar a usuario confirmado
         echo "Token Valido, confirmado...!";

      }

      $alertas = Usuario::getAlertas();

      $router->render('auth/confirmar-cuenta', [
         'alertas' => $alertas
      ]);
   }


}