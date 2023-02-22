<?php
namespace Repositories;
use Lib\BaseDatos;
use Models\Categoria;
use PDOException;
class CategoriaRepository {

    private BaseDatos $conexion;

    function __construct() {
        $this->conexion = new BaseDatos();
    }

    public static function listar_inicio(){
        $categoria=new CategoriaRepository();
        $categoria->conexion->consulta("SELECT * FROM categorias");
        return $categoria->extraer_todos(); 
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
    public function save($nombre){
        $sql = $this->conexion->prepara("INSERT INTO categorias (nombre) VALUES (:nombre)");
        $sql->bindParam(':nombre',$nombre);
    try{
        $sql->execute();
    }catch(PDOException $e){
    }
    }

    public function comprueba($nombre):bool{
        $result = false;
        // Comprobar si existe.
        $cons = $this->conexion->prepara("SELECT * FROM categorias WHERE nombre = :nombre");
        $cons->bindParam(':nombre', $nombre);

        try{
            $cons->execute();
            if($cons && $cons->rowCount() == 1){
                $result = true;
                return $result;
            }else{
                return $result;
            }
        } catch(PDOException $err){
            $result = false;
        }
    }


    }

