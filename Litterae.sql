-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.28 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela litterae.blog
CREATE TABLE IF NOT EXISTS `blog` (
  `codPublicacao` int(11) NOT NULL AUTO_INCREMENT,
  `codCategoria` int(11) NOT NULL DEFAULT '0',
  `Titulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `SubTitulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Descricao` text CHARACTER SET utf8 COLLATE utf8_bin,
  `ImgCapa` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Img1` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Img2` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Img3` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Img4` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `StatusPostagem` enum('D','H') CHARACTER SET utf8 COLLATE utf8_bin DEFAULT 'H',
  `dataPostagem` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`codPublicacao`),
  KEY `FK_Categoria` (`codCategoria`),
  CONSTRAINT `FK_Categoria` FOREIGN KEY (`codCategoria`) REFERENCES `categoria` (`codCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- Copiando dados para a tabela litterae.blog: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` (`codPublicacao`, `codCategoria`, `Titulo`, `SubTitulo`, `Descricao`, `ImgCapa`, `Img1`, `Img2`, `Img3`, `Img4`, `StatusPostagem`, `dataPostagem`) VALUES
	(28, 1, 'Parede de Quarto', 'DecoraÃ§Ã£o Interna', '<p>Parede feita com amor e carinho&nbsp;<strong>no meu quarto</strong>.</p>\r\n', 'WhatsApp Image 2020-10-29 at 18.32.39.jpeg', 'WhatsApp Image 2020-10-29 at 18.20.54.jpeg', NULL, NULL, NULL, 'H', '2020-10-29 20:02:07'),
	(29, 1, 'Parede de Sala', 'Teste Teste', '<p>aaaaaaaaaaaaaaaaaaaaaaaaaa</p>\r\n', 'blogparede-lousa-cozinha.jpg', 'WhatsApp-Image-2018-09-06-at-16.41.13-1.jpeg', NULL, NULL, NULL, 'H', '2020-10-29 20:39:14');
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;

-- Copiando estrutura para tabela litterae.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `codCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `Descricao` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `StatusCategoria` enum('I','A') COLLATE utf8_bin DEFAULT 'A',
  PRIMARY KEY (`codCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela litterae.categoria: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`codCategoria`, `Descricao`, `StatusCategoria`) VALUES
	(1, 'Paredes Personalizadas', 'A'),
	(2, 'Quadros Personalizados', 'A');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Copiando estrutura para tabela litterae.contato
CREATE TABLE IF NOT EXISTS `contato` (
  `codContato` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `TipoProjeto` enum('1','2','3','4') CHARACTER SET latin1 NOT NULL COMMENT '1 - Parede P./ 2 - Quadro P. / 3- Lettering Public. / 4 - Leterring Geral',
  `Descricao` int(11) NOT NULL,
  `DataContato` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `StatusPedido` enum('P','A','C') CHARACTER SET latin1 DEFAULT 'P',
  PRIMARY KEY (`codContato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela litterae.contato: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `contato` DISABLE KEYS */;
/*!40000 ALTER TABLE `contato` ENABLE KEYS */;

-- Copiando estrutura para tabela litterae.slides
CREATE TABLE IF NOT EXISTS `slides` (
  `codSlide` int(11) NOT NULL AUTO_INCREMENT,
  `Imagem` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `StatusSlide` enum('H','D') CHARACTER SET latin1 NOT NULL DEFAULT 'H',
  PRIMARY KEY (`codSlide`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela litterae.slides: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `slides` DISABLE KEYS */;
INSERT INTO `slides` (`codSlide`, `Imagem`, `StatusSlide`) VALUES
	(2, 'arte-lettering-na-parede-arte.jpg', 'H');
/*!40000 ALTER TABLE `slides` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
