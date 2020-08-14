<?php

 if (isset($categoria)) : ?>
    <h1><?= $categoria->nombre ?></h1>
<?php elseif (isset($subcategoria)) : ?>
    <h1><?= $subcategoria->nombre ?></h1>
<?php else: ?>
    <h1>Resultados de la busqueda</h1>
<?php endif; ?>
    
<?php if ($productos->num_rows == 0): ?>
    <p>No hay productos para mostrar</p>
<?php else: ?>
    <?php while ($product = $productos->fetch_object()): ?>
        <div class="product">
            <a href="<?= base_url ?>producto/ver&id=<?= $product->id ?>">
                <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>"/>
                <h2><?= $product->nombre ?></h2>
            </a>
            <p><?= $product->precio ?></p>
            <a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="button">Comprar</a>
        </div>
    <?php endwhile; ?>

<?php endif; ?>