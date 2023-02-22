<?php

namespace Repositories;

use Lib\BaseDatos;
use Models\Productos;
use PDO;
use PDOException;

class ProductosRepository
{

    private BaseDatos $conexion;

    function __construct()
    {
        $this->conexion = new BaseDatos();
    }


    public function getAll(): ?array
    {
        // Devuelve un array con todos los productos
        $this->conexion->consulta("SELECT * FROM productos");
        return $this->extraer_todos();
    }

    public static function inicio(): ?array
    {
        $productos = new ProductosRepository;
        // Devuelve un array con todos los productos
        $productos->conexion->consulta("SELECT * FROM productos");
        return $productos->extraer_todos();
    }

    private function extraer_todos(): ?array
    {
        // Devuelve un array con todos los productos(objetos)

        $productos = [];
        $productoData = $this->conexion->extraer_todos();

        foreach ($productoData as $producto) {
            $productos[] = Productos::fromArray($producto);
        }
        return $productos;
    }

    public function save(array $data): bool
    {
        $fechaActual = date('Y-m-d');
        // PROCEDEMOS A REALIAZR LA LA CONSULTA A REALIZAR
        $sql = $this->conexion->prepara("INSERT INTO productos (categoria_id,nombre,descripcion,precio,stock,oferta,fecha,imagen) VALUES((SELECT id FROM categorias WHERE nombre = :categoria),:nombre,:descripcion,:precio,:stock,:oferta,:fecha,:imagen)");
        // Realizamos el bim param para insertar los datos en la consulta que vamos a realizar
        $sql->bindParam(':categoria', $data['categoria']);
        $sql->bindParam(':nombre', $data['nombre']);
        $sql->bindParam(':descripcion', $data['descripcion']);
        $sql->bindParam(':precio', $data['precio']);
        $sql->bindParam(':stock', $data['stock']);
        $sql->bindParam(':oferta', $data['oferta']);
        $sql->bindParam(':fecha', $fechaActual);
        $sql->bindParam(':imagen', $data['imagen']);
        // se procede a hacer la ejecucion
        try {
            $sql->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }
    public function update(array $data): bool
    {
        $fechaActual = date('Y-m-d');
        // PROCEDEMOS A REALIAZR LA LA CONSULTA A REALIZAR
        $sql = $this->conexion->prepara("UPDATE productos SET categoria_id=:categoria,descripcion=:descripcion,precio=:precio,stock=:stock,oferta=:oferta,fecha=:fecha WHERE id=:id;");
        // Realizamos el bim param para insertar los datos en la consulta que vamos a realizar
        $sql->bindParam(':id', $data['id']);
        $sql->bindParam(':categoria', $data['categoria']);
        $sql->bindParam(':descripcion', $data['descripcion']);
        $sql->bindParam(':precio', $data['precio']);
        $sql->bindParam(':stock', $data['stock']);
        $sql->bindParam(':oferta', $data['oferta']);
        $sql->bindParam(':fecha', $fechaActual);
        // se procede a hacer la ejecucion
        try {
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            // return false;
            echo "Excepcion capturada: ".$e->getMessage();
            die();
        }
    }


    public function borrar($id): bool
    {
        $fechaActual = date('Y-m-d');
        // PROCEDEMOS A REALIAZR LA LA CONSULTA A REALIZAR
        $sql = $this->conexion->prepara("UPDATE productos SET stock=0 WHERE id=:id;");
        // Realizamos el bim param para insertar los datos en la consulta que vamos a realizar
        $sql->bindParam(':id', $id);
        // se procede a hacer la ejecucion
        try {
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            // return false;
            echo "Excepcion capturada: ".$e->getMessage();
            die();
        }
    }

    public function actualizar_stock(): bool
    {
        foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
            if ($cantidad != 0) {
                $stock = $_SESSION['stock_productos'][$id_producto] - $cantidad;
                $sql = $this->conexion->prepara("UPDATE productos SET stock = :stock WHERE id = :id");
                $sql->bindParam(':id', $id_producto);
                $sql->bindParam(':stock', $stock);
                try {
                    $sql->execute();
                } catch (PDOException $err) {
                    return false;
                }
            }
        }
        return true;
    }
}
