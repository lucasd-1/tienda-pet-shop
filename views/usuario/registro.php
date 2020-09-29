
<h1>Registrarse</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
	<strong class="alert_green">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
	<strong class="alert_red">Registro fallido, introduce bien los datos</strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>

<form action="<?=base_url?>usuario/save" method="POST">
	<label for="nombre">Nombre*</label>
	<input type="text" name="nombre" required/>
	
	<label for="apellidos">Apellidos*</label>
	<input type="text" name="apellidos" required/>
	
	<label for="email">Email*</label>
	<input type="email" name="email" required/>
	
	<label for="password">Contraseña*</label>
	<input type="password" name="password" required/>
        
    <label for="dni">DNI*</label>
	<input type="number"
           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
           name="dni" maxlength="10" required>
        
    <label for="telefono">Telefono</label>
	<input type="number"
           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
           maxlength="10" name="telefono">
        
    <label for="direccion">Direccion</label>
	<input type="text" name="direccion" >

    <label for="provincia">Provincia</label>
    <select name="provincia" id="provincia">
        <?php while ($prov = $provincias->fetch_object()): ?>
            <option value="<?=$prov->id?>"><?=$prov->provincia?></option>
        <?php endwhile; ?>
    </select>

    <label for="localidad">Localidad</label>
    <div id="opciones_localidades">
        <select name="localidad" id="localidad">
            <?php while ($loc = $localidades->fetch_object()): ?>
                <option value="<?=$loc->id?>"><?=$loc->localidad?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <label for="userName">Elija un nombre de usuario</label>
	<input type="text" name="username">
        
    <label for="imagenusuario">Imagen</label>
    <?php if(isset($pro) && is_object($pro) && !empty($pro->imagenusuario)) : ?>
        <img src="<?=base_url?>uploads/imgsUsers/<?=$pro->imagenusuario?>" class="thumb" />
    <?php endif; ?>
    <input type="file" name="imagenusuario" />

    <p><br>*Los datos con asterisco son obligatorios </p>
	
	<input type="submit" value="Registrarse" />
</form>