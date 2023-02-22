<?php

namespace Controller;

use Lib\Pages;
use Services\CarritoService;
use Services\ProductosService;
use Utils\Utils;

class CarritoController
{
    private Pages $pages;
    private ProductosService $productosservice;
    private CarritoService $service;
    private Utils $utils;


    public function __construct()
    {
        $this->pages = new Pages();
        $this->productosservice = new ProductosService();
        $this->service = new CarritoService();
        $this->utils = new Utils();
    }

    public function listar()
    {
        // Funcion para listar los productos dentro del carrito
        $productos = $this->productosservice->getAll();
        $this->pages->render("carrito/listar", ["productos" => $productos]);
    }

    public function add()
    {
        // funcion para añadir productos al carrito
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $_POST['data'];
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }
            // se comprieba si existe el producto que buscamos, si existe se le suma uno sino se inicializa
            if (isset($_SESSION['carrito'][$datos['id']])) {
                if ($_SESSION['carrito'][$datos['id']] < $datos['cantidad']) {
                    $_SESSION['carrito'][$datos['id']] += 1;
                }
            } else {
                $_SESSION['carrito'][$datos['id']] = 1;
            }
            header("Location:" . $_ENV['base_url'] . "carrito_listar");
        }
    }

    public function eliminar()
    {
        // funcion para eliminar o cantidad o el producto del carrito
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['data']['id'];

            if (isset($_SESSION['carrito'][$id])) {
                if ($_SESSION['carrito'][$id] > 0) {
                    $_SESSION['carrito'][$id] -= 1;
                }
            }
        }

        header("Location:" . $_ENV['base_url'] . "carrito_listar");
    }


    public function completar()
    {
        // funcion para procesar el resto de la informacion necesaria para la compra y las transacciones.
        if (!isset($_SESSION['usuarioa'])) {
            header("Location:" . $_ENV['base_url'] . "usuario_login");
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($this->utils->validar_crearPedido($_POST['datos'])) {
                    $result = $this->service->completar($_POST['datos']);
                    if ($result != 'none') {
                        if ($this->service->productos_pedidos($result)) {
                            if ($this->productosservice->actualizar_stock()) {
                                header("Location:" . $_ENV['base_url']);
                                $this->pages->render("principal/enviar_email", ["id_pedido" => $result]);
                                $_SESSION['carrito'] = [];
                            } else {
                                // Error de actualizacion de stock
                                $this->pages->render("carrito/error");
                            }
                        } else {
                            // Error de transaccion
                            $this->pages->render("carrito/error");
                        }
                    } else {
                        // Error de transaccion
                        $this->pages->render("carrito/error");
                    }
                }else{
                    echo 'error';
                }
            }
        }
    }
}
