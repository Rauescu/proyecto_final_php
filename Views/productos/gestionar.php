<?php

use Repositories\ProductosRepository;

$productos = ProductosRepository::inicio(); 

?>

<a href="<?=$_ENV['base_url']?>productos_nuevos">Añadir</a><br>
<a href="producto_editar">Editar</a><br>
<a href="producto_borrar">Borrar</a><br>

<div class="productos">
    <table class="gestion_productos">
        <tr> 
            <th>Nombre</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Oferta</th>
            <th>Imagen</th>

        </tr>
        <?php if(isset($productos)) foreach ($productos as $p):?>
            <tr>
            <td><?=$p->getNombre()?></td>
            &nbsp;
            <td><?=$p->getStock()?></td>
            &nbsp;
            <td> <?=$p->getPrecio()?>€</td>
            &nbsp;
            <?php if($p->getOferta()!= 0): ?>
                <td> <?=$p->getOferta()?>€</td>
            <?php else: ?>
                <td> NO </td>
            <?php endif; ?>
                &nbsp;
            <td><img src="../src/zapatillas/<?=$p->getImagen()?>.png" width=80px onerror="this.src='../src/zapatillas/error.png'"></td>
            </tr>
            <br>
        <?php endforeach; ?>
    </table>
        
</div>
