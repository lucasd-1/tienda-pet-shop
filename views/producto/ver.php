<?php if(isset($product)) : ?>
    <h1><?=$product->nombre?></h1>
    <div id="detail-product">
            <div class="image">
                <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>"/>
            </div>
            <div class="data">
                <h2><?= $product->nombre ?></h2>
                </a>
                <p class="description"><?= $product->descripcion ?></p>
                <p class="price"> $ <?= $product->precio ?></p>
                <a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="btn btn-success">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                    Agregar al Carrito
                </a>
            </div>
        </div>

<?php else: ?>
    <h1>El producto no existe</h1>
<?php endif; ?>
