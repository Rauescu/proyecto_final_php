<?php

namespace Models;
use PDO;
use PDOException;


class Usuario{
    private string $id;
    private string $nombre;
    private string $apellidos;
    private string $email;
    private string $password;
    private string $rol;




    public function __construct(string $id, string $nombre, string $apellidos, string $email, string $password, string $rol ){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;

    }

    public function getId():int{
        return $this->id;
    }

    public function setId(int $id){
        $this->id=$id;
    }


    public function getNombre():string{
        return $this->nombre;
    }

    public function setNombre(string $nombre){
        $this->nombre=$nombre;
    }


    
    public function getApellidos():string{
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos){
        $this->apellidos=$apellidos;
    }


    
    public function getEmail():string{
        return $this->email;
    }

    public function setEmail(string $email){
        $this->email=$email;
    }


    public function getPassword():string{
        return $this->password;
    }

    public function setPassword(string $password){
        $this->password=$password;
    }

    public function getRol():string{
        return $this->rol;
    }

    public function setRol(string $rol){
        $this->rol=$rol;
    }


    // METODOS DE LA BASE DE DATOS

public function getAll(): ?array{
    $this->consulta("SELECT * FROM usuarios");
    return $this->extraer_todos();
}

public static function fromArray(array $data): Usuario{
    return new Usuario(
        $data['id'] ?? '',
        $data['nombre'] ?? '',
        $data['apellidos'] ?? '',
        $data['email'] ?? '',
        $data['password'] ?? '',
        $data['rol'] ?? '',
    );
}

}
