<?php

namespace Models;
use Lib\BaseDatos;
use PDO;
use PDOException;


class Pedido{

    function __construct(
        private int $id,
        private string $usuario_id,
        private string $provincia,
        private string $localidad,
        private string $direccion,
        private string $coste,
        private string $estado,
        private string $fecha,
        private string $hora,
    )
    {}

    public function getId()
    {
            return $this->id;
    }

    public function setId($id)
    {
            $this->id = $id;

            return $this;
    }


    public function getUsuario_id()
    {
            return $this->usuario_id;
    }

    public function setUsuario_id($usuario_id)
    {
            $this->usuario_id = $usuario_id;

            return $this;
    }

    public function getProvincia()
    {
            return $this->provincia;
    }

    public function setProvincia($provincia)
    {
            $this->provincia = $provincia;

            return $this;
    }


    public function getLocalidad()
    {
            return $this->localidad;
    }

    public function setLocalidad($localidad)
    {
            $this->localidad = $localidad;

            return $this;
    }


    public function getDireccion()
    {
            return $this->direccion;
    }

    public function setDireccion($direccion)
    {
            $this->direccion = $direccion;

            return $this;
    }


    public function getCoste()
    {
            return $this->coste;
    }


    public function setCoste($coste)
    {
            $this->coste = $coste;

            return $this;
    }

    public function getEstado()
    {
            return $this->estado;
    }


    public function setEstado($estado)
    {
            $this->estado = $estado;

            return $this;
    }

    public function getFecha()
    {
            return $this->fecha;
    }

    public function setFecha($fecha)
    {
            $this->fecha = $fecha;

            return $this;
    }

    
    public function getHora()
    {
            return $this->hora;
    }

    
    public function setHora($hora)
    {
            $this->hora = $hora;

            return $this;
    }

    public static function fromArray(array $data):Pedido{
        return new Pedido(
            $data['id'] ?? '',
            $data['usuario_id'] ?? '',
            $data['provincia'] ?? '',
            $data['localidad'] ?? '',
            $data['direccion'] ?? '',
            $data['coste'] ?? '',
            $data['estado'] ?? '',
            $data['fecha'] ?? '',
            $data['hora'] ?? '',
        );
    }


}

