<?php
namespace Repositories;
use Lib\BaseDatos;
use Models\Usuario;
use PDO;
use PDOException;

class UsuarioRepository {

    private BaseDatos $conexion;

    function __construct() {
        $this->conexion = new BaseDatos();
    }

    public function comprueba($email):bool{
        $result = false;
        // Comprobar si existe.
        $cons = $this->conexion->prepara("SELECT * FROM usuarios WHERE email = :email");
        $cons->bindParam(':email', $email);
        try{
            $cons->execute();
            if($cons && $cons->rowCount() == 1){
                $result = true;
            }
        } catch(PDOException $err){
            $result = false;
        }
        return $result;
    }

    public function save($user) :bool {
        $sql = $this->conexion->prepara("INSERT INTO usuarios (id, nombre,apellidos,email,password, rol) VALUES (:id, :nombre, :apellidos, :email, :password, :rol)");
        $sql->bindParam(':id',$id);
        $sql->bindParam(':nombre',$nombre,PDO::PARAM_STR);
        $sql->bindParam(':apellidos',$apellidos,PDO::PARAM_STR);
        $sql->bindParam(':email',$email,PDO::PARAM_STR);
        $sql->bindParam(':password',$password, PDO::PARAM_STR);
        $sql->bindParam(':rol',$rol,PDO::PARAM_STR); 

        $id = NULL;
        $nombre=$user['nombre'];
        $apellidos=$user['apellidos'];
        $email=$user['email'];
        $password=$user['password'];
        $rol='user';
    try{
        $sql->execute();
        $result = true;
    }catch(PDOException $e){
        $result = false;
    }
    return $result;
    }

    public function login($datos) :array {
        $email = $datos['email'];
        $password = $datos['password'];
        $sql = $this->conexion->prepara("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindParam(':email',$email,PDO::PARAM_STR);
        try{
            $sql->execute();
            $resultado = $sql->fetchAll();
            if (count($resultado)!=0){
                $extraidos = [$resultado[0]['id'],$resultado[0]['nombre'],$resultado[0]['apellidos'],$resultado[0]['email'],$resultado[0]['password'],$resultado[0]['rol']];        
                return $extraidos;
            }else{
                return [];
            }
        }catch(PDOException $e){
            echo "Excepcion capturada: ".$e->getMessage();
        }
    }
    
}