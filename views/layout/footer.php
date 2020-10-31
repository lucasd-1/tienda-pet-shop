        </div>
        </div>


        <!-- FOOTER -->
        <footer id="footer">
            <div id = "abajo" class="container">
                <div id="logito">
                    <a href="<?=base_url?>"><img src="<?=base_url?>assets/img/gatitolog.png" alt="pet logo"/></a>
                </div>
                <div id="datafiscal">
                    <a href="<?= base_url ?>assets/img/web-fiscal-petit.png"><img src="<?=base_url?>assets/img/datafiscal.jpg" alt="pet logo"/></a>
                </div>
                <div id="mercadopago">
                    <a href="<?=base_url?>"><img src="<?=base_url?>assets/img/mercadopago.jpg" alt="pet logo"/></a>
                </div>

                <div id="CATEGORIAS">
                    <ul>
                        <?php $categorias = Utils::showCategorias(); ?>
                        <li><p><a href="<?=base_url?>">CATEGORIAS</a></p></li>
                        <?php while($cat = $categorias->fetch_object()): ?>
                            <li><a href="<?=base_url?>categoria/ver&catId=<?=$cat->id?>"><?=$cat->nombre?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <div id="CARRITO">
                    <ul>
                        <li><p><a href="<?=base_url?>carrito/index">CARRITO</a></p></li>
                        <li><a href="<?=base_url?>pedido/mis_pedidos">Mis compras</a></li>
                        <li><a href="<?=base_url?>usuario/miPerfil">Mi cuenta</a></li>
                        <li><a href="<?=base_url?>footer/terminosYCondiciones">Terminos y condiciones</a></li>
                        <li><a href="<?=base_url?>footer/politicasDePrivacidad">Politicas de privacidad</a></li>
                    </ul>
                </div>
                <div id="CONTACTO">
                    <ul>
                        <li><p><a href="<?=base_url?>">CONTACTO</a></p></li>
                        <li><a href="<?=base_url?>footer/nosotros">Nosotros</a></li>
                        <li><a href="<?=base_url?>footer/locales">Locales</a></li>
                        <li><a href="<?=base_url?>footer/contacto">Contacto</a></li>
                        <li><a href="<?=base_url?>">Noticias</a></li>
                    </ul>
                </div>
                <div id="redes">
                    <a target="_blank" href="<?= base_url ?>assets/img/web-fbpetit.png"><img src="<?=base_url?>assets/img/face.png" alt="pet logo"/></a>
                    <a href="<?= base_url ?>assets/img/web-img-instagram.gif"><img src="<?=base_url?>assets/img/ig.png" alt="pet logo"/></a>
                    <a href="<?= base_url ?>assets/img/web-twitterPShop.png"><img src="<?=base_url?>assets/img/tw.jpg" alt="pet logo"/></a>
                    <a href="https://wa.link/y3myi8"><img src="<?=base_url?>assets/img/ws.png" alt="pet logo"/></a>
                </div>
            </div>
        </footer>
    </body>
</html>