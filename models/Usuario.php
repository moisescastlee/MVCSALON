<?php 

namespace Model;
use Model\ActiveRecord;

class Usuario extends ActiveRecord  {
    
    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token' ];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []) {

    
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? null;
        $this->confirmado = $args['confirmado'] ?? null;
        $this->token = $args['token'] ?? '';

    }

    public function validarNuevaCuenta() {
        
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es Obligatorio';
        }

        if(!$this->apellido) {
            self::$alertas['error'][] = 'Escribe el apellido...';
        }

        if(!$this->email) {
            self::$alertas['error'][] = 'Escribe el email por favor';
        }

        if(!$this->password) {
            self::$alertas['error'][] = 'El password no es el mismo';
        }

        if(!$this->telefono) {
            self::$alertas['error'][] = 'Escribe el telefono';
        }

        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }

        return self::$alertas;
    }
    
}