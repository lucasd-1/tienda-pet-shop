<?php
ob_start();
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Tienda Pet Shop</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/functions.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<div id="container">
    <!-- CABECERA -->
    <header id="header">
        <div id="logo">
            <img src="<?=base_url?>assets/img/lo-firecords.jpg" alt="pet logo" />
            <a href="<?=base_url?>">
                Petit shop
            </a>
        </div>
    </header>

    <!-- MENU -->
    <?php $categorias = Utils::showCategorias(); ?>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Petit Shop</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="<?=base_url?>">Home</a></li>
                <?php while($cat = $categorias->fetch_object()): ?>
                    <?php $subcategorias = Utils::showSubcategorias(); ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?=$cat->nombre?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php while($subcat = $subcategorias->fetch_object()): ?>
                                <li>
                                    <a href="<?=base_url?>subcategoria/ver&catId=<?=$cat->id?>&id=<?=$subcat->id?>">
                                        <?=$subcat->nombre?>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </li>
                <?php endwhile; ?>
            </ul>
            <!-- Busqueda -->
            <form class="navbar-form navbar-right" action="<?=base_url?>producto/buscar" method="post">
                <div class="input-group">
                    <input class="form-control" name="busqueda" type="text" placeholder="Buscar" aria-label="Search">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </nav>

    <div id="content">