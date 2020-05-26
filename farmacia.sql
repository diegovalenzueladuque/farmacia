-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-05-2020 a las 22:51:06
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `farmacia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adquisiciones`
--

CREATE TABLE `adquisiciones` (
  `id` int(11) NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `proveedor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorías`
--

CREATE TABLE `categorías` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `código` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorías`
--

INSERT INTO `categorías` (`id`, `nombre`, `código`, `created_at`, `updated_at`) VALUES
(1, 'Medicamentos', 'MED001', '2020-05-14 23:18:29', '2020-05-15 00:02:19'),
(2, 'Dermocosmética', 'DMC001', '2020-05-14 23:18:29', '2020-05-15 00:02:19'),
(3, 'Infantil', 'INF001', '2020-05-14 23:18:29', '2020-05-15 00:02:19'),
(4, 'Cuidado Corporal', 'CCO001', '2020-05-14 23:18:29', '2020-05-15 00:02:19'),
(5, 'Diagnóstico Gráfico', 'DIA001', '2020-05-14 23:18:29', '2020-05-15 00:02:19'),
(6, 'Diagnóstico Capilar', 'DIA002', '2020-05-14 23:18:29', '2020-05-15 00:02:19'),
(7, 'Higiene Bucal', 'HIB001', '2020-05-14 23:18:29', '2020-05-15 00:02:19'),
(8, 'Nutrición', 'NUT001', '2020-05-14 23:18:29', '2020-05-15 00:02:19'),
(9, 'Adulto Mayor', 'ADM001', '2020-05-15 00:04:49', '2020-05-15 00:04:49'),
(10, 'Ofertas', 'OFE001', '2020-05-15 00:05:38', '2020-05-15 00:05:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `rut` varchar(50) NOT NULL,
  `dirección` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `persona` enum('Persona Natural','Empresa') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `rut`, `dirección`, `fecha_nacimiento`, `persona`, `created_at`, `updated_at`) VALUES
(1, 'Juan Perez', '8.586.278-2', 'Las Encinas 3370', '1953-09-13', 'Persona Natural', '2020-05-15 16:08:21', '2020-05-15 16:18:09'),
(2, 'Claudia Herrera', '10.796.241-7', 'Las Encinas 3370', '1964-10-03', 'Persona Natural', '2020-05-15 16:08:21', '2020-05-15 16:18:09'),
(3, 'Hilda Molina', '10.281.108-9', 'Compañía 1264', '1963-09-02', 'Persona Natural', '2020-05-15 16:08:21', '2020-05-15 16:18:09'),
(4, 'José Díaz', '7.740.332-9', 'Compañía 1264', '1955-08-15', 'Persona Natural', '2020-05-15 16:08:21', '2020-05-15 16:18:09'),
(5, 'Lorena Moreno', '12.924.943-9', 'San Alfonso 778', '1975-07-12', 'Persona Natural', '2020-05-15 16:08:21', '2020-05-15 16:18:09'),
(6, 'Universidad de Chile', '60.910.000-1', 'Compañía 1264', '1820-01-12', 'Empresa', '2020-05-15 16:08:21', '2020-05-15 16:18:09'),
(7, 'Georgina Duque', '7.432.696-k', 'Gay 2514 casa 11', '1953-06-15', 'Persona Natural', '2020-05-15 16:08:21', '2020-05-15 16:18:09'),
(8, 'Paula LLaulen', '12.855.899-3', 'Las encinas 3370', '1975-03-12', 'Persona Natural', '2020-05-15 16:08:21', '2020-05-15 16:18:09'),
(9, 'Flor Soldini', '7.435.184-0', 'Las Palmeras 3320', '1953-10-16', 'Persona Natural', '2020-05-17 14:04:49', '2020-05-17 14:04:49'),
(10, 'Julian Lennon', '15622365-4', 'San Eugenio 1551', '1964-08-15', 'Persona Natural', '2020-05-19 14:59:50', '2020-05-19 14:59:50'),
(11, 'Mauricio Toro', '10.411.916-6	', 'Compañía 1264', '1970-08-16', 'Persona Natural', '2020-05-19 19:28:52', '2020-05-19 19:28:52'),
(12, 'Ignacio Copani', '9112247-2', 'Bellavista 0990', '1968-10-10', 'Persona Natural', '2020-05-19 19:30:45', '2020-05-19 19:30:45'),
(13, 'Ingeniería Eléctrica Ingelmor Ltda.', '79523450-0', 'Zenteno 1466', '1980-01-01', 'Empresa', '2020-05-19 19:39:24', '2020-05-19 19:39:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_adquisiciones`
--

CREATE TABLE `detalle_adquisiciones` (
  `id` int(11) NOT NULL,
  `cantidad` varchar(50) NOT NULL,
  `precio` varchar(50) NOT NULL,
  `adquisicion_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `cantidad`, `producto_id`, `venta_id`) VALUES
(1, 4, 1, 1),
(2, 8, 2, 2),
(3, 1, 3, 3),
(4, 6, 4, 4),
(5, 3, 5, 5),
(6, 3, 6, 6),
(7, 5, 7, 7),
(8, 2, 8, 8),
(9, 1, 9, 9),
(10, 1, 10, 10),
(11, 6, 11, 11),
(12, 2, 12, 12),
(13, 1, 13, 13),
(14, 2, 14, 14),
(15, 1, 15, 15),
(16, 3, 16, 16),
(17, 1, 17, 17),
(18, 1, 18, 18),
(19, 2, 19, 19),
(20, 2, 20, 20),
(21, 1, 21, 21),
(22, 1, 22, 22),
(23, 1, 23, 23),
(24, 3, 24, 24),
(25, 1, 25, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Pepsodent', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(2, 'Colgate', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(3, 'Curaprox', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(4, 'Vitis', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(5, 'PHB', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(6, 'Loreal', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(7, 'Beiersdorf', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(8, 'Cerave', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(9, 'Bayer', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(10, 'Garnier', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(11, 'Nivea', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(12, 'Huggies', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(13, 'Drag Pharma', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(14, '3M', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(15, 'Braun', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(16, 'Merck', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(17, 'Roche', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(18, 'Bagó', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(19, 'Gsk', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(20, 'Nestlé', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(21, 'Durex', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(22, 'Life Styles', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(23, 'Johnson & Johnson', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(24, 'Gillette', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(25, 'Unilever', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(26, 'Laboratorio Nacional', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(27, 'Mentholatum', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(28, 'Pharma', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(29, 'Eucerin', '2020-05-14 17:41:14', '2020-05-14 17:41:32'),
(30, 'Oral-B', '2020-05-14 18:08:57', '2020-05-14 18:08:57'),
(31, 'Listerine', '2020-05-14 18:23:30', '2020-05-14 18:23:30'),
(32, 'MintLab', '2020-05-14 22:48:02', '2020-05-14 22:48:02'),
(33, 'Simonds', '2020-05-14 22:55:29', '2020-05-14 22:55:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medios_pago`
--

CREATE TABLE `medios_pago` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medios_pago`
--

INSERT INTO `medios_pago` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Efectivo', '2020-05-13 23:39:47', '2020-05-13 23:40:34'),
(2, 'Tarjeta de Crédito', '2020-05-13 23:42:55', '2020-05-13 23:49:21'),
(3, 'Tarjeta de Débito', '2020-05-13 23:43:03', '2020-05-13 23:49:29'),
(4, 'Excedentes Isapre', '2020-05-13 23:43:25', '2020-05-13 23:50:10'),
(5, 'Cheque', '2020-05-13 23:41:20', '2020-05-13 23:41:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `código` varchar(45) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `marca_id` int(11) NOT NULL,
  `descripción` varchar(400) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `código`, `categoria_id`, `marca_id`, `descripción`, `created_at`, `updated_at`) VALUES
(1, 'Paracetamol', 'Par001', 1, 9, 'Analgésico', '2020-05-15 13:58:45', '2020-05-15 13:59:22'),
(2, 'Ibuprofeno', 'ibu001', 1, 26, 'Analgésico Antinflamatorio', '2020-05-15 13:58:50', '2020-05-15 13:59:26'),
(3, 'Calorub', 'cal001', 1, 27, 'Analgésico', '2020-05-15 13:58:54', '2020-05-15 13:59:29'),
(4, 'Nan 2', 'nan001', 3, 20, 'Fórmula de continuación indicada en lactantes sanos a partir de los 6 meses de edad', '2020-05-15 13:58:57', '2020-05-15 13:59:33'),
(5, 'Nan Junior 3 ', 'nan002', 3, 20, 'Fórmula Junior para lactantes sanos de 1 a 3 años.', '2020-05-15 13:59:01', '2020-05-15 13:59:37'),
(6, 'Leche Nido FortiCrece ', 'nid001', 3, 20, 'Leche en Polvo NIDO® Forticrece® Sin Lactosa tarro 1440g', '2020-05-15 13:59:04', '2020-05-15 13:59:40'),
(7, 'Leche Entera en polvo', 'LNI001', 8, 20, 'Leche NIDO® Entera es naturalmente buena fuente de proteínas y calcio y además está fortificada con vitaminas C y hierro.', '2020-05-14 21:16:19', '2020-05-14 21:16:19'),
(8, 'Toptear', 'TTL001', 1, 28, 'Toptear es hialuronato de sodio al 0.4%; se trata de un glicosaminoglicano sustituto de las lágrimas naturales cuya estructura molecular está formada por las moléculas N-acetil-D-glucosamina y ácido D-glucurónico.', '2020-05-14 21:29:55', '2020-05-14 21:29:55'),
(9, 'Preservativo Ultrasensible Nuda 3', 'PRE001', 1, 22, 'Preservativo Nuda Ultra Sensible, fabricado en goma de látex natural, testeados electrónicamente, si son usados correctamente pueden ayudar a reducir el riesgo de contraer VIH y otras enfermedades de transmisión sexual. Son altamente efectivos en la prevención de embarazo. Sus diseños entregan protección y seguridad', '2020-05-14 21:31:11', '2020-05-14 21:31:11'),
(10, 'Preservativo Skyn Original', 'PRE002', 1, 22, 'Preservativos increíblemente sensibles. Con material suave no látex que es apenas perceptible, pero tan fuerte como el látex premium. Lubricado con lubricante ultra-suave de larga duración. Ideal para personas con alergias al látex o sensibilidad al látex.', '2020-05-14 21:34:16', '2020-05-14 21:34:16'),
(11, 'Preservativo Durex máximo Placer', 'PRE003', 1, 21, 'Los condones Durex Máximo Placer aseguran una mayor estimulación para ti y tu pareja. Están anatómicamente diseñados y texturizados para máximo placer.', '2020-05-14 21:35:10', '2020-05-14 21:35:10'),
(12, 'Loción Corporal Ligera Ph5 400 mL', 'DCE001', 2, 29, 'Eucerin pH5 Loción Ultraligera es un producto hidratante corporal suave, pero eficaz. Se ha formulado especialmente para mejorar la resistencia y reducir la sensibilidad de la piel corporal sensible.', '2020-05-14 21:35:39', '2020-05-14 21:35:39'),
(13, 'Aceite Para Prevenir Estrias 125 mL', 'DCE002', 2, 29, 'Aceites 100% naturales de rápida absorción que mejoran la elasticidad de la piel sensible, incluso durante el embarazo. Efectivo contra las estrías cutáneas. ', '2020-05-14 21:36:26', '2020-05-14 21:36:26'),
(14, 'Enjuague Bucal Zero', 'EBL001', 7, 31, 'El enjuague bucal LISTERINE® Zero Menta Suave es libre de alcohol y brinda un sabor más suave.', '2020-05-14 22:13:52', '2020-05-14 22:13:52'),
(15, 'Cepillo Dental SlimSoft Advanced Pack x 2', 'CDC001', 7, 2, 'Incorpora avances tecnológicos. Brinda una Limpieza profunda, otorgando 300% encías más saludable. Tiene cerdas innovadoras reforzadas, ultra suaves con puntas 17x más finas que alcanzan 7x más profundo.', '2020-05-14 22:16:55', '2020-05-14 22:16:55'),
(16, 'Cepillo dental a pilas Pro-Salud Power', 'CDO001', 7, 30, 'El cepillo dental a pilas Oral-B Pro-Salud Power con cabezal reemplazable remueve más placa que un cepillo manual común y ayuda a mejorar significativamente la salud de las encías.', '2020-05-14 22:20:10', '2020-05-14 22:20:10'),
(17, 'Pasta Dental Total12 75 mL', 'PDC001', 7, 2, 'Colgate Total 12 con nueva y perfeccionada fórmula con Dual - Zinc y Arginina.Combate proactivamente las bacterias, ácidos y manchas por 12 horas.', '2020-05-14 22:20:54', '2020-05-14 22:20:54'),
(18, 'Geniol Adultos Paracetamol 500 mg', 'GAD001', 1, 32, 'Este medicamento se utiliza para tratar los síntomas de la gripe y el resfrío (congestión nasal, dolor de cabeza, dolor corporal, dolor de oídos, fiebre).', '2020-05-14 23:06:10', '2020-05-14 23:06:10'),
(19, 'ActiveSec Pañal Desechable Talla G', 'PHU001', 3, 12, 'Active Sec aguanta hasta 12 horas de protección. Tiene tecnología MAXISEC para que el pañal esté más seco por más tiempo y cintura elastizada para evitar filtraciones. Además, viene con los divertidos personajes de Toy Story! * Abre el pañal.', '2020-05-14 23:06:34', '2020-05-14 23:06:34'),
(20, 'Little Swimmers Pañales 11-15 kg', 'PHU002', 3, 12, 'Pañal para nadar permite que el bebé juegue en el agua con más protección y comodidad, para niños de 11 a 15 Kg. Talla M/M', '2020-05-14 23:09:43', '2020-05-14 23:09:43'),
(21, 'Aceite Baby Oil Hipoalergenico 200 mL', 'ABL001', 3, 33, 'Aceite para bebé hipoalergénico, sin perfume, sin colorantes', '2020-05-14 23:10:15', '2020-05-14 23:10:15'),
(22, 'Acondicionador Baby 400 mL', 'ABJ001', 3, 23, 'El acondicionador para bebé JOHNSON\'S baby Cabello Claro combina la suavidad del acondicionador JOHNSON\'S baby con el ingrediente natural de la manzanilla, ayudando a realzar naturalmente el color de los cabellos claros de tu bebé. No produce ardor en los ojos y es suave con su piel.', '2020-05-14 23:10:37', '2020-05-14 23:10:37'),
(23, 'Aspirador Nasal', 'ASN001', 3, 33, 'Aspirador Nasal con Filtro aprovecha la fuerza controlada de tus pulmones para remover las mucosidades de la nariz del bebé, de manera fácil y con resultados a la vista. Esta diseñado para proporcionar alivio inmediato y efectivo de la congestión nasal + Estuche', '2020-05-14 23:11:07', '2020-05-14 23:11:07'),
(24, 'Anthelios Protector Solar Rostro Fps50 + 50 mL', 'APS001', 4, 17, 'ANTHELIOS SHAKA FLUIDO CON COLOR FPS50+ la revolución en protección solar, con una textura ULTRA-FLUIDA e invisible en la piel. ULTRA-RESISTENTE al sudor, al agua y a la arena. ULTRA-SEGURO incluso para el contorno del ojo. Además, tiene la más alta protección UVA alcanzada por la marca.', '2020-05-14 23:11:40', '2020-05-14 23:11:40'),
(25, 'Tratamiento Revitalizante Anticaida', 'TRA001', 2, 29, 'Tratamiento para el cabello debilitado. Fortalece la raíz del cabello apoyando el suministro de energía y retrasando el proceso de debilitación capilar. - Con Creatina, Carnitina y Licochalcona - Sin colorantes, Libre de parabenos, Libre de silicona, Libre de jabón alcalino', '2020-05-14 23:12:15', '2020-05-14 23:12:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `rut` varchar(50) NOT NULL,
  `dirección` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contacto` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', NULL, NULL),
(2, 'Supervisor', NULL, NULL),
(3, 'Vendedor(a)', NULL, '2020-05-18 20:01:29'),
(4, 'Soporte Técnico', NULL, '2020-05-16 17:27:29'),
(5, 'Farmaceútico', '2020-05-11 21:37:42', '2020-05-11 21:37:42'),
(6, 'Cajero', '2020-05-11 21:37:52', '2020-05-11 21:37:52'),
(7, 'Auditor', '2020-05-11 22:03:31', '2020-05-11 22:03:31'),
(9, 'Personal de Limpieza', '2020-05-18 20:01:11', '2020-05-18 20:01:11'),
(10, 'Personal de Seguridad', '2020-05-18 20:03:03', '2020-05-18 20:03:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Diego Valenzuela', 'diegovalenzueladuque@gmail.com', 'c5c758ecc7a27e13802ebb9b0306dd55', 1, 1, NULL, NULL),
(2, 'Patricia Muñoz', 'patylinda2703@gmail.com', '7173daa22c69afdaf93b9629f185388d', 2, 1, NULL, NULL),
(3, 'Sebastián Valenzuela', 'sebastivalol@gmail.com', 'b7e5969a3de630ef0d4162b5b0280322', 3, 1, NULL, NULL),
(4, 'Leopoldo Valenzuela', 'leovalenz@gmail.com', '0895592756d2638356e199daa3006d19', 4, 1, NULL, NULL),
(5, 'Ramón Valenzuela', 'r.valenzuela@gmail.com', '5213d7d40b0b72f43f10a50e69bbcfe8', 3, 1, NULL, NULL),
(6, 'José Luengo', 'jluengos@uchile.cl', '6f4de83de8b7b293ae7b4223fc2bcb75', 3, 1, NULL, NULL),
(7, 'Nestor Gorosito', 'pipogol@uc.cl', '739d3a633b9b5d568635a23473c7be17', 2, 1, '2020-05-16 14:21:51', '2020-05-16 14:21:51'),
(8, 'Alberto Acosta', 'betoacosta@uc.cl', '739d3a633b9b5d568635a23473c7be17', 2, 1, '2020-05-17 13:53:05', '2020-05-17 13:53:05'),
(10, 'John Lennon', 'j.lennon@thebeatles.com', '292dfce79d01e824a1aeb5b5dec05533', 7, 1, '2020-05-18 10:32:50', '2020-05-18 10:32:50'),
(11, 'Juan Muñoz', 'j.muñoz@gmail.com', '42e0405652d919f821c02a7104f4a62f39448bf2', 9, 1, '2020-05-18 22:39:33', '2020-05-18 22:39:33'),
(12, 'José Perez', 'jjperez@gmail.com', '53668ab2c9bf2dfbf1181ff10e50486017181561', 9, 1, '2020-05-19 13:24:39', '2020-05-19 13:24:39'),
(13, 'Manuel Rodríguez Erdoíza', 'auntenemospatria@gmail.com', '880970a4a31ecb9e5b80ed2ab583c9982b12e349', 1, 1, '2020-05-23 15:44:28', '2020-05-23 15:44:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `medio_pago_id` int(11) NOT NULL,
  `factura` tinyint(2) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `medio_pago_id`, `factura`, `usuario_id`, `cliente_id`) VALUES
(1, '2020-05-20 14:18:41', 1, 1, 3, 9),
(2, '2020-05-20 14:20:25', 2, 2, 5, 6),
(3, '2020-05-20 14:21:40', 1, 2, 6, 13),
(4, '2020-05-20 14:21:54', 1, 1, 6, 12),
(5, '2020-05-20 18:50:02', 1, 1, 5, 11),
(6, '2020-05-20 18:50:37', 4, 1, 5, 10),
(7, '2020-05-20 18:50:51', 3, 1, 3, 9),
(8, '2020-05-20 18:50:57', 2, 1, 3, 9),
(9, '2020-05-20 18:51:29', 2, 2, 5, 6),
(10, '2020-05-20 18:51:54', 1, 1, 5, 5),
(11, '2020-05-20 18:52:08', 3, 1, 5, 4),
(12, '2020-05-20 18:52:46', 1, 1, 3, 4),
(13, '2020-05-20 18:53:06', 1, 1, 6, 3),
(14, '2020-05-20 18:53:23', 2, 1, 6, 2),
(15, '2020-05-20 18:53:30', 2, 1, 6, 1),
(16, '2020-05-20 18:53:37', 1, 1, 5, 1),
(17, '2020-05-20 18:54:01', 4, 1, 5, 10),
(18, '2020-05-20 18:54:07', 3, 1, 5, 11),
(19, '2020-05-20 18:54:25', 4, 1, 3, 8),
(20, '2020-05-20 18:54:38', 1, 1, 3, 9),
(21, '2020-05-20 18:55:47', 1, 2, 6, 6),
(22, '2020-05-20 18:55:55', 1, 2, 5, 6),
(23, '2020-05-20 18:56:08', 1, 2, 3, 13),
(24, '2020-05-20 18:56:25', 1, 3, 3, 12),
(25, '2020-05-20 18:56:48', 1, 2, 5, 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adquisiciones`
--
ALTER TABLE `adquisiciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_proveedores_id` (`proveedor_id`);

--
-- Indices de la tabla `categorías`
--
ALTER TABLE `categorías`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_adquisiciones`
--
ALTER TABLE `detalle_adquisiciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_adquisiciones_id` (`adquisicion_id`),
  ADD KEY `fk_producto_id` (`producto_id`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos` (`producto_id`),
  ADD KEY `fk_ventas` (`venta_id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medios_pago`
--
ALTER TABLE `medios_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categorias` (`categoria_id`),
  ADD KEY `fk_marcas` (`marca_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_roles` (`rol_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_medios_pago` (`medio_pago_id`),
  ADD KEY `fk_usuarios_id` (`usuario_id`),
  ADD KEY `fk_clientes_id` (`cliente_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adquisiciones`
--
ALTER TABLE `adquisiciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorías`
--
ALTER TABLE `categorías`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `detalle_adquisiciones`
--
ALTER TABLE `detalle_adquisiciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `medios_pago`
--
ALTER TABLE `medios_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adquisiciones`
--
ALTER TABLE `adquisiciones`
  ADD CONSTRAINT `fk_proveedores_id` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`);

--
-- Filtros para la tabla `detalle_adquisiciones`
--
ALTER TABLE `detalle_adquisiciones`
  ADD CONSTRAINT `fk_adquisiciones_id` FOREIGN KEY (`adquisicion_id`) REFERENCES `adquisiciones` (`id`),
  ADD CONSTRAINT `fk_producto_id` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `fk_productos` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `fk_ventas` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorías` (`id`),
  ADD CONSTRAINT `fk_marcas` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_roles` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_clientes_id` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `fk_medios_pago` FOREIGN KEY (`medio_pago_id`) REFERENCES `medios_pago` (`id`),
  ADD CONSTRAINT `fk_usuarios_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
