-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2020 a las 00:05:46
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `esquemas`
--

-- --------------------------------------------------------


CREATE TABLE projects(
  id integer PRIMARY KEY AUTOINCREMENT,
  title varchar(85) DEFAULT NULL,
  st_date varchar(85) NOT NULL,
  complete varchar(8) NOT NULL
);

--
-- Volcado de datos para la tabla `projects`
--

CREATE TABLE departments(
  id integer PRIMARY KEY AUTOINCREMENT,
  department varchar(85) DEFAULT NULL
); 


INSERT INTO projects (title,st_date,complete) VALUES
('LAMINAS', '2020-09-07', 'YES'),
('BD', '2020-09-10', 'NO'),
('BD Y ESQUEMA', '2020-09-10', 'NO'),
('ANALISIS', '2015-02-11', 'YES'),
('INGENIERIA', '2019-02-15', 'NO');

INSERT INTO departments (department) VALUES
('ENGINEER');





/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
