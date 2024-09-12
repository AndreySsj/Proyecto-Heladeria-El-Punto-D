-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-09-2024 a las 00:16:59
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `products`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `id_transaccion` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `id_cliente` varchar(20) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `id_transaccion`, `fecha`, `status`, `email`, `id_cliente`, `total`) VALUES
(3, '3UF32154GY165944L', '2024-09-02 06:45:43', 'COMPLETED', 'sb-3aeun32500534@per', 'STLWN4UWFEAGW', 100000.00),
(4, '739270572V8697900', '2024-09-03 09:45:21', 'COMPLETED', 'sb-3aeun32500534@per', 'STLWN4UWFEAGW', 57000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(200) NOT NULL,
  `email_usuario` varchar(50) NOT NULL,
  `telefono` int(10) NOT NULL,
  `mensaje` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `nombre_usuario`, `email_usuario`, `telefono`, `mensaje`) VALUES
(1, 'andrey', 'andreysan@gmail.com', 1324165456, 'jcnbshvjbjkbrbv'),
(7, 'andrey', 'test@beispiel.de', 46545645, 'hfshfhsf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id`, `id_compra`, `id_producto`, `nombre`, `precio`, `cantidad`) VALUES
(1, 1, 6, 'Helado Fresa', 25000.00, 2),
(2, 1, 5, 'Ensalada de Frutas', 25000.00, 2),
(3, 1, 4, 'Malteada cososette', 25000.00, 4),
(4, 2, 2, 'ChocoHelado', 25000.00, 3),
(18, 14, 9, 'Malteada 3', 14000.00, 1),
(19, 14, 8, 'Malteada 2', 14000.00, 1),
(20, 14, 4, 'Malteada cososette', 8000.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `id_categoria`, `activo`) VALUES
(1, 'Canasta M&M', 'Esta deliciosa combinación de helado cremoso y crujientes M&Ms, servida en una canasta de barquillo fresco. Cada bocado ofrece una mezcla perfecta de helado suave y los colores vibrantes y sabores dulces de los M&Ms, creando una experiencia irresistible.', 8000, 3, 1),
(2, 'ChocoHelado', 'El ChocoHelado es la opción ideal para los amantes del chocolate. Este helado está elaborado con una base de helado de chocolate extra cremoso, mezclado con trozos de chocolate y una salsa de chocolate fundido. Servido con una capa de crema batida y virutas de chocolate, este postre es un verdadero placer para el paladar.', 8000, 3, 1),
(3, 'Torta de 3 leches', 'Nuestra Torta de 3 leches es un clásico que nunca pasa de moda. Esta torta esponjosa está bañada en una mezcla de tres tipos de leche: evaporada, condensada y crema de leche, lo que le da su textura húmeda y su sabor inigualable. Decorada con crema batida y un toque de canela, esta torta es perfecta para cualquier celebración.', 25000, 1, 1),
(4, 'Malteada cososette', 'La Malteada Cocosette es una experiencia tropical en un vaso. Hecha con helado de coco y trozos de galleta Cocosette, esta malteada ofrece un sabor refrescante y único. Servida con crema batida y un toque de coco rallado, es el acompañamiento perfecto para un día caluroso o un antojo dulce.', 8000, 4, 1),
(5, 'Ensalada de Frutas', 'La Ensalada de frutas es una opción saludable y refrescante. Preparada con una mezcla de frutas frescas y de temporada, esta ensalada es perfecta como postre o como un snack ligero. Aderezada con un toque de jugo de naranja natural y una pizca de miel, es ideal para aquellos que buscan algo dulce pero saludable.', 15000, 2, 1),
(6, 'Helado Fresa', 'El Helado de fresa es un clásico que siempre encanta. Hecho con fresas frescas y crema, este helado tiene un sabor dulce y natural que es perfecto para cualquier ocasión. Servido en una copa o en un cono, es una opción refrescante y deliciosa para los días calurosos.', 8000, 3, 1),
(8, 'Malteada Oreo', 'Deléitate con nuestra malteada de Oreo, una combinación perfecta de helado cremoso y galletas Oreo trituradas. Ideal para los amantes del chocolate y las galletas, esta malteada es el postre perfecto para cualquier ocasión.', 14000, 4, 1),
(9, 'Malteada M&M', 'Descubre la malteada de Myms, una opción innovadora y sabrosa que te sorprenderá. Nuestra malteada está elaborada con helado de sabor Myms, combinado con una mezcla especial de ingredientes que realzan su sabor único.', 14000, 4, 1),
(10, 'Torta \"ComeGalletas\"', 'La Torta personalizada del \"ComeGalletas\" es un postre temático inspirado en ese popular personaje. Esta torta está decorada con detalles que representan a este divertido personaje, como galletas de chocolate y una crema de mantequilla azul. Perfecta para fiestas de cumpleaños o celebraciones especiales, esta torta es una manera deliciosa de sorprender a los fans de \"Galletas\".', 25000, 1, 1),
(11, 'Torta de Frutas', 'Nuestra Torta con frutas es un postre fresco y delicioso. Esta torta esponjosa está cubierta con una mezcla de frutas frescas y una ligera capa de crema. Perfecta para una ocasión especial o como un postre refrescante, esta torta es una opción elegante y sabrosa.', 25000, 1, 1),
(13, 'Helado de Maracuya', 'El Helado de maracuyá es una opción refrescante y exótica. Hecho con maracuyá fresco, este helado ofrece un sabor ácido y dulce que es perfecto para los días calurosos. Servido en una copa o cono, este helado es una explosión de sabor tropical.', 8000, 3, 1),
(14, 'Helado de Salpicon', 'El Helado de salpicón es una fusión deliciosa de sabores frutales. Este helado está hecho con una mezcla de frutas tropicales y jugo natural, creando una experiencia refrescante y dulce. Perfecto para quienes buscan algo diferente, este helado es una opción colorida y vibrante.', 8000, 3, 1),
(15, 'Trilogia', 'La Trilogía de helado con fruta es un postre sofisticado que combina tres sabores diferentes de helado con una selección de frutas frescas. Servido en una copa elegante, esta trilogía es perfecta para compartir o para disfrutar como un postre especial.', 8000, 2, 1),
(16, 'Banana Split', 'El Banana split es un clásico atemporal que nunca decepciona. Esta delicia consiste en una banana fresca cortada por la mitad, acompañada de tres bolas de helado de vainilla, chocolate y fresa. Coronado con crema batida, chocolate fundido, nueces y una cereza, este postre es perfecto para compartir o disfrutar solo.', 10000, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_categoria`
--

CREATE TABLE `producto_categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto_categoria`
--

INSERT INTO `producto_categoria` (`id`, `nombre`, `descripcion`) VALUES
(1, 'tortas', 'tortas'),
(2, 'ensalada de frutas', 'ensalada de frutas'),
(3, 'helados', 'helados'),
(4, 'malteadas', 'malteadas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `email_usuario` varchar(50) NOT NULL,
  `password_usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `email_usuario`, `password_usuario`) VALUES
(1, 'Andrey', 'andreysan@gmail.com', '00000'),
(2, 'brayan', 'test@example.us', '0000'),
(3, 'william', 'aaa@gmail.com', '7777'),
(18, 'benito', 'benito@gmail.com', '55555'),
(19, 'yandel', 'yandel@gmail.com', '55555');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_categoria`
--
ALTER TABLE `producto_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `producto_categoria`
--
ALTER TABLE `producto_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
