
<h3>Productos:</h3>

<?php

use Repositories\ProductosRepository;

$productos = ProductosRepository::inicio(); ?>
<?php if (isset($productos)) foreach ($productos as $p) : ?>
    <?php if ($p->getStock() != 0) : ?>
        <?php $_SESSION['stock_productos'][$p->getId()] = $p->getStock()  ?>
        <div class="producto">
            <img src="../src/zapatillas/<?= $p->getImagen() ?>.png" onerror="this.src='../src/zapatillas/error.png'" width=350px>
            <p><?= $p->getNombre() ?></p>
            <?php if ($p->getOferta() > 0.1) : ?>
                <p><?= $p->getOferta() ?>€
                    <del><?= $p->getPrecio() ?>€</del>
                    Stock: <?= $p->getStock() ?>
                </p>
            <?php else : ?>
                <p><?= $p->getPrecio() ?>€&nbsp;&nbsp;
                    Stock: <?= $p->getStock() ?>
                </p>
            <?php endif; ?>
            <form action="carrito_add" method="POST">
                <input type="hidden" value="<?= $p->getId() ?>" name="data[id]">
                <input type="hidden" value="<?= $p->getStock() ?>" name="data[cantidad]">
                <button type="submit">Añadir</button>
            </form>
        </div>
    <?php endif;  ?>
<?php endforeach; ?>