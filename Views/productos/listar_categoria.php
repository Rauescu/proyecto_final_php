<?php

use Repositories\ProductosRepository;

$productos = ProductosRepository::inicio();

?>



<div class="productos">

    <?php if (isset($productos)) foreach ($productos as $p) : ?>
        <?php if ($p->getCategoria_id() == $_SESSION['id_activa']) :  ?>
            <?php if ($p->getStock() != 0) : ?>
                <div class="producto">
                    <img src="../src/zapatillas/<?= $p->getImagen() ?>.png" width=350px onerror="this.src='../src/zapatillas/error.png'">
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
            <?php endif ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>