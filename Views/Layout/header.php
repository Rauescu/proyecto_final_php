<?php

use Repositories\CategoriaRepository;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hype Market</title>
    <link rel="stylesheet" href="../css/producto.css">
    <link rel="stylesheet" href="../css/productos.css">
    <link rel="stylesheet" href="../css/header.css">

</head>

<body>

    <header>

        <nav class="navbar">
            <a href="<?= $_ENV['base_url'] ?>">
                Inicio
            </a>

            <section class="categoria">
                <?php
                $categorias = CategoriaRepository::listar_inicio();
                foreach ($categorias as $c) {
                    echo '<a href="'. $_ENV['base_url'].'listar_categoria/' . $c->getId() . '">' . $c->getNombre() . '</a> &nbsp;&nbsp;&nbsp;';
                }
                ?>
            </section>

            <section class="confusu">
                <?php if (!isset($_SESSION['usuarioa'])) : ?>
                    <a href="<?= $_ENV['base_url'] ?>usuario_login">Login</a>
                    <a href="<?= $_ENV['base_url'] ?>usuario_registro">Registro</a>
                <?php else : ?>
                    <a href="<?= $_ENV['base_url'] ?>usuario_logout">Cerrar</a>
                <?php endif ?>
                <?php if (isset($_SESSION['usuarioa']) && $_SESSION['usuarioa'][5] == 'admin') { ?>
                    <a href="<?= $_ENV['base_url'] ?>categoria_crear">Crear Categoria</a>&nbsp;
                    <a href="<?= $_ENV['base_url'] ?>gestionar_productos">Gestionar Productos</a>&nbsp;
                    <a href="<?= $_ENV['base_url'] ?>listar_pedido">Listar Pedidos</a>&nbsp;

                <?php } ?>

                <?php if (isset($_SESSION['usuarioa']) && $_SESSION['usuarioa'][5] == 'user') { ?>
                    <a href="<?= $_ENV['base_url'] ?>listar_pedido">Listar Pedido</a>

                <?php } ?>
                <a href="<?= $_ENV['base_url'] ?>carrito_listar">Carrito Listar</a>


            </section>

        </nav>
    </header>