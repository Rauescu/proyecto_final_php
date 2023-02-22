<?php
namespace Repositories;
use Lib\BaseDatos;
use Models\Caarrito;
use Models\Categoria;
use PDOException;
class CarritoRepository {

    private BaseDatos $conexion;

    function __construct() {
        $this->conexion = new BaseDatos();
    }

    public function completar($datos): string{
        $sql = $this->conexion->prepara("INSERT INTO pedidos (usuario_id, provincia, localidad, direccion , coste , estado , fecha, hora) VALUES (:usuario_id, :provincia, :localidad, :direccion , :coste , :estado , :fecha, :hora)");
        $fecha = date('Y-m-d');
        $hora = date('h:i:s');
        $hora = strval($hora);
        $estado = 'pendiente';
        $sql->bindParam(':usuario_id',$_SESSION['usuarioa'][0]);
        $sql->bindParam(':provincia',$datos['provincia']);
        $sql->bindParam(':localidad',$datos['localidad']);
        $sql->bindParam(':direccion',$datos['direccion']);
        $sql->bindParam(':coste',$_SESSION['precio']);
        $sql->bindParam(':estado',$estado);
        $sql->bindParam(':fecha',$fecha);
        $sql->bindParam(':hora',$hora);
        try{
            $sql->execute();
            return $this->extraer_id();
        }catch(PDOException){
            return 'none';
        }
    }
    public function productos_pedidos($id):bool{
        foreach($_SESSION['carrito'] as $id_producto => $cantidad){
            if ($cantidad != 0){
                $sql = $this->conexion->prepara("INSERT INTO lineas_pedidos (pedido_id, producto_id, unidades) VALUES (:pedido_id, :producto_id, :unidades)");
                $sql->bindParam(':pedido_id',$id);
                $sql->bindParam(':producto_id',$id_producto);
                $sql->bindParam(':unidades',$cantidad);
                try{
                    $sql->execute();
                }catch(PDOException $err){
                    return false;
                }
            }
        }
        return true;
    }

    public function extraer_id(): int{
        $sql = ("SELECT MAX(id) FROM pedidos");
        $this -> conexion -> consulta($sql);
        $resultado = $this -> conexion -> extraer_registro();
        return $resultado['MAX(id)'];
        // try{
        //     return $this->conexion->execute("SELECT max(id) FROM pedidos");
        // }catch(PDOException){
        //     return 'none';
        // }
    }

    public function getAll() : ?array {
        // Funcion para extraer todas las categorias en un array
        $this->conexion->consulta("SELECT * FROM categorias");
        return $this->extraer_todos();
    }


    private function extraer_todos() : ?array {
        // Devuelve un array de las categorias (array de objetos)
        $categorias = [];
        $categoriaData = $this->conexion->extraer_todos();

        foreach ($categoriaData as $categoria) {
            $categorias[] = Categoria::fromArray($categoria);
        }
        return $categorias;
    }
    }

