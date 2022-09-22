<?php

namespace Model;
class AdminCita extends ActiveRecord{
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['id', 'hora', 'cliente', 'email', 'telefono', 'servicios', 'precio'];

    public $id;
    public $hora;
    public $cliente;
    public $email;
    public $telefono;
    public $servicios;
    public $precio;

    public function __construct($args = []) {
       $this->id = $args['id'] ?? null;
       $this->hora = $args['hora'] ?? '';
       $this->cliente = $args['cliente'] ?? '';
       $this->email = $args['email'] ?? '';
       $this->telefono = $args['telefono'] ?? '';
       $this->servicios = $args['servicios'] ?? '';
       $this->precio = $args['precio'] ?? '';
    }

}
