<?php

namespace Models;
use Lib\BaseDatos;
use PDO;
use PDOException;


class Categoria{
    private string $id;
    private string $nombre;
    private BaseDatos $db;



    public function __construct(string $id, string $nombre){
        $this->db = new BaseDatos();
        $this->id = $id;
        $this->nombre = $nombre;

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



        // METODOS DE LA BASE DE DATOS

    public static function fromArray(array $data): Categoria{
        return new Categoria(
            $data['id'] ?? '',
            $data['nombre'] ?? '',
        );
    }



}
