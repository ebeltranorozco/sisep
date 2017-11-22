-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.21-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla sisep.anos_fiscales
CREATE TABLE IF NOT EXISTS `anos_fiscales` (
  `idAnoFiscal` int(11) NOT NULL AUTO_INCREMENT,
  `nombreAnoFiscal` year(4) NOT NULL,
  PRIMARY KEY (`idAnoFiscal`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci ROW_FORMAT=COMPACT;

-- Volcando datos para la tabla sisep.anos_fiscales: ~1 rows (aproximadamente)
DELETE FROM `anos_fiscales`;
/*!40000 ALTER TABLE `anos_fiscales` DISABLE KEYS */;
INSERT INTO `anos_fiscales` (`idAnoFiscal`, `nombreAnoFiscal`) VALUES
	(1, '2017');
/*!40000 ALTER TABLE `anos_fiscales` ENABLE KEYS */;

-- Volcando estructura para tabla sisep.componentes_federales
CREATE TABLE IF NOT EXISTS `componentes_federales` (
  `id_componente` int(11) NOT NULL,
  `nombre_componente` char(200) DEFAULT NULL,
  PRIMARY KEY (`id_componente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Volcando datos para la tabla sisep.componentes_federales: ~6 rows (aproximadamente)
DELETE FROM `componentes_federales`;
/*!40000 ALTER TABLE `componentes_federales` DISABLE KEYS */;
INSERT INTO `componentes_federales` (`id_componente`, `nombre_componente`) VALUES
	(3650, 'CAPITALIZACIÓN PRODUCTIVA AGRÍCOLA-INFRAESTRUCTURA Y EQUIPAMIENTO PARA INSTALACIONES PRODUCTIVAS'),
	(3653, 'ESTRATEGIAS INTEGRALES DE POLÍTICA PÚBLICA AGRÍCOLA-PROYECTOS REGIONALES DE DESARROLLO AGRÍCOLA'),
	(3654, 'ESTRATEGIAS INTEGRALES DE POLÍTICA PÚBLICA AGRÍCOLA-AGROCLÚSTER'),
	(3657, 'MEJORAMIENTO PRODUCTIVO DE SUELO Y AGUA-RECUPERACIÓN DE SUELOS CON DEGRADACIÓN AGROQUÍMICA, PRINCIPALMENTE PÉRDIDA DE FERTILIDAD'),
	(3658, 'MEJORAMIENTO PRODUCTIVO DE SUELO Y AGUA-SISTEMAS DE RIEGO TECNIFICADO'),
	(3660, 'ENERGIAS RENOVABLES');
/*!40000 ALTER TABLE `componentes_federales` ENABLE KEYS */;

-- Volcando estructura para tabla sisep.incentivos_federales
CREATE TABLE IF NOT EXISTS `incentivos_federales` (
  `id_incentivo` int(11) NOT NULL AUTO_INCREMENT,
  `idComponente` int(11) DEFAULT NULL,
  `nombre_incentivo` text,
  PRIMARY KEY (`id_incentivo`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Volcando datos para la tabla sisep.incentivos_federales: ~19 rows (aproximadamente)
DELETE FROM `incentivos_federales`;
/*!40000 ALTER TABLE `incentivos_federales` DISABLE KEYS */;
INSERT INTO `incentivos_federales` (`id_incentivo`, `idComponente`, `nombre_incentivo`) VALUES
	(1, NULL, 'INCENTIVO SISTEMAS DE RIEGO TECNIFICADO'),
	(2, NULL, 'INFRAESTRUCTURA Y EQUIPAMIENTO'),
	(3, NULL, 'INFRAESTRUCTURA Y EQUIPAMIENTO PARA PROCESOS DE PRODUCCIÓN Y DE AGREGACIÓN DE VALOR AGRÍCOLA'),
	(4, NULL, 'INFRAESTRUCTURA Y EQUIPAMIENTO DE   POSTPRODUCCIÓN'),
	(5, NULL, 'MAQUINARIA'),
	(6, NULL, 'ACOMPAÑAMIENTO TÉCNICO Y ADMINISTRATIVO'),
	(7, NULL, 'DRENAJE EN TERRENOS AGRÍCOLAS'),
	(8, NULL, 'PROYECTOS INTEGRALES PARA LA PRODUCCIÓN DE ABONOS ORGÁNICOS:  COMPOSTAS, LOMBRICOMPOSTAS Y BIOFERTILIZANTES.'),
	(9, NULL, 'ADQUISICIÓN DE BIOINSUMOS AGRÍCOLAS PARA LA OPTIMIZACIÓN DE COSTOS DE PRODUCCIÓN CON PAQUETES TECNOLÓGICOS'),
	(10, NULL, 'MAQUINARIA Y EQUIPO'),
	(11, NULL, 'INFRAESTRUCTURA Y EQUIPAMIENTO (AGRICULTURA PROTEGIDA)'),
	(12, NULL, 'INFRAESTRUCTURA Y EQUIPAMIENTO (TRANSPORTE)'),
	(13, NULL, 'INFRAESTRUCTURA Y EQUIPAMIENTO(BENEFICIO DE PRODUCTOS AGRICOLAS)'),
	(14, NULL, 'INFRAESTRUCTURA Y EQUIPAMIENTO(SISTEMAS DE RIEGO TECNIFICADOS Y/O AUTOMATIZADOS)'),
	(15, NULL, 'SISTEMAS FOTOVOLTAICOS INTERCONECTADOS'),
	(16, NULL, 'OTROS PROYECTOS DE ENERGÍAS RENOVABLES (FOTOVOLTAICO, BIOMASA, GASIFICACIÓN, EOLICA, GEOTÉRMICA Y/O MINIHIDRAULICA).'),
	(17, NULL, 'SISTEMAS FOTOVOLTAICOS AUTÓNOMOS'),
	(18, NULL, 'SISTEMAS DE APROVECHAMIENTO DE LA BIOMASA A PARTIR DEL ESTABLECIMIENTO O MANTENIMIENTO DE SEMILLEROS Y/O CULTIVOS COMERCIALES PARA LA PRODUCCIÓN DE BIOMASA PARA BIOENERGÉTICOS'),
	(19, NULL, 'MATERIAL VEGETATIVO\r\n');
/*!40000 ALTER TABLE `incentivos_federales` ENABLE KEYS */;

-- Volcando estructura para tabla sisep.programas_federales
CREATE TABLE IF NOT EXISTS `programas_federales` (
  `id_programa` int(11) NOT NULL,
  `nombre_programa` char(200) DEFAULT NULL,
  PRIMARY KEY (`id_programa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Volcando datos para la tabla sisep.programas_federales: ~1 rows (aproximadamente)
DELETE FROM `programas_federales`;
/*!40000 ALTER TABLE `programas_federales` DISABLE KEYS */;
INSERT INTO `programas_federales` (`id_programa`, `nombre_programa`) VALUES
	(36, 'PROGRAMA DE FOMENTO A LA AGRICULTURA');
/*!40000 ALTER TABLE `programas_federales` ENABLE KEYS */;

-- Volcando estructura para tabla sisep.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `alias_usuario` varchar(50) NOT NULL DEFAULT '0',
  `nombre_usuario` varchar(200) NOT NULL,
  `contrasena_usuario` char(32) NOT NULL,
  `correo1_usuario` varchar(100) NOT NULL,
  `correo2_usuario` varchar(100) DEFAULT NULL,
  `id_ano` year(4) NOT NULL,
  `id_programa` int(11) NOT NULL,
  `id_componente` int(11) NOT NULL,
  `id_incentivo` int(11) NOT NULL,
  `acceso_usuario` char(1) NOT NULL DEFAULT 'N',
  `cadena_usuario` char(15) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `alias_usuario` (`alias_usuario`),
  UNIQUE KEY `cadena_usuario` (`cadena_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sisep.usuarios: ~1 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id_usuario`, `alias_usuario`, `nombre_usuario`, `contrasena_usuario`, `correo1_usuario`, `correo2_usuario`, `id_ano`, `id_programa`, `id_componente`, `id_incentivo`, `acceso_usuario`, `cadena_usuario`) VALUES
	(1, 'ebeltran', 'Efrain Beltran Orozco', '123456', 'ebeltran@laria.mx', 'ebeltranorozco@hotmail.com', '0000', 36, 3658, 1, 'N', 'mDKMdkHnyHdejly');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
