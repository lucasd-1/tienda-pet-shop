-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-08-2020 a las 02:41:10
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_master`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
                              `id` int(255) NOT NULL AUTO_INCREMENT,
                              `nombre` varchar(255) NOT NULL,
                              CONSTRAINT pk_categorias PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pedido`
--

CREATE TABLE `estados_pedidos` (
                                   `id` int(255) NOT NULL AUTO_INCREMENT,
                                   `descripcion` varchar(255) NOT NULL,
                                   CONSTRAINT pk_estados_pedidos PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faqs`
--

CREATE TABLE `faqs` (
                        `id` int(255) NOT NULL AUTO_INCREMENT,
                        `titulo` varchar(255) NOT NULL,
                        `tags` varchar(255) NOT NULL,
                        `descripcion` varchar(400) NOT NULL,
                        CONSTRAINT pk_faqs PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticias` (
                            `id` int(255) NOT NULL AUTO_INCREMENT,
                            `titulo` varchar(255) NOT NULL,
                            `subtitulo` varchar(255) NOT NULL,
                            `fecha` date NOT NULL,
                            `contenido` varchar(2500) NOT NULL,
                            `img1` varchar(255) DEFAULT NULL,
                            `img2` varchar(255) DEFAULT NULL,
                            `img3` varchar(255) DEFAULT NULL,
                            CONSTRAINT pk_noticias PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
                            `id` int(255) NOT NULL AUTO_INCREMENT,
                            `descripcion` varchar(255) NOT NULL,
                            CONSTRAINT pk_permisos PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategorias` (
                                 `id` int(255) NOT NULL AUTO_INCREMENT,
                                 `nombre` varchar(255) NOT NULL,
                                 CONSTRAINT pk_subcategorias PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `homepage`
--

CREATE TABLE `homepage` (
                            `id` int(255) NOT NULL AUTO_INCREMENT,
                            `img1` varchar(255) DEFAULT NULL,
                            `img2` varchar(255) DEFAULT NULL,
                            `img3` varchar(255) DEFAULT NULL,
                            `img4` varchar(255) DEFAULT NULL,
                            `img5` varchar(255) DEFAULT NULL,
                            `img6` varchar(255) DEFAULT NULL,
                            `id_noticia` int(255) DEFAULT NULL,
                            CONSTRAINT pk_homepage PRIMARY KEY (`id`),
                            CONSTRAINT fk_homepage_noticias FOREIGN KEY (`id_noticia`) REFERENCES noticias(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
                            `id` int(255) NOT NULL AUTO_INCREMENT,
                            `nombre` varchar(255) NOT NULL DEFAULT '',
                            `apellidos` varchar(255) DEFAULT '',
                            `email` varchar(255) NOT NULL DEFAULT '',
                            `password` varchar(255) NOT NULL DEFAULT '',
                            `permiso_id` int(255) NOT NULL,
                            `dni` int(11) DEFAULT 0,
                            `telefono` int(11) DEFAULT 0,
                            `direccion` varchar(255) DEFAULT '',
                            `username` varchar(255) DEFAULT '',
                            `fecha_registro` varchar(255) DEFAULT '',
                            `fecha_ult_pedido` varchar(255) DEFAULT '',
                            `saldo` float DEFAULT 0,
                            `imagen` varchar(255) DEFAULT '',
                            CONSTRAINT pk_usuarios PRIMARY KEY (`id`),
                            CONSTRAINT fk_usuarios_permisos FOREIGN KEY (`permiso_id`) REFERENCES permisos(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
                           `id` int(255) NOT NULL AUTO_INCREMENT,
                           `usuario_id` int(255) NOT NULL,
                           `provincia` varchar(255) NOT NULL,
                           `localidad` varchar(255) NOT NULL,
                           `direccion` varchar(255) NOT NULL,
                           `coste` float NOT NULL,
                           `id_estado_pedido` int(255) NOT NULL,
                           `fecha` date DEFAULT NULL,
                           `hora` time DEFAULT NULL,
                           `forma_pago` varchar(255) DEFAULT NULL,
                           `comprobante` varchar(255) DEFAULT NULL,
                           `saldo` float DEFAULT NULL,
                           CONSTRAINT pk_pedidos PRIMARY KEY (`id`),
                           CONSTRAINT fk_pedidos_usuarios FOREIGN KEY (`usuario_id`) REFERENCES usuarios(`id`),
                           CONSTRAINT fk_pedidos_estado FOREIGN KEY (`id_estado_pedido`) REFERENCES estados_pedidos(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
                             `id` int(255) NOT NULL AUTO_INCREMENT,
                             `categoria_id` int(255) DEFAULT 1,
                             `nombre` varchar(255) NOT NULL DEFAULT '',
                             `descripcion` varchar(1000) DEFAULT '',
                             `precio` float NOT NULL DEFAULT 0,
                             `stock` int(10) NOT NULL DEFAULT 0,
                             `oferta` varchar(10) DEFAULT '''''',
                             `fecha` date DEFAULT NULL,
                             `imagen` varchar(255) DEFAULT '',
                             `subcategoria_id` int(255) DEFAULT 1,
                             `proveedor` varchar(255) DEFAULT '',
                             `tags` varchar(255) DEFAULT '',
                             `precio_venta` float DEFAULT 0,
                             `img2` varchar(255) DEFAULT '',
                             `img3` varchar(255) DEFAULT '',
                             CONSTRAINT pk_productos PRIMARY KEY (`id`),
                             CONSTRAINT fk_productos_categorias FOREIGN KEY (`categoria_id`) REFERENCES categorias(`id`),
                             CONSTRAINT fk_productos_subcategorias FOREIGN KEY (`subcategoria_id`) REFERENCES subcategorias(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_pedidos`
--

CREATE TABLE `lineas_pedidos` (
                                  `id` int(255) NOT NULL AUTO_INCREMENT,
                                  `pedido_id` int(255) NOT NULL,
                                  `producto_id` int(255) NOT NULL,
                                  `unidades` int(10) NOT NULL,
                                  CONSTRAINT pk_lineas_pedidos PRIMARY KEY (`id`),
                                  CONSTRAINT fk_lineas_pedido FOREIGN KEY (`pedido_id`) REFERENCES pedidos(`id`),
                                  CONSTRAINT fk_lineas_producto FOREIGN KEY (`producto_id`) REFERENCES productos(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Gatos'),
(2, 'Perros'),
(3, 'Hamsteres'),
(4, 'Peces');

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategorias` (`id`, `nombre`) VALUES
(1, 'accesorios'),
(2, 'alimentos'),
(3, 'juguetes');


--
-- Volcado de datos para la tabla `estado_pedido`
--

INSERT INTO `estados_pedidos` (`id`, `descripcion`) VALUES
(1, 'Pendiente'),
(2, 'Entregado');

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `Descripcion`) VALUES
(1, 'admin'),
(2, 'usuario');

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `stock`, `oferta`, `fecha`, `imagen`, `subcategoria_id`, `proveedor`, `tags`, `precio_venta`, `img2`, `img3`) VALUES
(2, 1, 'Ratita', 'Ratita de juguete multicolor con hierba gatera en su interior.', 90, 11, NULL, NULL, 'ratita.jpg', 3, NULL, NULL, NULL, NULL, NULL),
(3, 1, 'Gimnasio rascador', 'Gimnasio para gatos, con juguete y rascador sisal. Colores rosa, violeta, negro y blanco.', 1600, 6, NULL, '2020-08-09', 'rascadorGimnasio.jpg', 3, '', '', 0, '', ''),
(4, 2, 'Soga trenzada', 'soga trenzada para perro mediana y resistente. Colores rosa, celeste, verde (moteada). Para perros chicos y medianos.', 90, 7, NULL, '2020-08-15', 'Soga trenzada para perros.jpg', 1, NULL, NULL, NULL, NULL, NULL),
(5, 2, 'Diario con chifle', 'Diario con chifle para perros chicos y medianos. 16 cm de ancho. Color hueso.', 215.9, 7, NULL, '2020-08-15', 'diario chifle.JPG', 1, NULL, NULL, NULL, NULL, NULL),
(6, 4, 'Kit pecera completa', 'El kit Incuye\r\nPecera de vidrio de 60x35x20\r\n6 placas biologicas\r\n1,5 metros de manguera\r\n1 ventosa\r\n1 piedra difusora\r\n1 pico o cono\r\nGrava para cubrir la base\r\nplanta decorativa\r\nAlimento Tetra pond (la mejor marca del mercado)\r\n1 aireador de 1 salida marca RS\r\n1 aticloro de 80cc', 1990, 4, NULL, '2020-08-15', 'pecera kit.JPG', 1, NULL, NULL, NULL, NULL, NULL),
(7, 3, 'Bebedero chupete 125 ml', 'Bebedero para hamsters y roedores en general. Varios colores! de 125 ml y de plástico.', 325.9, 15, NULL, '2020-08-15', 'bebedero chupete.JPG', 1, NULL, NULL, NULL, NULL, NULL);

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `permiso_id`, `dni`, `telefono`, `direccion`, `userName`, `fecha_registro`, `fecha_ult_pedido`, `Saldo`, `imagen`) VALUES
(1, 'Admin', 'Admin', 'admin@admin.com', 'contraseÃ±a', 1, 0, 0, '', '', '', '', 0, NULL),
(2, 'admin', 'istrador', 'admin@tienda', '$2y$04$G/8iFQkOb1CBeXIjEWcHBeJ8aMC4NzDRrHy0b5GwasNJuNTz88.GS', 1, 0, 0, '', '', '', '', 0, NULL),
(3, 'naichi', 'galaxy', 'naichis@gmail.com', '1234', 1, 32222222, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'a', 'a', 'a@a', '1234', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'qq', 'qqq', 'q@q', '$2y$04$rnuFbyFO9XlV88.F/uD90uSuxKCkTGEIUvejTDQUrKIzsFvE4UDj6', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'prueba', 'pp', 'prueba@a', '$2y$04$62SMmUKEO/UhN6g7Va1bwODGCuq.5n6LOJd0X5yPU3bTcSeeWBSsC', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `provincia`, `localidad`, `direccion`, `coste`, `id_estado_pedido`, `fecha`, `hora`, `forma_pago`, `comprobante`, `saldo`) VALUES
(1, 7, 'jujuy', 'jujuy capital (?', 'sarandi 346', 90, 1, '2020-08-15', '19:24:43', NULL, NULL, NULL);

--
-- Volcado de datos para la tabla `lineas_pedidos`
--

INSERT INTO `lineas_pedidos` (`id`, `pedido_id`, `producto_id`, `unidades`) VALUES
(1, 1, 2, 1);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
