<?php

use Repositories\ProductosRepository;

$_SESSION['precio'] = 0;
if (!isset($_SESSION['carrito'])){
    $_SESSION['carrito'] = [];
}


?>
<?php $productos = ProductosRepository::inicio(); ?>

<h2 id="titulo_carrito">CARRITO</h2>
<div class="productos">
    <table class="gestion_productos">
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Imagen</th>
        </tr>
        <?php if (isset($_SESSION['carrito'])) foreach ($_SESSION['carrito'] as $nombre => $valor) : ?>
            <?php if (isset($productos)) foreach ($productos as $p) : ?>
                <?php if ($nombre == $p->getId() && $valor != 0) : ?>
                    <tr class="elementos">
                        <td><?= $p->getNombre() ?></td>
                        &nbsp;
                        <?php if ($p->getOferta() != 0) : ?>
                            <td> <?= $p->getOferta() ?>€</td>
                            <?php $_SESSION['precio'] += $p->getOferta() * $_SESSION['carrito'][$nombre] ?>
                        <?php else : ?>
                            <td> <?= $p->getPrecio() ?>€</td>
                            <?php $_SESSION['precio'] += $p->getPrecio() * $_SESSION['carrito'][$nombre] ?>
                        <?php endif; ?>
                        &nbsp;
                        <td>
                            <form action="carrito_down" method="POST">
                                <input type="hidden" value="<?= $p->getId() ?>" name="data[id]">
                                <button type="submit">-</button>
                            </form>
                            <?= $_SESSION['carrito'][$nombre] ?>
                            <form action="carrito_add" method="POST">
                                <input type="hidden" value="<?= $p->getId() ?>" name="data[id]">
                                <input type="hidden" value="<?= $p->getStock() ?>" name="data[cantidad]">
                                <button type="submit">+</button>
                            </form>
                        </td>
                        &nbsp;
                        <td><img src="../src/zapatillas/<?= $p->getImagen() ?>.png" width=80px></td>
                    </tr>
                    <br>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </table>
</div>
<p id="total_carrito">Total = <?= $_SESSION['precio'] ?>€</p>

<?php if($_SESSION['carrito'] != []):   ?>
<a href="completar_datos">
    <h2>Comprar</h2>
</a>
<?php endif;?>