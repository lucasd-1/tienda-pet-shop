<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Tienda Pet Shop</title>
		<link rel="stylesheet" href="<?=base_url?>assets/css/styles.css" />
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
			<nav id="menu">
				<ul>
					<li>
						<a href="<?=base_url?>">Inicio</a>
					</li>
					<?php while($cat = $categorias->fetch_object()): ?>
						<li>
							<a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
						</li>
					<?php endwhile; ?>
				</ul>
			</nav>

			<div id="content">