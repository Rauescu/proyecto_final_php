
CREATE DATABASE IF NOT EXISTS `zapatos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `zapatos`;

--  UNA VEZ CREADA ENTRAR DENTRO DE LA BASE DE DATOS ANTES DE INTRODUCIR  

CREATE TABLE `categorias` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Jordan'),
(2, 'Force');

CREATE TABLE `lineas_pedidos` (
  `id` int(255) NOT NULL,
  `pedido_id` int(255) NOT NULL,
  `producto_id` int(255) NOT NULL,
  `unidades` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `pedidos` (
  `id` int(255) NOT NULL,
  `usuario_id` int(255) NOT NULL,
  `provincia` varchar(100) COLLATE utf8_bin NOT NULL,
  `localidad` varchar(100) COLLATE utf8_bin NOT NULL,
  `direccion` varchar(255) COLLATE utf8_bin NOT NULL,
  `coste` float(200,2) NOT NULL,
  `estado` varchar(20) COLLATE utf8_bin NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `productos` (
  `id` int(255) NOT NULL,
  `categoria_id` int(255) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `descripcion` text COLLATE utf8_bin DEFAULT NULL,
  `precio` float(100,2) NOT NULL,
  `stock` int(255) NOT NULL,
  `oferta` float DEFAULT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `stock`, `oferta`, `fecha`, `imagen`) VALUES
(1, 2, 'Nike Force 1 Crater Next Nature', 'Las zapatillas que ayudaron a definir el estilo urbano se han reinventado con una amortiguación supersuave que aporta elasticidad a cada paso y salto. Los revestimientos de piel sintética son duraderos y fáciles de limpiar.', 74.99, 54, 23.55, '2023-01-02', 'nikeforce1craternextnature'),
(2, 2, 'Nike Air Force Low Retro', 'Da el sí quiero (de nuevo) a unas zapatillas que querrás llevar para el resto de tu vida. Las Nike Air Force 1 Low Retro recuperan los materiales originales y mantienen todo lo que más te gusta: un diseño de piel clásica y la cantidad perfecta de estilo de baloncesto para rendir homenaje a un icono de la moda para el día a día. Ahora, incorporan un cepillo de limpieza para mantener un look impecable.', 119.99, 419, 0, '2023-01-04', 'nikeairforcelowretro'),
(4, 2, 'Nike Air Force 1 Retro White', 'El fulgor sigue vivo con las Nike Air Force 1 \07. Este modelo original de baloncesto introduce un nuevo giro a sus ya característicos revestimientos con costuras duraderas, acabados impecables y la cantidad perfecta de brillo.\r\n\r\n', 119.99, 43, 0, '2023-01-06', 'nikeairforce1retrowhite'),
(5, 1, 'Nike Air Jordan 1 Retro High', 'Combinamos las 3 y las 1 para conseguir un nuevo icono. Este modelo reúne el diseño clásico de las AJ1 y los colores originales de las AJ3 para celebrar el 35 cumpleaños de las Air Jordan 3. El diseño se inspira en las zapatillas del 85: piel premium, una zona del tobillo de perfil alto y la etiqueta cosida tan popular de la lengüeta. Además, los detalles llamativos en true blue por todo el diseño, como en el logotipo Wings, contrastan con las capas en blanco y cement grey. El toque final lo da la amortiguación Nike Air en la planta del pie para mantener el ritmo y que nada te impida marcar estilo.', 432.99, 522, 0, '2023-01-06', 'nikeairjordan1retrohigh');

CREATE TABLE `usuarios` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `rol` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '$2y$04$h4s4AW1zDCOmHIlIYDzkceYlmYIs.p5KO8e4WWaub2Vy7fTJwSkou', 'admin');

ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `lineas_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_linea_pedido` (`pedido_id`),
  ADD KEY `fk_linea_producto` (`producto_id`);


ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedido_usuario` (`usuario_id`);


ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_categoria` (`categoria_id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_email` (`email`);

ALTER TABLE `categorias`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `lineas_pedidos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pedidos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

ALTER TABLE `productos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `lineas_pedidos`
  ADD CONSTRAINT `fk_linea_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `fk_linea_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;
