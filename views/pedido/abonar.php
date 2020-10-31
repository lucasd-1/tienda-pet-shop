<h1>Abonar el pedido</h1>

<?php if(isset($_SESSION['identity'])) :?>
<br/>

<div id="abonar-pedido">

    <div id="selector-pago">
            <p>Puedes abonar tu pago ahora con tarjetas de crédito de todos los bancos o bien hacerlo después en efectivo / transferencia / depósito</p>
            <div class="row">
            <div class="col-sm-6" style="text-align: center">
                <form action="<?=base_url?>pedido/add" method="POST">
                    <input type="hidden" name="provincia" value=<?=$provincia?>>
                    <input type="hidden" name="localidad" value=<?=$localidad?>>
                    <input type="hidden" name="direccion" value=<?=$direccion?>>
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-usd"></span> Pago Offline</button>
                </form>
            </div>
            <div class="col-sm-6" style="text-align: center">
                <span id="activar-pago-online" class="btn btn-default"><span class="glyphicon glyphicon-credit-card"></span>
                    Pago Online
                </span>
            </div>
        </div>


    </div>

    <div id="pago-online" style="display: none;">
        <form action="<?=base_url?>pedido/add" method="POST">
            <section>
                <h2>Información de pago</h2>
                <p>
                    <label for="card">
                        <span>Tipo de tarjeta:</span>
                    </label>
                    <select id="card" name="usercard">
                        <option value="visa">Visa</option>
                        <option value="mc">Mastercard</option>
                        <option value="amex">American Express</option>
                    </select>
                </p>
                <p>
                    <label for="cuotas">
                        <span>Cantidad de cuotas:</span>
                    </label>
                    <select id="cuotas" name="usercuotas">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="6">6</option>
                        <option value="12">12</option>
                    </select>
                </p>
                <p>
                    <label for="number">
                        <span>Número de tarjeta:</span>
                        <strong><abbr title="required">*</abbr></strong>
                    </label>
                    <input type="number"
                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                           maxlength="16" name="cardnumber">
                </p>
                <p>
                    <label for="date">
                        <span>Fecha de caducidad:</span>
                        <strong><abbr title="required">*</abbr></strong>
                        <em>el formato mm/aa</em>
                    </label>
                    <input type="date" id="date" name="expiration">
                    <input type="hidden" name="provincia" value=<?=$provincia?>>
                    <input type="hidden" name="localidad" value=<?=$localidad?>>
                    <input type="hidden" name="direccion" value=<?=$direccion?>>

                </p>
            </section>

            <p><br>*Los datos con asterisco son obligatorios </p>

            <button type="submit" class="btn btn-default">Validar el pago</button>

        </form>
    </div>
</div>


<?php else :?>
<h1>Necesitas estar identificado</h1>
<p>Para poder realizar tu pedido necesitas estar logueado en la web</p>
<?php endif; ?>