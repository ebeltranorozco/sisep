-- --------------------------------------------------------
-- Host:                         culiacan.laria.mx
-- Versión del servidor:         5.5.52-0ubuntu0.14.04.1 - (Ubuntu)
-- SO del servidor:              debian-linux-gnu
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla muestras.estudios
CREATE TABLE IF NOT EXISTS `estudios` (
  `ID_ESTUDIO` int(2) NOT NULL AUTO_INCREMENT,
  `METODOLOGIA_ESTUDIO` char(200) NOT NULL,
  `AREA_ESTUDIO` char(1) DEFAULT NULL,
  `STATUS_ESTUDIO` char(1) DEFAULT 'A',
  `CONSECUTIVO_ESTUDIO` int(11) DEFAULT '0',
  `PRECIO_ESTUDIO` int(10) NOT NULL,
  `ALIAS_ESTUDIO` char(10) NOT NULL,
  `DURACION_MIN_ESTUDIO` int(2) NOT NULL DEFAULT '5',
  `DURACION_MAX_ESTUDIO` int(2) NOT NULL DEFAULT '10',
  `TOPE_ESTUDIO` int(2) NOT NULL DEFAULT '8',
  `ANALISIS_SOLICITADO` char(255) NOT NULL,
  `NOMBRE_CPO1_INFORME` char(30) DEFAULT 'S/N',
  `NOMBRE_CPO2_INFORME` char(30) DEFAULT 'S/N',
  `VALIDADO_ESTUDIO` char(1) NOT NULL DEFAULT 'S',
  `ACREDITADO_ESTUDIO` char(1) NOT NULL DEFAULT 'S',
  `ID_IDR` int(5) NOT NULL,
  `REFERENCIA_ESTUDIO` char(254) NOT NULL DEFAULT 'METODO INTERNO',
  `RECONOCIDO_ESTUDIO` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`ID_ESTUDIO`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla muestras.estudios: ~15 rows (aproximadamente)
DELETE FROM `estudios`;
/*!40000 ALTER TABLE `estudios` DISABLE KEYS */;
INSERT INTO `estudios` (`ID_ESTUDIO`, `METODOLOGIA_ESTUDIO`, `AREA_ESTUDIO`, `STATUS_ESTUDIO`, `CONSECUTIVO_ESTUDIO`, `PRECIO_ESTUDIO`, `ALIAS_ESTUDIO`, `DURACION_MIN_ESTUDIO`, `DURACION_MAX_ESTUDIO`, `TOPE_ESTUDIO`, `ANALISIS_SOLICITADO`, `NOMBRE_CPO1_INFORME`, `NOMBRE_CPO2_INFORME`, `VALIDADO_ESTUDIO`, `ACREDITADO_ESTUDIO`, `ID_IDR`, `REFERENCIA_ESTUDIO`, `RECONOCIDO_ESTUDIO`) VALUES
	(1, 'LARIA-AQ-PM001 Determinación de Residuos de Plaguicidas en Alimentos por Cromatografía de Gases y Líquidos MS/MS. * ¹							', 'Q', 'A', 126, 1565, 'PM001', 5, 10, 10, 'Determinación de Residuos de Plaguicidas', 'Limite de Cuantificación', 'Tecnica', 'S', 'S', 2, 'MÉTODO INTERNO', 'S'),
	(2, 'LARIA-AQ-PM003 Determinación de aflatoxinas totales en maíz por LC-MS/MS. *', 'Q', 'A', 1, 700, 'PM003', 5, 10, 10, 'Determinación de aflatoxinas totales', 'C.H.', 'C.A.', 'S', 'S', 1, 'MÉTODO INTERNO', 'N'),
	(3, 'NMX-AA-051-SCFI-2001. Análisis de agua - determinación de metales por Absorción Atómica en aguas naturales, potables, Residuales y residuales tratadas - método de prueba. *', 'Q', 'A', 13, 200, 'PM002', 5, 10, 10, 'Determinación de Metales', 'INFO1', 'INFO2', 'S', 'S', 5, 'LARIA-AQ-PM002 Determinación de Mercurio en Agua Potable por Espectrofotometría de Absorción Atómica-Horno de Grafito', 'N'),
	(4, 'LARIA-MB-PM001 Método interno basado en la NOM-210-SSA1-2014 apéndice A. Para la detección de <i>Salmonella</i> spp. en alimentos. * ²							', 'M', 'A', 180, 380, 'PM001', 5, 10, 10, 'Detección de <i>Salmonella</i> spp.', 'INFO1', 'INFO2', 'S', 'S', 3, 'MÉTODO INTERNO', 'S'),
	(5, 'LARIA-MB-PM009 Método interno para la detección de <i>Salmonella</i> spp. en alimentos mediante PCR Tiempo Real. * ²', 'M', 'A', 1, 450, 'PM009', 5, 10, 10, 'Detección de <i>Salmonella</i> spp.', 'INFO1', 'INFO2', 'S', 'S', 3, 'MÉTODO INTERNO', 'S'),
	(11, 'LARIA-MB-PM008   Método interno basado en la NOM-210-SSA1-2014 apéndice C. Para la detección de <i>Listeria monocytogenes</i> en alimentos. * ²', 'M', 'A', 1, 380, 'PM008', 5, 10, 10, 'Detección de <i>Lysteria monocytogenes</i>', 'S/N', 'S/N', 'S', 'S', 3, 'MÉTODO INTERNO', 'S'),
	(12, 'LARIA-AQ-PM004 Determinación de Mercurio en Agua Potable por Espectrofotometría de Absorción Atómica - Vapor Frio. *', 'Q', 'A', 9, 250, 'PM004', 5, 10, 10, 'Determinación de Mercurio', 'S/N', 'S/N', 'S', 'S', 4, 'NMX-AA-051-SCFI-2016 Análisis de agua - Medición de metales por absorción atómica en aguas naturales, potables, residuales y residuales tratadas - método de prueba.', 'N'),
	(13, 'LARIA-MB-PM007 Método interno para la detección de <i>Escherichia coli</i> O157:H7 en vegetales mediante PCR Tiempo Real. ²', 'M', 'A', 11, 450, 'PM007', 5, 10, 10, 'Detección de <i>Escherichia coli</i> O157:H7', 'S/N', 'S/N', 'S', 'N', 3, 'MÉTODO INTERNO', 'N'),
	(14, 'LARIA-MB-PM010  Método interno para la detección de <i>Listeria monocytogenes</i> en alimentos mediante PCR Tiempo Real. *', 'M', 'A', 1, 450, 'PM010', 5, 10, 10, 'Detección de <i>Listeria monocytogenes</i>', 'S/N', 'S/N', 'S', 'S', 3, 'MÉTODO INTERNO', 'N'),
	(18, 'LARIA-MB-PM015 Método interno para la detección de <i>Listeria monocytogenes</i> en vegetales mediante PCR Tiempo Real. ²', 'M', 'A', 1, 1000, 'PM015', 5, 10, 10, 'Detección de <i>Listeria monocytogenes</i>', 'S/N', 'S/N', 'S', 'N', 3, 'MÉTODO INTERNO', 'S'),
	(19, 'LARIA-MB-PM005 Detección de  <i>Shigella</i> spp. en vegetales.', 'M', 'A', 1, 380, 'PM005', 5, 10, 10, 'Detección de <i>Shigella</i> spp.', 'S/N', 'S/N', 'N', 'N', 3, 'MÉTODO INTERNO', 'N'),
	(20, 'LARIA-MB-PM002 Método para la estimación de la densidad de Coliformes Totales, Coliformes Fecales y <i> Escherichia coli </i> por la técnica del Número Más Probable en agua para uso y consumo humano.', 'M', 'A', 4, 450, 'PM002', 5, 10, 10, 'Estimación de CT, CF y <i>E.coli</i> por NMP', 'S/N', 'S/N', 'N', 'N', 3, 'Norma Oficial Mexicana NOM-210-SSA1-2014. Productos y servicios. Métodos de prueba microbiológicos. Determinación de microorganismos indicadores. Determinación de microorganismos patógenos. Apéndice H Normativo. Método aprobado para la estimación de la', 'N'),
	(21, 'LARIA-MB-PM017  Método para la detección de <i>Salmonella</i> spp. en agua mediante filtración por membrana, y/o superficies vivas e inertes', 'M', 'A', 4, 1000, 'PM017', 5, 10, 10, 'Detección de <i>Salmonella</i> spp', 'S/N', 'S/N', 'N', 'N', 3, 'NMX-AA-102-SCFI-2006. Calidad del agua – Detección y enumeración de organismos coliformes, organismos coliformes termotolerantes y Escherichia coli presuntiva – Método de filtración en membrana.', 'N'),
	(22, 'LARIA-MB-PM004 Método para la cuenta de mohos y levaduras en alimentos', 'M', 'A', 2, 300, 'PM004', 5, 10, 10, 'Determinación de Mohos y Levaduras', 'S/N', 'S/N', 'N', 'N', 3, 'Norma Oficial Mexicana NOM-111-SSA1-1994, Bienes y servicios. Método para la cuenta de mohos y levaduras en alimentos', 'N'),
	(23, 'LARIA-MB-PM016 Método para la determinación de Coliformes Totales, Coliformes Fecales y <i>E. coli</i> en agua y/o superficies vivas e inertes mediante filtración por membrana', 'M', 'A', 106, 1000, 'PM016', 5, 10, 10, 'Determinación de CT, CF y <i>E.coli</i> por filtración por membrana', 'S/N', 'S/N', 'N', 'N', 3, 'Método interno', 'N');
/*!40000 ALTER TABLE `estudios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
