<?php
namespace Controller;
use Models\Productos;
use Lib\Pages;
use Services\ProductosService;
use Utils\Utils;



class ProductosController {
    private ProductosService $service;
    private Pages $pages;
    private CategoriaController $categoria;
    private Utils $utils;


    public function __construct() {
        $this->service = new ProductosService();
        $this->pages = new Pages();
        $this->categoria = new CategoriaController();
        $this->utils = new Utils();

    }

    public function listar() : void {
        // funcion para listar los productos
        $productos = $this->service->getAll(); //Llamada al servicio para devolver los productos
        $this->pages->render("productos/listar", ["productos" => $productos]);
    }

    public function nuevo() : void {
        // funcion para crear los productos
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if ($this->utils->validar_crearProductos($_POST['data'])){
                $imagen = str_replace(' ', '', $_POST['data']['nombre']);
                $imagen = strtolower($imagen);
                $_POST['data']['imagen'] = $imagen;
                if($this->service->save($_POST['data'])){
                    echo 'guardado';
                }
            }else{
                header("Location:" . $_ENV['base_url'] . "productos_nuevos");
            }
        }
    }

    public function update(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if ($this->utils->validar_updateProductos($_POST['data'])){
                if($this->service->update($_POST['data'])){
                    header("Location:" . $_ENV['base_url']);
                }else{
                    echo 'error intentelo mas tarde';
                }
            }else{
                header("Location:" . $_ENV['base_url'] . "producto_editar");
            }
        }
    }

    public function borrar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
                if($this->service->borrar($_POST['data']['id'])){
                    header("Location:" . $_ENV['base_url']);
                }else{
                    echo 'error intentelo mas tarde';
                }
            }else{
                header("Location:" . $_ENV['base_url'] . "producto_editar");
            }
    }
    


    public function listar_categoria(){
        // funcion para listar las categorias en el formulario de los productos
        $productos = $this->service->getAll(); //Llamada al servicio para devolver los productos
        $this->pages->render("productos/listar_categoria", ["productos" => $productos , "cat_id"=>$_GET['cat_id']]);
    }



}
