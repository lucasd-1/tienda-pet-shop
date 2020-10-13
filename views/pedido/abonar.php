<h1>Abonar el pedido</h1>

<?php if(isset($_SESSION['identity'])) :?>
<br/>

<form action="nadaaun" method="POST">
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
      <input type="tel" id="number" name="cardnumber">
    </p>
    <p>
      <label for="date">
        <span>Fecha de caducidad:</span>
        <strong><abbr title="required">*</abbr></strong>
        <em>el formato mm/aa</em>
      </label>
      <input type="date" id="date" name="expiration">
    </p>
</section>

    <p><br>*Los datos con asterisco son obligatorios </p>
	
	<p> <button type="submit">Validar el pago</button>  **** Este boton obviamente no lleva a ningun lado</p>
        
</form>
    
<?php else :?>
<h1>Necesitas estar identificado</h1>
<p>Para poder realizar tu pedido necesitas estar logueado en la web</p>
<?php endif; ?>