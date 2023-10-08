<?php

class Persona {
    protected $id;
    protected $nombre;
    protected $usuario;
    protected $contrasena;

    public function __construct($id, $nombre, $usuario, $contrasena) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getContrasena() {
        return $this->contrasena;
    }
}

class Secretaria extends Persona {
    private $numeroSecretaria;

    public function __construct($id, $nombre, $usuario, $contrasena, $rolSecretaria) {
        parent::__construct($id, $nombre, $usuario, $contrasena);
        $this->rolSecretaria = $rolSecretaria;
    }

    public function getNumeroSecretaria() {
        return $this->rolSecretaria;
    }
}

class Director extends Persona {
    private $rolDirector;

    public function __construct($id, $nombre, $usuario, $contrasena, $rolDirector) {
        parent::__construct($id, $nombre, $usuario, $contrasena);
        $this->rolDirector = $rolDirector;
    }

    public function getNumeroDirector() {
        return $this->rolDirector;
    }
}

class Area {
    protected $nombreArea;

    public function __construct($nombreArea) {
        $this->nombreArea = $nombreArea;
    }

    public function getNombreArea() {
        return $this->nombreArea;
    }
}

class Profesional {
    protected $nombreProfesional;

    public function __construct($nombreProfesional) {
        $this->nombreProfesional = $nombreProfesional;
    }

    public function getNombreProfesional() {
        return $this->nombreProfesional;
    }
}

class Turno extends Area {
    private $id;
    private $dni;
    private $apellido;
    private $nombre;
    private $mail;
    private $telefono;
    private $fecha;
    private $horario;
    private $nombreProfesional;

    public function __construct($id, $dni, $apellido, $nombre, $mail, $telefono, $fecha, $horario, $nombreArea, $nombreProfesional) {
        parent::__construct($nombreArea);
        $this->id = $id;
        $this->dni = $dni;
        $this->apellido = $apellido;
        $this->nombre = $nombre;
        $this->mail = $mail;
        $this->telefono = $telefono;
        $this->fecha = $fecha;
        $this->horario = $horario;
        $this->nombreProfesional = $nombreProfesional;
    }

    public function getId() {
        return $this->id;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getHorario() {
        return $this->horario;
    }

    public function getNombreProfesional() {
        return $this->nombreProfesional;
    }
}

class ConexionBD {
    private $host = "localhost"; // Cambia el host según tu configuración
    private $usuario = "tu_usuario"; // Cambia el usuario de la base de datos
    private $contrasena = "tu_contrasena"; // Cambia la contraseña de la base de datos
    private $nombreBD = "nombre_bd"; // Cambia el nombre de la base de datos
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->nombreBD);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function getConexion() {
        return $this->conexion;
    }

    public function cerrar() {
        $this->conexion->close();
    }
}




?>
