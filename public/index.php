<?php

session_start();
require __DIR__ . '/../vendor/autoload.php';

use Controller\CarritoController;
use Controller\CategoriaController;
use Controller\ProductosController;
use Controller\UsuarioController;
use Lib\Router;
use Dotenv\Dotenv;
use Repositories\ProductosRepository;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
require_once '../Views/Layout/header.php';

//  METODOS DE USUARIO


Router::add('GET', '/', function () {
    require '../Views/inicio.php';
});

Router::add('GET', 'usuario_registro', function () {
    require '../Views/Usuario/registro.php';
});

Router::add('GET', 'usuario_login', function () {
    require '../Views/Usuario/login.php';
});

Router::add('GET', 'usuario_logout', function () {
    require '../Views/Usuario/cerrar.php';
});

Router::add('POST', 'usuario_guardar', function () {
    (new UsuarioController())->registro($_POST['data']);
});

Router::add('POST', 'usuario_iniciar', function () {
    (new UsuarioController())->login();
});

Router::add('POST', 'usuario_cerrar', function () {
    (new UsuarioController())->cerrar();
});


// CATEGORIAS


Router::add('GET', 'categoria_crear', function () {
    require '../Views/categoria/crear.php';
});
Router::add('GET', 'listar_categoria/:id', function ($id) {
    (new CategoriaController())->filtrar($id);
});
Router::add('GET', 'categoria_activa/', function () {
    require '../Views/productos/listar_categoria.php';
});
Router::add('POST', 'categoria_crear', function () {
    (new CategoriaController())->crear();
});

// PRODUCTOS
Router::add('GET', 'gestionar_productos', function () {
    require '../Views/productos/gestionar.php';
});
Router::add('GET', 'productos_nuevos', function () {
    require '../Views/productos/nuevo.php';
});
Router::add('POST', 'productos_guardar', function () {
    (new ProductosController())->nuevo();
});
Router::add('POST', 'producto_update', function () {
    (new ProductosController())->update();
});
Router::add('GET', 'producto_editar', function () {
    require '../Views/productos/editar.php';

});
Router::add('POST', 'producto_delete', function () {
    (new ProductosController())->borrar();
});
Router::add('GET', 'producto_borrar', function () {
    require '../Views/productos/borrar.php';

});

// CARRITO

Router::add('GET', 'carrito_listar', function () {
    require '../Views/carrito/listar.php';
});
Router::add('POST', 'carrito_add', function () {
    (new CarritoController())->add();
});
Router::add('POST', 'carrito_down', function () {
    (new CarritoController())->eliminar();
});
Router::add('POST', 'carrito_completar', function () {
    (new CarritoController())->completar();
});
Router::add('GET', 'completar_datos', function () {
    require '../Views/carrito/datos.php';
});

// PEDIDOS
Router::add('GET', 'listar_pedido', function () {
    require '../Views/pedido/listar.php';
});



Router::dispatch();

?>
