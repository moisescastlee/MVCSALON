<?php 
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {

   public static function login(Router $router) {

      $alertas = [];
      $auth = new Usuario;

      if($_SERVER['REQUEST_METHOD'] === 'POST') {
         $auth = new Usuario($_POST);
         $alertas = $auth->validarLogin();

      if(empty($alertas)) {
      // Comprobar que exista el usuario
         $usuario = Usuario::where('email', $auth->email);

      if($usuario){
         // Verifica el password
          if ($usuario->comprobarPasswordAndverificado($auth->password)) {
            
            session_start();
            
            $_SESSION['id'] = $usuario->id;
            $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
            $_SESSION['email'] = $usuario->email;
            $_SESSION['login'] = true;

            //redireccionamiento
            if($usuario->admin === "1") {

               $_SESSION['admin'] = $usuario->admin ?? null;

               header('Location: admin');

            } else {

               header('Location: cita');
            }
          }

      } else {

         Usuario::setAlerta('error', 'Usuario no encontrado');

           }
         }
      }

      $alertas = Usuario::getAlertas();

      $router->render('auth/login', [
         'alertas' => $alertas,
         'auth' => $auth
      ]);
  }

 public static function logout() {
    echo "Desde logOUT";
 }


 public static function olvide(Router $router) {

   $alertas = [];

   if($_SERVER['REQUEST_METHOD'] === 'POST') {
      
      $auth = New Usuario($_POST);
      $alertas = $auth->comprobarEmail();

      if(empty($alertas)){
         $usuario = Usuario::where('email', $auth->email);
         

      if($usuario && $usuario->confirmado === "1") {
         //Generar un token
         $usuario->crearToken();
         $usuario->guardar();

         //Enviar el email
         $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
         $email ->enviarCuentaOlvidada();

         // TODO: Enviar el email
            usuario::setAlerta('exito', 'Se ha enviado un correo a su email');
      } else {
            Usuario::setAlerta('error', 'Este usuario no existe o no esta confirmado');
         }
      }
   }
   
   $alertas = Usuario::getAlertas();
   $router->render('auth/olvide-cuenta', [
      'alertas' => $alertas
       ]);
   }



public static function recuperar(Router $router) {
   $alertas = [];
   $error = false;

   $token = s($_GET['token']);
  
   //Buscar usuario por su token;
   $usuario = Usuario::where('token', $token);

   if(empty($usuario)) {
      Usuario::setAlerta('error', 'Token No Valido');
      $error = true;
   }

   if($_SERVER['REQUEST_METHOD'] === 'POST') {
      //Leer el nuevo passowrd y guardarlo
      $password = new Usuario($_POST);
      $alertas = $password->validarPassword();

   if(empty($alertas))  {
         $usuario->password = null;
         $usuario->password = $password->password;
         $usuario->hashPassword();
         $usuario->token = null;

         $resultado = $usuario->guardar();
         
         if($resultado){
            Usuario::setAlerta('exito', 'Password Aztualizado correctamente');
            header('Refresh: 3; url=/');
         }
        }
       }
  // debuguear($usuario);
   $alertas = Usuario::getAlertas();
   $router->render('auth/recuperar-password', [
      'alertas' => $alertas,
      'error' => $error
   ]);
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
               header('Location:mensaje');
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
         $usuario->confirmado = "1";
         $usuario->token = null;
         $usuario->guardar();
         Usuario::setAlerta('exito', 'Comprobada correctamente!');

      }

      //Obetener las vistas
      $alertas = Usuario::getAlertas();

      //Renderizar la vista
      $router->render('auth/confirmar-cuenta', [
         'alertas' => $alertas
      ]);
   }
}