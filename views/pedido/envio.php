<?php if(isset($_SESSION['identity'])) :?>
    <h1>Completar datos de envío</h1>
    <p>
        <a href="<?=base_url?>carrito/index">Ver los productos y el precio del pedido</a>
    </p>

    <br/>
    <h3>Dirección para envío</h3>
    <form action="<?=base_url.'pedido/pago'?>" method="POST">
        <div class="form-group">
            <label for="provincia">Provincia</label>
            <select name="provincia" id="provincia">
                <?php while ($prov = $provincias->fetch_object()): ?>
                    <option value="<?=$prov->id?>"><?=$prov->provincia?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="localidad">Localidad</label>
            <div id="opciones_localidades">
                <select name="localidad" id="localidad">
                    <?php while ($loc = $localidades->fetch_object()): ?>
                        <option value="<?=$loc->id?>"><?=$loc->localidad?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" required/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Ir al Pago</button>
        </div>
    </form>
    
<?php else :?>
    <h1>Necesitas estar identificado</h1>
    <p>Para poder realizar tu pedido necesitas estar logueado en la web</p>
<?php endif; ?>