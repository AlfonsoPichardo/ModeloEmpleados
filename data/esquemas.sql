-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2020 a las 00:05:46
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `esquemas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(11) NOT NULL,
  `department` varchar(85) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`dept_id`, `department`) VALUES
(1, 'ENGINEER'),
(2, 'CONTABILITY'),
(3, 'NETWORKS'),
(4, 'MARKETING'),
(5, 'ADMIN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(65) NOT NULL,
  `last_name` varchar(65) DEFAULT NULL,
  `employee_dob` date DEFAULT NULL,
  `telephone` varchar(12) NOT NULL,
  `hire_date` date NOT NULL,
  `Departments_dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `last_name`, `employee_dob`, `telephone`, `hire_date`, `Departments_dept_id`) VALUES
(1, 'ALFONSO', 'PICHARDO', '2000-04-02', '5587453307', '2020-09-06', 1),
(2, 'ROMAN', 'VAZQUEZ', '2000-05-12', '5505090920', '2020-11-10', 2),
(3, 'MARIANO', 'DIAZ', '1998-08-08', '5500225545', '2019-02-15', 3),
(4, 'MARIANA', 'SALGADO', '2000-09-26', '5511548966', '2019-05-05', 4),
(5, 'JORGE', 'SAENZ', '1989-10-21', '551234889', '2015-01-28', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employee_project`
--

CREATE TABLE `employee_project` (
  `work_date` date NOT NULL,
  `work_hours` decimal(10,0) NOT NULL,
  `Employees_employee_id` int(11) NOT NULL,
  `Projects_project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `employee_project`
--

INSERT INTO `employee_project` (`work_date`, `work_hours`, `Employees_employee_id`, `Projects_project_id`) VALUES
('2020-09-10', '18', 1, 1),
('2000-04-02', '64', 3, 3),
('2000-04-02', '100', 1, 2),
('2015-02-11', '264', 5, 4),
('2000-04-02', '16', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `title` varchar(85) DEFAULT NULL,
  `start_date` date NOT NULL,
  `complete` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`project_id`, `title`, `start_date`, `complete`) VALUES
(1, 'LAMINAS', '2020-09-07', 'YES'),
(2, 'BD', '2020-09-10', 'NO'),
(3, 'BD Y ESQUEMA', '2020-09-10', 'NO'),
(4, 'ANALISIS', '2015-02-11', 'YES'),
(5, 'INGENIERIA', '2019-02-15', 'NO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `Employees_Departments_FK` (`Departments_dept_id`);

--
-- Indices de la tabla `employee_project`
--
ALTER TABLE `employee_project`
  ADD KEY `Employee_Project_Employees_FK` (`Employees_employee_id`),
  ADD KEY `Employee_Project_Projects_FK` (`Projects_project_id`);

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `Employees_Departments_FK` FOREIGN KEY (`Departments_dept_id`) REFERENCES `departments` (`dept_id`);

--
-- Filtros para la tabla `employee_project`
--
ALTER TABLE `employee_project`
  ADD CONSTRAINT `Employee_Project_Employees_FK` FOREIGN KEY (`Employees_employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `Employee_Project_Projects_FK` FOREIGN KEY (`Projects_project_id`) REFERENCES `projects` (`project_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
