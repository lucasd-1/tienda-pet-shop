<h1>Actualizar contraseña</h1>
<div class="form_container">
    <form action="resetpass" method="POST">
        <?php if(isset($error)):?>
            <div class="form-group">
                <strong class="alert_red"><?=$error?></strong>
            </div>
        <?php elseif(isset($success)):?>
            <div class="form-group">
                <strong ><?=$success?></strong>
            </div>
        <?php else:?>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" placeholder="Escribe tu nueva contraseña.." required/>
            </div>

            <input type="hidden"  name="token" value="<?=$usuario->getToken()?>" />
            <input type="hidden"  name="email" value="<?=$usuario->getEmail()?>" />

            <button type="submit" class="btn btn-primary"  name="resetpass">Actualizar contraseña</button>
        <?php endif; ?>
        <?php if(isset($success)):?>
            <a href="<?=base_url?>/" class="btn btn-default">Inicio</a>
        <?php endif; ?>
        <a href="<?=base_url?>usuario/recuperarPass" class="btn btn-default">Cancelar</a>
    </form>
</div>