<?php
namespace Controller;
use Models\Categoria;
use Lib\Pages;
use Services\CategoriaService;
use Utils\Utils;


class CategoriaController {
    private CategoriaService $service;
    private Pages $pages;
    private Utils $utils;


    public function __construct() {
        $this->service = new CategoriaService();
        $this->pages = new Pages();
        $this->utils = new Utils();

    }
    public function listar() : ?array {
        // Funcion para listar las categorias
        $categorias = $this->service->getAll();
        return $categorias;
        
    }
    
    public function crear(){
        // comprobamos si la categoria existe y la creamos si no
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if ($this->utils->validar_crearCategoria($_POST['nombre'])){
                $result = $this->service->comprueba($_POST['nombre']);
                if($result == false){
                    $this->service->crear($_POST['nombre']);
                    header("Location:" .$_ENV['base_url']);
                }
            }
        }
    }

    public function filtrar($id){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $_SESSION['id_activa'] = $id;
            header("Location:" . $_ENV['base_url'] . "categoria_activa");

        }
    }

}
