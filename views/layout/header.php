<?php
    ob_start() 
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Tienda Pet Shop</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <script type="text/javascript" src="<?=base_url?>assets/js/functions.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <img src="<?=base_url?>assets/img/logo-petit-shop.png" alt="pet logo" />
        </div>
        <div class="col-sm-6">
            <!-- Busqueda -->
            <form class="busqueda" action="<?=base_url?>producto/buscar" method="post">
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
    </div>

    <div class="row">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="<?=base_url?>assets/img/promo1.png" alt="Promo1" style="width:100%;">
                </div>

                <div class="item">
                    <img src="<?=base_url?>assets/img/promo2.png" alt="Promo2" style="width:100%;">
                </div>

                <div class="item">
                    <img src="<?=base_url?>assets/img/promo3.webp" alt="Promo3" style="width:100%;">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="row">
        <!-- MENU -->
        <?php $categorias = Utils::showCategorias(); ?>
        <nav class="navbar navbar-inverse" style="margin-bottom: 0px;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?=base_url?>">Home</a>
                </div>
                <ul class="nav navbar-nav navbar-center">
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
            </div>
        </nav>
    </div>





    <div id="content">