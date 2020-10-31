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

-- Copiando dados para a tabela litterae.blog: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` (`codPublicacao`, `codCategoria`, `Titulo`, `SubTitulo`, `Descricao`, `ImgCapa`, `Img1`, `Img2`, `Img3`, `Img4`, `StatusPostagem`, `dataPostagem`) VALUES
	(28, 1, 'Parede de Quarto', 'DecoraÃ§Ã£o Interna', '<p>Parede feita com amor e carinho&nbsp;<strong>no meu quarto</strong>.</p>\r\n', 'WhatsApp Image 2020-10-29 at 18.32.39.jpeg', 'WhatsApp Image 2020-10-29 at 18.20.54.jpeg', NULL, NULL, NULL, 'H', '2020-10-29 20:02:07'),
	(29, 1, 'Parede de Sala', 'Teste Teste', '<p>aaaaaaaaaaaaaaaaaaaaaaaaaa</p>\r\n', 'blogparede-lousa-cozinha.jpg', 'WhatsApp-Image-2018-09-06-at-16.41.13-1.jpeg', NULL, NULL, NULL, 'H', '2020-10-29 20:39:14');
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;

-- Copiando dados para a tabela litterae.categoria: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`codCategoria`, `Descricao`, `StatusCategoria`) VALUES
	(1, 'Paredes Personalizadas', 'A'),
	(2, 'Quadros Personalizados', 'A');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
