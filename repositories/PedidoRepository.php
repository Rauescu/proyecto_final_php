<?php
namespace Repositories;
use Lib\BaseDatos;
use Models\Pedido;


class PedidoRepository {

    private BaseDatos $conexion;

    function __construct() {
        $this->conexion = new BaseDatos();
    }

    public static function getAll() : ?array {
        // Funcion para extraer todas los pedidos en un array
        $resultado = new PedidoRepository;
        $resultado ->conexion->consulta("SELECT * FROM pedidos");
        return $resultado->extraer_todos();
    }


    private function extraer_todos() : ?array {
        $pedidos = [];
        $pedidoData = $this->conexion->extraer_todos();

        foreach ($pedidoData as $pedido) {
            $pedidos[] = Pedido::fromArray($pedido);
        }
        return $pedidos;
    }
    }

