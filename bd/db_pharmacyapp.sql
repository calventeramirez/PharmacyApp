-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2024 a las 19:54:16
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_pharmacyapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaspedidos`
--
CREATE SCHEMA db_pharmacyapp;
USE db_pharmacyapp;

CREATE TABLE `lineaspedidos` (
  `id` int(255) NOT NULL,
  `lineaPedido` decimal(2,0) NOT NULL,
  `idMedicamento` int(8) NOT NULL,
  `idPedido` int(8) NOT NULL,
  `precioUnitario` decimal(7,2) NOT NULL,
  `cantidad` decimal(2,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `idMedicamento` int(8) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(7,2) NOT NULL,
  `cantidad` decimal(5,0) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`idMedicamento`, `nombre`, `descripcion`, `precio`, `cantidad`, `imagen`) VALUES
(2, 'Paracetamol', 'Tabletas de paracetamol 500mg para aliviar el dolor y la fiebre', 10.99, 50, './img/paracetamol-kern-pharma-efg-500-mg-20-compr-0_0.jpg'),
(3, 'Ibuprofeno', 'Tabletas de ibuprofeno 400mg para aliviar el dolor, la inflamación y la fiebre.', 8.25, 30, './img/Ibuprofeno-Stadapharm-20-Sobres.jpg'),
(4, 'La Roche-Posay Cicaplast Baume B5 + 100m', 'Bálsamo reparador para pieles secas', 13.75, 25, './img/la-roche-posay-cicaplast-baume-b5-100ml-19397-56-B.jpg'),
(5, 'Doctril Forte, 20 Comprimidos Recubierto', 'Comprimidos para el tratamiento sintomático ocasional del dolor leve o moderado como dolores de cabeza, dentales y menstruales, así como de los estados febriles.', 4.99, 40, './img/doctril_forte_400mg_20_comprimidos_ibuprofeno_656520-8470006565209.jpg'),
(6, 'Omeprazol', 'Cápsulas de omeprazol 20mg para el alivio de la acidez estomacal.', 7.50, 20, './img/omeprazol-recurso-gsc.webp'),
(7, 'Topicrem Ds+ Sebicur Champu Anticaspa In', 'Cuidado de la higiene en casos de dermatitis seborreica en el cuero cabelludo, con énfasis en casos de caspa intensa e irritación.', 12.99, 60, './img/topicrem-ds-champu-anticaspa-intensivo-125ml.png'),
(8, 'Zovicrem Labial 50 mg/G Crema Herpes Bom', 'Crema para el alivio local de los síntomas ocasionados por el herpes labial, tales como: picor, escozor u hormigueo', 5.49, 15, './img/zovicrem-labial-50-mg-g-crema-1-tubo-2-gr-bomba-dosificadora.jpg'),
(9, 'ZzzQuil Natura Melatonina, 30 Gominolas', 'Complemento con melatonina, vitamina B6 y extractos de plantas naturales que ayuda a conciliar el sueño. Contiene 30 gominolas.', 8.99, 10, './img/zzzquil-natura-melatonina-30-gominolas-frutos-del-bosque.jpg'),
(10, 'Aspirina Plus, 20 Comprimidos', 'Comprimidos para el alivio sintomático de los dolores ocasionales, como de cabeza, dentales, menstruales, musculares o de espalda, así como para los estados febriles.', 4.25, 35, './img/aspirina_plus_20comprimidos.jpg'),
(11, 'Supradyn Energy 30 comprimidos', 'Supradyn Energy 30 comprimidos es un complemento alimenticio que aporta energía en momentos de gran esfuerzo y desgaste. Los comprimidos del bote están desarrollados a base de minerales y vitaminas con coenzima Q10 que potencian la alimentación diaria.', 4.75, 28, './img/supradyn-energy-30-comprimidos.png'),
(12, 'Diclofenaco Kern Pharma 11,6 Mg/G Gel Cu', 'Diclofenaco Kern Pharma está indicado en adultos y adolescentes mayores de 14 años para el alivio local del dolor y de la inflamación leve y ocasional.', 4.50, 18, './img/diclofenaco-kern-pharma-116-mg-g-gel-tubo-100-g-0.jpg'),
(13, 'Protopic 0.1% Pom. tópcica', 'Pomada se utiliza para tratar la dermatitis atópica moderada o grave (eccema) en adultos que no responden adecuadamente o que son intolerantes a las terapias convencionales como los corticosteroides tópicos.', 80.90, 22, './img/02201003_materialas_1.jpg'),
(14, 'Rubraca (rucaparib)', 'Rubraca está indicado como monoterapia para el tratamiento de mantenimiento de pacientes adultas con cáncer de ovario epitelial, de trompa de Falopio o peritoneal primario, de alto grado y avanzado (estadios III y IV de la clasificación de la FIGO) que re', 2000.00, 3, './img/rubraca.jpg'),
(15, 'CABOMETYX (Cabozantinib) 30 tabletas de ', 'Está indicado para el tratamiento de pacientes con carcinoma avanzado de células renales (un tipo de cáncer de riñón), que han recibido terapia antiangiogénica previa (terapia que inhibe la formación de nuevos vasos sanguíneos que suministran oxígeno al t', 6200.00, 5, './img/CABOMETYX-ID-45.jpg'),
(16, 'Sarclisa (isatuximab) 1 vial de 100 mg/5', 'Sarclisa (isatuximab) es un medicamento que se usa en combinación con pomalidomida y dexametasona o con carfilzomib para el tratamiento de adultos con mieloma múltiple refractario en recaída (MMRR). Medicamento indicado para el el linfoma de Hodgkin', 1340.00, 2, './img/sarclisa_img.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentosrecetas`
--

CREATE TABLE `medicamentosrecetas` (
  `idMedicamento` int(8) NOT NULL,
  `idReceta` int(8) NOT NULL,
  `cantidad` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(8) NOT NULL,
  `nick` varchar(255) NOT NULL,
  `precioTotal` decimal(7,2) NOT NULL,
  `fechaPedido` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `idReceta` int(8) NOT NULL,
  `nick` varchar(255) NOT NULL,
  `precioTotal` decimal(7,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`idReceta`, `nick`, `precioTotal`) VALUES
(1, 'admin', 0.00),
(2, 'pepeluis', 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nick` varchar(255) NOT NULL,
  `tarjetaSanitaria` int(12) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellidos` varchar(35) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rol` varchar(15) DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nick`, `tarjetaSanitaria`, `contrasena`, `nombre`, `apellidos`, `email`, `rol`) VALUES
('admin', 1, '$2y$10$WRq2VlxN7JLrAjqOI3FhGuhBN1j7xjwn27LKnd9D3u3Y1BjWEphSO', 'Administrador', 'Administrador', 'admin@pharmacyapp.com', 'admin'),
('pepeluis', 2, '$2y$10$KTa7dxHmiaMKcbZIn5dK3uChiHAE8IwjOPm6AyLVf/WMmBqwJ6kuG', 'Pepe Luis', 'Gonzales', 'pepeluis@hotmail.com', 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lineaspedidos`
--
ALTER TABLE `lineaspedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPedido` (`idPedido`),
  ADD KEY `idMedicamento` (`idMedicamento`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`idMedicamento`);

--
-- Indices de la tabla `medicamentosrecetas`
--
ALTER TABLE `medicamentosrecetas`
  ADD PRIMARY KEY (`idMedicamento`,`idReceta`),
  ADD KEY `fk_medicamentosRecetas_Recetas` (`idReceta`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `fk_pedidos_usuarios` (`nick`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`idReceta`),
  ADD KEY `fk_recetas_usuarios` (`nick`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`nick`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lineaspedidos`
--
ALTER TABLE `lineaspedidos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `idMedicamento` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `idReceta` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineaspedidos`
--
ALTER TABLE `lineaspedidos`
  ADD CONSTRAINT `lineaspedidos_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`),
  ADD CONSTRAINT `lineaspedidos_ibfk_2` FOREIGN KEY (`idMedicamento`) REFERENCES `medicamentos` (`idMedicamento`);

--
-- Filtros para la tabla `medicamentosrecetas`
--
ALTER TABLE `medicamentosrecetas`
  ADD CONSTRAINT `fk_medicamentosRecetas_Recetas` FOREIGN KEY (`idReceta`) REFERENCES `recetas` (`idReceta`),
  ADD CONSTRAINT `fk_medicamentosRecetas_medicamentos` FOREIGN KEY (`idMedicamento`) REFERENCES `medicamentos` (`idMedicamento`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedidos_usuarios` FOREIGN KEY (`nick`) REFERENCES `usuarios` (`nick`);

--
-- Filtros para la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD CONSTRAINT `fk_recetas_usuarios` FOREIGN KEY (`nick`) REFERENCES `usuarios` (`nick`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
