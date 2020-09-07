<?php if(isset($edit) && isset($pro) && is_object($pro)): ?>
    <h1>Editar producto <?=$pro->nombre?></h1>
    <?php $url_action = base_url."producto/save&id=".$pro->id; ?>
<?php else: ?>    
    <h1>Crear nuevos Productos</h1>
    <?php $url_action = base_url."producto/save"; ?>
<?php endif; ?>
    
<div class="form_container">
    
    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?=isset($pro) && is_object($pro) ? $pro->nombre : ''?>" required="" />
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion"><?=isset($pro) && is_object($pro) ? $pro->descripcion : ''?></textarea>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input class="form-control" type="text" name="precio" value="<?=isset($pro) && is_object($pro) ? $pro->precio : ''?>"  required/>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input class="form-control" type="number" name="stock" value="<?=isset($pro) && is_object($pro) ? $pro->stock : ''?>" required/>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria</label>
            <?php $categorias = utils::showCategorias(); ?>
            <select class="form-control" name="categoria" required>
                <?php while ($cat = $categorias->fetch_object()): ?>
                    <option value="<?= $cat->id ?>" <?=isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ? 'selected' : ''?>>
        <?= $cat->nombre ?>
            </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="subcategoria">Subcategoria</label>
            <?php $subcategorias = utils::showSubcategorias(); ?>
            <select class="form-control" name="subcategoria" required>
                <?php while ($cat = $subcategorias->fetch_object()): ?>
                    <option value="<?= $cat->id ?>" <?=isset($pro) && is_object($pro) && $cat->id == $pro->subcategoria_id ? 'selected' : ''?>>
                        <?= $cat->nombre ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="oferta">Oferta</label>
            <input class="form-control" type="text" name="oferta" value="<?=isset($pro) && is_object($pro) ? $pro->oferta : ''?>"  />
        </div>
        <div class="form-group">
            <label for="proveedor">Proveedor</label>
            <input class="form-control" type="text" name="proveedor" value="<?=isset($pro) && is_object($pro) ? $pro->proveedor : ''?>" />
        </div>
        <div class="form-group">
            <label for="tags">Tags</label>
            <input class="form-control" type="text" name="tags" value="<?=isset($pro) && is_object($pro) ? $pro->tags : ''?>"  />
        </div>
        <div class="form-group">
            <?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)) : ?>
                <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" class="thumb" />
                <a class="btn btn-default edit-image">Editar Imagen 1</a>
                <input class="form-control-file" type="file" name="imagen1" style="display: none"/>
            <?php else: ?>
                <input class="form-control-file" type="file" name="imagen1" required/>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <input type="hidden" name="imagen2_current" value="<?=$pro->img2?>"/>
            <?php if(isset($pro) && is_object($pro) && !empty($pro->img2)) : ?>
                <img src="<?=base_url?>uploads/images/<?=$pro->img2?>" class="thumb" />
                <a class="btn btn-default edit-image">Editar Imagen 2</a>
                <a class="btn btn-default delete-image">Borrar Imagen 2</a>
                <input class="form-control-file" type="file" name="imagen2" style="display: none"/>
            <?php else: ?>
                <label for="imagen2">Agregar imagen 2</label>
                <input class="form-control-file" type="file" name="imagen2"/>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <input type="hidden" name="imagen3_current" value="<?=$pro->img3?>"/>
            <?php if(isset($pro) && is_object($pro) && !empty($pro->img3)) : ?>
                <img src="<?=base_url?>uploads/images/<?=$pro->img3?>" class="thumb" />
                <a class="btn btn-default edit-image">Editar Imagen 3</a>
                <a class="btn btn-default delete-image">Borrar Imagen 3</a>
                <input class="form-control-file" type="file" name="imagen3" style="display: none"/>
            <?php else: ?>
                <label for="imagen3">Agregar imagen 3</label>
                <input class="form-control-file" type="file" name="imagen3"/>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="<?=base_url?>producto/gestion" class="btn btn-default">Cancelar</a>

    </form>
</div>
