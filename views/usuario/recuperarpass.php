<h1>Recuperar contraseña</h1>
<div class="form_container">
    <form action="recuperarPass" method="POST">

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Escribe tu dirección de email..." required/>
        </div>
        <p>
            <?php if(isset($error)):?>
                <strong class="alert_red"><?=$error?></strong>
            <?php elseif(isset($result)):?>
                <strong><?=$result?></strong>
            <?php endif; ?>
        </p>

        <button type="submit"
                class="btn btn-primary"
                data-loading-text="Enviando..."
                id="enviar-email"
                name="recuperarPass">
            Recuperar Contraseña
        </button>
    </form>
</div>