-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 27, 2019 at 03:45 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisfokol_ppdb2`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminx`
--

CREATE TABLE `adminx` (
  `kd` varchar(50) NOT NULL DEFAULT '',
  `usernamex` varchar(15) NOT NULL DEFAULT '',
  `passwordx` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminx`
--

INSERT INTO `adminx` (`kd`, `usernamex`, `passwordx`) VALUES
('e4ea2f7dfb2e5c51e38998599e90afc2', 'admin', 'e9b690b66c32ca3237bb283e718f342a');

-- --------------------------------------------------------

--
-- Table structure for table `cp_g_foto`
--

CREATE TABLE `cp_g_foto` (
  `kd` varchar(50) NOT NULL,
  `nama` longtext NOT NULL,
  `filex` longtext NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `cp_g_foto`
--

INSERT INTO `cp_g_foto` (`kd`, `nama`, `filex`, `postdate`) VALUES
('95d21af11efec57ab076ef7b885e3da6', 'wah....', '95d21af11efec57ab076ef7b885e3da6-1.png', '2019-12-27 02:43:09'),
('99b79785ff114e1687b60772eed32dad', 'tekniknih...', '99b79785ff114e1687b60772eed32dad-1.png', '2019-12-27 02:43:29'),
('38b7978b2f2a9cc300909365a33f863a', 'hehehehe', '38b7978b2f2a9cc300909365a33f863a-1.png', '2019-12-27 02:43:42'),
('eff19ed16e45914dae65037fcde26afa', 'teknik nobar', 'eff19ed16e45914dae65037fcde26afa-1.png', '2019-12-27 02:43:59'),
('7a1f84274ce65a3968832e48c5b77322', 'teknik panas', '7a1f84274ce65a3968832e48c5b77322-1.png', '2019-12-27 02:44:21');

-- --------------------------------------------------------

--
-- Table structure for table `cp_g_video`
--

CREATE TABLE `cp_g_video` (
  `kd` varchar(50) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `filex` longtext NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `cp_g_video`
--

INSERT INTO `cp_g_video` (`kd`, `judul`, `filex`, `postdate`) VALUES
('f3a7a6bdb5b3cddfb852962ba200551f', 'iklan satu', 'https:xgmringxxgmringxwww.youtube.comxgmringxwatch?v=qSk1E5BOGlo', '2019-12-27 02:49:42'),
('5069c9dc7d777a24642b81ac06856e07', 'iklan lucu 2', 'https:xgmringxxgmringxwww.youtube.comxgmringxwatch?v=qGIMmFukoF4&ampxkommaxampxkommaxt=45s', '2019-12-27 02:51:20'),
('e590313002eaaad15a358d6e712e140f', 'iklan 3', 'https:xgmringxxgmringxwww.youtube.comxgmringxwatch?v=LLZpN8xgwahxjBxgwahx0', '2019-12-27 02:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `cp_m_slideshow`
--

CREATE TABLE `cp_m_slideshow` (
  `kd` varchar(50) NOT NULL,
  `filex` longtext NOT NULL,
  `nama` varchar(100) NOT NULL,
  `isi` longtext NOT NULL,
  `postdate` datetime NOT NULL,
  `urlnya` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `cp_m_slideshow`
--

INSERT INTO `cp_m_slideshow` (`kd`, `filex`, `nama`, `isi`, `postdate`, `urlnya`) VALUES
('a91243e62ca6c0c6f3c7c4134005c21e', 'a91243e62ca6c0c6f3c7c4134005c21e-1.jpg', 'slide 1', 'slide 1 contoh...', '2019-12-27 02:46:58', 'github.comxgmringxhajirodeon'),
('18c97aac2f0c2a3ed8eb303685a53661', '18c97aac2f0c2a3ed8eb303685a53661-1.jpg', 'slide 2', 'slide 2 contoh', '2019-12-27 02:47:25', 'suratkantor.com'),
('f38ed5fb9e4694fd51129e271d41069e', 'f38ed5fb9e4694fd51129e271d41069e-1.jpg', 'slide 3', 'slide 3', '2019-12-27 02:47:57', 'kasirkamu.com'),
('a80144cb9ab2eae79b2fffd97e649e5a', 'a80144cb9ab2eae79b2fffd97e649e5a-1.jpg', 'slide 4', 'slide 4', '2019-12-27 02:48:34', 'google.com'),
('09e185450c7d6b6b374623a2436866c2', '09e185450c7d6b6b374623a2436866c2-1.jpg', 'slide 5', 'slide 5', '2019-12-27 02:49:01', 'facebook.com');

-- --------------------------------------------------------

--
-- Table structure for table `cp_profil`
--

CREATE TABLE `cp_profil` (
  `kd` varchar(50) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` longtext NOT NULL,
  `postdate` datetime NOT NULL,
  `x_lat` longtext NOT NULL,
  `x_long` longtext NOT NULL,
  `fb` longtext NOT NULL,
  `twitter` longtext NOT NULL,
  `youtube` longtext NOT NULL,
  `wa` longtext NOT NULL,
  `alamat` longtext NOT NULL,
  `telp` longtext NOT NULL,
  `web` longtext NOT NULL,
  `fax` longtext NOT NULL,
  `email` longtext NOT NULL,
  `filex` longtext NOT NULL,
  `alamat_googlemap` longtext NOT NULL,
  `instagram` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cp_profil`
--

INSERT INTO `cp_profil` (`kd`, `judul`, `isi`, `postdate`, `x_lat`, `x_long`, `fb`, `twitter`, `youtube`, `wa`, `alamat`, `telp`, `web`, `fax`, `email`, `filex`, `alamat_googlemap`, `instagram`) VALUES
('e807f1fcf82d132f9bb018ca6738a19f', 'Sekolah BIASAWAE', 'Biasakan Hidup Seperti Biasa. BIASAWAE.', '2019-12-27 02:39:57', '', '', 'hajirodeon', 'hajirodeon', 'hajirodeon', '0818298854', 'Kendal, Jawa Tengah', '0818298854', 'http:xgmringxxgmringxgithub.comxgmringxhajirodeon', '0818298854', 'hajirodeonxtkeongxgmail.com', 'logo.jpg', 'Omahbiasawae, Cegunan, Tegorejo, Pegandon, Kendal, Jawa Tengah', 'hajirodeon');

-- --------------------------------------------------------

--
-- Table structure for table `cp_visitor`
--

CREATE TABLE `cp_visitor` (
  `kd` varchar(50) NOT NULL,
  `ipnya` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL,
  `online` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `cp_visitor`
--

INSERT INTO `cp_visitor` (`kd`, `ipnya`, `postdate`, `online`) VALUES
('00909b0ba9f8e024b509f2e849b67e1e', '127.0.0.1', '2019-12-27 02:20:29', 'false'),
('2a98d85b9e26f565ad20f0e48b88cf88', '127.0.0.1', '2019-12-27 02:36:48', 'false'),
('9300878e9edf3c11fddef630fcfb7ec9', '127.0.0.1', '2019-12-27 02:38:06', 'false'),
('b23582c978d36441ee76ee216c89beca', '127.0.0.1', '2019-12-27 02:55:04', 'false'),
('f6df41187cd57719580d44300a93db47', '127.0.0.1', '2019-12-27 02:56:12', 'false'),
('392e6b55dc1d386d763edc5ccc0ab205', '127.0.0.1', '2019-12-27 02:56:15', 'false'),
('9623b65e75c878b116649d14ed635635', '127.0.0.1', '2019-12-27 02:56:17', 'false'),
('06a52c0adaf9a244b697816933dafdac', '127.0.0.1', '2019-12-27 02:56:49', 'false'),
('b4c473138913b5c288702aea2e8b06e5', '127.0.0.1', '2019-12-27 02:56:52', 'false'),
('f8bea5171af48efbed863ea8b8d0dc62', '127.0.0.1', '2019-12-27 02:56:54', 'false'),
('0c1c671888ee4bb232edfae09bc8b36a', '127.0.0.1', '2019-12-27 02:56:59', 'false'),
('139e2298f3e54978e46617d94388413d', '127.0.0.1', '2019-12-27 02:57:05', 'false'),
('5c6f6b6a9345b712430ef33ba90510dd', '127.0.0.1', '2019-12-27 02:57:07', 'false'),
('4a48220df395cb33ac80d0f61ed8501f', '127.0.0.1', '2019-12-27 02:57:10', 'false'),
('9a2121a5bfbeea51f9d519fa660a88d8', '127.0.0.1', '2019-12-27 02:57:18', 'false'),
('c0d816c170a9494a3843db058002a2df', '127.0.0.1', '2019-12-27 02:57:24', 'false'),
('e90bacd45c84cf320c4b91b70a94d6ae', '127.0.0.1', '2019-12-27 02:57:26', 'false'),
('efc27196855f2ce967f73b29a528527c', '127.0.0.1', '2019-12-27 02:57:59', 'false'),
('062cad7948e7bab47fd0594f2c622149', '127.0.0.1', '2019-12-27 02:58:01', 'false'),
('c3e36dd15a10769cb82412a1c1cab230', '127.0.0.1', '2019-12-27 02:58:14', 'false'),
('fee166dfb69e16c0c3268604df28afc7', '127.0.0.1', '2019-12-27 02:58:24', 'false'),
('b2a65985397225e314e08f9fabf4ff72', '127.0.0.1', '2019-12-27 02:58:27', 'false'),
('a756dd077b064df672b1c7b222a0c468', '127.0.0.1', '2019-12-27 02:58:50', 'false'),
('79010a1f5a2ba08f8a8fa3c1966d118c', '127.0.0.1', '2019-12-27 02:58:53', 'false'),
('752570fb672671df51ee7653f040952b', '127.0.0.1', '2019-12-27 02:59:04', 'false'),
('8352f6213a0c90001dacd46b7e3a5c6e', '127.0.0.1', '2019-12-27 02:59:46', 'false'),
('13c01c851fd173872bcbc6dffce4cfa8', '127.0.0.1', '2019-12-27 03:00:39', 'true'),
('071fb9be38b97827bbed8f833a95ec42', '127.0.0.1', '2019-12-27 03:01:40', 'true'),
('426bb5d270cbdd32f27bdd46e21d09f7', '127.0.0.1', '2019-12-27 03:02:07', 'true'),
('c37039bf1517f9e08eb203bce6f6cd3e', '127.0.0.1', '2019-12-27 03:02:11', 'true'),
('c0e3b5e05a5dea576ebe69d1e533497e', '127.0.0.1', '2019-12-27 03:06:43', 'true'),
('a11a1fa81ca2413cd0772343142ce2d6', '127.0.0.1', '2019-12-27 03:07:14', 'true'),
('24adb68b965c6d20630d72b242022a8a', '127.0.0.1', '2019-12-27 03:07:29', 'true'),
('3287f1eaa6a63d6cd47e076dcd3c7e9f', '127.0.0.1', '2019-12-27 03:08:00', 'true'),
('9bed93f5b826cc2998c5f49eda1f701f', '127.0.0.1', '2019-12-27 03:08:27', 'true'),
('959f51b1455024cdffd8e44b627232a2', '127.0.0.1', '2019-12-27 03:09:23', 'true'),
('c753b42a9039d2cdd92a618a75ce9f27', '127.0.0.1', '2019-12-27 03:09:49', 'true'),
('2230aa270d3efc4a5cdea8e8164878b5', '127.0.0.1', '2019-12-27 03:09:54', 'true'),
('84afd512585269a0114146b272e179a7', '127.0.0.1', '2019-12-27 03:10:20', 'true'),
('f0d1baf83942a1a53a73f26dc2f36f5c', '127.0.0.1', '2019-12-27 03:10:46', 'true'),
('ee8226ce5a888039e03021e5cb6fbf47', '127.0.0.1', '2019-12-27 03:11:06', 'true'),
('7d75b7ff5fc7dcbd58e45fdb1f9150fe', '127.0.0.1', '2019-12-27 03:11:08', 'true'),
('a7a4941520b079f4924f678e822457b1', '127.0.0.1', '2019-12-27 03:11:11', 'true'),
('9c325826658d2ece68001721e0c664af', '127.0.0.1', '2019-12-27 03:11:13', 'true'),
('53be830a9a9de0d63b9bbf020f7ace71', '127.0.0.1', '2019-12-27 03:11:14', 'true'),
('7cbe5fde3d58dd736dceded51c20fee4', '127.0.0.1', '2019-12-27 03:11:17', 'true'),
('c8bb92117042a3eab3cd972fdf128e50', '127.0.0.1', '2019-12-27 03:11:19', 'true'),
('0b94ed729b70506b8ecefca1e8d7adde', '127.0.0.1', '2019-12-27 03:11:21', 'true'),
('cd2aef98d20cca62a847c37b309d2758', '127.0.0.1', '2019-12-27 03:12:41', 'true'),
('04acabef294687291a58eea3f73f53fc', '127.0.0.1', '2019-12-27 03:13:02', 'true'),
('e03747f61cfe1ec1211b0931df3f1df3', '127.0.0.1', '2019-12-27 03:13:11', 'true'),
('1fb1e672df4add18e0a4270fe310139d', '127.0.0.1', '2019-12-27 03:13:37', 'true'),
('51220e01f53b5ac8f9f1ce3a759e6fa2', '127.0.0.1', '2019-12-27 03:13:41', 'true'),
('d3030533082303c276b14fc32e2ef5bb', '127.0.0.1', '2019-12-27 03:13:51', 'true'),
('fc0eec593f0c3e3c9e2716ac02ea135d', '127.0.0.1', '2019-12-27 03:21:24', 'true'),
('d6c91de839af4d309a968d1fefc188c5', '127.0.0.1', '2019-12-27 03:21:26', 'true'),
('89553037cae9d068fc2489790bf8ca7b', '127.0.0.1', '2019-12-27 03:21:28', 'true'),
('3d0f63304a22b6e0faabaf3894150103', '127.0.0.1', '2019-12-27 03:21:33', 'true'),
('7d6a5564f89ed65880f67ae032afa03d', '127.0.0.1', '2019-12-27 03:21:35', 'true'),
('738c15a859bef9eeb59d6b51ab32a987', '127.0.0.1', '2019-12-27 03:22:00', 'true'),
('c0acd978782e46e0593cb59b263562b4', '127.0.0.1', '2019-12-27 03:22:04', 'true'),
('133dafb5fea5d018cd84fa96b0eee6a8', '127.0.0.1', '2019-12-27 03:22:32', 'true'),
('1487a79c11c61ee82fda16bcce8ad5c2', '127.0.0.1', '2019-12-27 03:22:37', 'true'),
('c565c1ada1775de96fc95cce547f7629', '127.0.0.1', '2019-12-27 03:24:35', 'true'),
('61e6894f8ec74394fdce0a887eb80fb3', '127.0.0.1', '2019-12-27 03:24:45', 'true'),
('1a33eb2fa2d14e1847e4333cf7c3b282', '127.0.0.1', '2019-12-27 03:25:45', 'true'),
('e517ff8a9c9f175af8a70e8791d6b5df', '127.0.0.1', '2019-12-27 03:26:19', 'true'),
('ed74eb4ceb126d8235f304ae3f9faf52', '127.0.0.1', '2019-12-27 03:26:23', 'true'),
('c6383900eaa4c616b48db7ca16e98c10', '127.0.0.1', '2019-12-27 03:26:25', 'true'),
('7190c49cd7dcb08d6b2f2c0637875b17', '127.0.0.1', '2019-12-27 03:26:30', 'true'),
('085f2f99c0addfcc69f216a3ccb5ac8a', '127.0.0.1', '2019-12-27 03:26:33', 'true'),
('52a583d7b877737b6ea4c6e6eb867b20', '127.0.0.1', '2019-12-27 03:26:38', 'true'),
('858a62b9d107e425d23e93f5622f4b19', '127.0.0.1', '2019-12-27 03:28:32', 'true'),
('4b5ea8aa7e9556702d8de1a31b52fd5f', '127.0.0.1', '2019-12-27 03:30:41', 'true'),
('f9e5f46887cf44da90c10a9ac8b52cc5', '127.0.0.1', '2019-12-27 03:32:21', 'true'),
('c21c48ca3d2522266b920b08abb7e3bd', '127.0.0.1', '2019-12-27 03:32:44', 'true'),
('e5de3f8a4a407ff0abd5047e173a97ef', '127.0.0.1', '2019-12-27 03:33:16', 'true'),
('d15cd853b9edb03c066748ead4506200', '127.0.0.1', '2019-12-27 03:33:21', 'true'),
('581a0865b5afd4f316bdea526fa2d88e', '127.0.0.1', '2019-12-27 03:33:24', 'true'),
('8ef82c636a7a93a7920a5f0bcf3aa3c5', '127.0.0.1', '2019-12-27 03:33:55', 'true'),
('a510b9f4b1b5a1faa0dc7b67413f4df6', '127.0.0.1', '2019-12-27 03:34:20', 'true'),
('5a3379668745852a53bcc68d7f096b6d', '127.0.0.1', '2019-12-27 03:34:25', 'true'),
('9930a3e43bc30ac17e5bc50912efb456', '127.0.0.1', '2019-12-27 03:34:40', 'true'),
('74b0991e6a548bed874c85b660bd4b31', '127.0.0.1', '2019-12-27 03:35:27', 'true'),
('f40d59f4951ad7c45f7a75368d85912b', '127.0.0.1', '2019-12-27 03:35:33', 'true'),
('76be9d77235cc31a0a148a00a9d0b3c2', '127.0.0.1', '2019-12-27 03:35:36', 'true'),
('32ee8826ed91e63ab9367427a47972f6', '127.0.0.1', '2019-12-27 03:35:40', 'true'),
('da6492aea031dcbaa7edfdbf47cb804b', '127.0.0.1', '2019-12-27 03:35:57', 'true'),
('61b33ea3caf6247c296a1353e1a71c25', '127.0.0.1', '2019-12-27 03:36:00', 'true'),
('d9f1344d3795480d95dfc51697a02c04', '127.0.0.1', '2019-12-27 03:36:12', 'true'),
('9e32c8eec5a1b12ba38f805ceacc94f6', '127.0.0.1', '2019-12-27 03:36:15', 'true'),
('a4b07c886588e5890524d6c9c0ddf514', '127.0.0.1', '2019-12-27 03:36:26', 'true'),
('07b42a1d3db73eef6af6cebf50df2e3e', '127.0.0.1', '2019-12-27 03:36:28', 'true'),
('a4e3de51885e162b11fe21317dcfe6bc', '127.0.0.1', '2019-12-27 03:37:52', 'true'),
('2862ed6b3f7a885075da9b8da8d3b258', '127.0.0.1', '2019-12-27 03:37:58', 'true'),
('5f1ec92143da731443017b08cd0fc0b7', '127.0.0.1', '2019-12-27 03:38:00', 'true'),
('896a138111dd3afbfc0bb7ddbcda494f', '127.0.0.1', '2019-12-27 03:38:14', 'true'),
('c90e5a12ef96b0444405b8759d29c15b', '127.0.0.1', '2019-12-27 03:38:34', 'true'),
('8f7dcb9bdf98b013bfa0fd8ffa8d6797', '127.0.0.1', '2019-12-27 03:38:37', 'true'),
('f738cafcbf1ddbaf9aa5173c13d0cd25', '127.0.0.1', '2019-12-27 03:38:38', 'true'),
('c7721894514e62f08e27a436f22bd88a', '127.0.0.1', '2019-12-27 03:38:42', 'true'),
('86b775dbc603c94a2e79dd64bd83d9ec', '127.0.0.1', '2019-12-27 03:38:44', 'true'),
('ce2648a20a867bc0249f1280227566f6', '127.0.0.1', '2019-12-27 03:38:47', 'true'),
('659943ff8858c9d26a6bc77779db2e29', '127.0.0.1', '2019-12-27 03:39:01', 'true'),
('60661cf3a6ca3cef5b912137167921c1', '127.0.0.1', '2019-12-27 03:39:57', 'true'),
('121adf61bab5e7c86303f6023c8744b0', '127.0.0.1', '2019-12-27 03:40:11', 'true'),
('32985c2084275fc5309b2967108b251a', '127.0.0.1', '2019-12-27 03:40:18', 'true'),
('8475663a4435bb2972f4db77df6740d2', '127.0.0.1', '2019-12-27 03:40:21', 'true'),
('624763f2f441994bd502a5ad36281ca0', '127.0.0.1', '2019-12-27 03:40:24', 'true'),
('ea6e6e057e6d0af75d369f991b64e765', '127.0.0.1', '2019-12-27 03:40:27', 'true'),
('969f842e89d38d04e243f71cf713b075', '127.0.0.1', '2019-12-27 03:40:34', 'true'),
('231a82568ada09228c294d90f41afde3', '127.0.0.1', '2019-12-27 03:40:36', 'true'),
('2bd24ef68428fedf39691218d66af071', '127.0.0.1', '2019-12-27 03:40:38', 'true'),
('15c934d00f749ecce6cbe57a6d719280', '127.0.0.1', '2019-12-27 03:40:39', 'true'),
('89651d6273a3cd02a6db5a70b3ad6dd7', '127.0.0.1', '2019-12-27 03:40:40', 'true'),
('5cf0d723d71c60ad05eb705d57fb4082', '127.0.0.1', '2019-12-27 03:40:42', 'true'),
('f71a29c80e94e928d91ecd9f66789244', '127.0.0.1', '2019-12-27 03:40:59', 'true'),
('55c51ae48cf5168f3d64725251a8c540', '127.0.0.1', '2019-12-27 03:41:00', 'true'),
('ee878745f31875ab4b67f9fc160d76eb', '127.0.0.1', '2019-12-27 03:41:02', 'true'),
('23df3fcadc52ad1382f844e9a4f03536', '127.0.0.1', '2019-12-27 03:41:32', 'true'),
('11a5a4ba8ceba414c481ef5e013f098d', '127.0.0.1', '2019-12-27 03:41:34', 'true'),
('c04763c1b00639aed052b81384a7abfc', '127.0.0.1', '2019-12-27 03:41:38', 'true'),
('cfdca83e4b9c624f1a2356a0e8857086', '127.0.0.1', '2019-12-27 03:42:43', 'true'),
('c5c01cd5ff58e67ebb37b8baefe4b1f4', '127.0.0.1', '2019-12-27 03:42:50', 'true'),
('f73a19fa179ea3b3ce5f1d249db3aade', '127.0.0.1', '2019-12-27 03:42:53', 'true'),
('9512322acaf507d593bedeec7654b09f', '127.0.0.1', '2019-12-27 03:43:15', 'true'),
('bae852d2ac7a76022ad3cccb0be137f8', '127.0.0.1', '2019-12-27 03:43:18', 'true'),
('49753042aac21315685ed9e71b30d0ed', '127.0.0.1', '2019-12-27 03:43:46', 'true'),
('10050b38c9f0f83348563438b35eebd6', '127.0.0.1', '2019-12-27 03:43:48', 'true'),
('397f7aab44c41e5c84196b28146d36a3', '127.0.0.1', '2019-12-27 03:43:51', 'true'),
('75ec79d1cc3d357cad4d2eeb0487c4e5', '127.0.0.1', '2019-12-27 03:44:00', 'true'),
('3b65561bdd77a22637b9fa3d7daddcf9', '127.0.0.1', '2019-12-27 03:44:02', 'true'),
('6fe2c42c63c7481e61b6f5545414098e', '127.0.0.1', '2019-12-27 03:44:03', 'true'),
('9934df4d09d072b6e84b03d656eb2e6f', '127.0.0.1', '2019-12-27 03:44:05', 'true'),
('e6ef000daa00db084bede2d400d3f4f9', '127.0.0.1', '2019-12-27 03:44:07', 'true'),
('0c340f0d217fe828e4d0d8a511945579', '127.0.0.1', '2019-12-27 03:44:08', 'true'),
('cbd7614796113910ad1b76fed728df3a', '127.0.0.1', '2019-12-27 03:44:55', 'true'),
('c49ed19b4dc6b9d7a36323d77492f014', '127.0.0.1', '2019-12-27 03:45:52', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `m_agama`
--

CREATE TABLE `m_agama` (
  `kd` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_agama`
--

INSERT INTO `m_agama` (`kd`, `nama`) VALUES
('1', 'Islam'),
('2', 'Kristen Protestan'),
('3', 'Katholik'),
('4', 'Hindu'),
('5', 'Budha'),
('6', 'Konghucu'),
('7', 'Kepercayaan Kepada Tuhan YME');

-- --------------------------------------------------------

--
-- Table structure for table `m_alasan_pip`
--

CREATE TABLE `m_alasan_pip` (
  `kd` varchar(50) NOT NULL,
  `no` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_alasan_pip`
--

INSERT INTO `m_alasan_pip` (`kd`, `no`, `nama`) VALUES
('1', '1', 'Pemegang PKH/KPS/KIP'),
('2', '2', 'Penerima BSM 2014'),
('3', '3', 'Yatim Piatu/Panti Asuhan/Panti Sosial'),
('4', '4', 'Dampak Bencana Alam'),
('5', '5', 'Pernah Drop Out'),
('6', '6', 'Siswa Miskin / Rentan Miskin'),
('7', '7', 'Daerah Konflik'),
('8', '8', 'Keluarga Terpidana'),
('9', '9', 'Kelainan Fisik');

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis`
--

CREATE TABLE `m_jenis` (
  `kd` varchar(50) NOT NULL,
  `no` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_jenis`
--

INSERT INTO `m_jenis` (`kd`, `no`, `nama`) VALUES
('1', '1', 'Sains'),
('2', '2', 'Seni'),
('3', '3', 'Olah Raga'),
('4', '4', 'Lain - lain');

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis2`
--

CREATE TABLE `m_jenis2` (
  `kd` varchar(50) NOT NULL,
  `no` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_jenis2`
--

INSERT INTO `m_jenis2` (`kd`, `no`, `nama`) VALUES
('1', '1', 'Anak Berprestasi'),
('2', '2', 'Anak Miskin'),
('3', '3', 'Pendidikan'),
('4', '4', 'Unggulan'),
('5', '5', 'Lain - lain');

-- --------------------------------------------------------

--
-- Table structure for table `m_karena`
--

CREATE TABLE `m_karena` (
  `kd` varchar(50) NOT NULL,
  `no` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_karena`
--

INSERT INTO `m_karena` (`kd`, `no`, `nama`) VALUES
('1', '1', 'Lulus'),
('2', '2', 'Mutasi'),
('3', '3', 'Dikeluarkan'),
('4', '4', 'Mengundurkan Diri'),
('5', '5', 'Putus Sekolah'),
('6', '6', 'Wafat'),
('7', '7', 'Hilang'),
('8', '8', 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `m_kebutuhan`
--

CREATE TABLE `m_kebutuhan` (
  `kd` varchar(50) NOT NULL,
  `no` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kebutuhan`
--

INSERT INTO `m_kebutuhan` (`kd`, `no`, `nama`) VALUES
('1', '1', 'Tidak'),
('2', '2', 'Netra'),
('3', '3', 'Rungu'),
('4', '4', 'Grahita Ringan'),
('5', '5', 'Grahita Sedang'),
('6', '6', 'Daksa Ringan'),
('7', '7', 'Daksa Sedang'),
('8', '8', 'Laras'),
('9', '9', 'Wicara'),
('10', '10', 'Tuna Ganda'),
('11', '11', 'Hiper Aktif'),
('12', '12', 'Cerdas Istimewa'),
('13', '13', 'Bakat Istimewa'),
('14', '14', 'Kesulitan Belajar'),
('15', '15', 'Narkoba'),
('16', '16', 'Indigo'),
('17', '17', 'Down Sindrome'),
('18', '18', 'Autis');

-- --------------------------------------------------------

--
-- Table structure for table `m_moda`
--

CREATE TABLE `m_moda` (
  `kd` varchar(50) NOT NULL,
  `no` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_moda`
--

INSERT INTO `m_moda` (`kd`, `no`, `nama`) VALUES
('1', '1', 'Jalan Kaki'),
('2', '2', 'Kendaraan Pribadi'),
('3', '3', 'Kendaraan Umum/Angkot/Pete-Pete'),
('4', '4', 'Jemputan Sekolah'),
('5', '5', 'Kereta Api'),
('6', '6', 'Ojek'),
('7', '7', 'Andong/Bendi/Sado/Dokar/Delman/Beca'),
('8', '8', 'Perahu Penyebrangan/Rakit/Getek'),
('9', '9', 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `m_pekerjaan`
--

CREATE TABLE `m_pekerjaan` (
  `kd` varchar(50) NOT NULL,
  `no` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_pekerjaan`
--

INSERT INTO `m_pekerjaan` (`kd`, `no`, `nama`) VALUES
('1', '1', 'Tidak Bekerja'),
('2', '2', 'Nelayan'),
('3', '3', 'Petani'),
('4', '4', 'Peternak'),
('5', '5', 'PNS/TNI/POLRI'),
('6', '6', 'Karyawan Swasta'),
('7', '7', 'Pedagang Kecil'),
('8', '8', 'Pedagang Besar'),
('9', '9', 'Wiraswasta'),
('10', '10', 'Wirausaha'),
('11', '11', 'Buruh'),
('12', '12', 'Pensiunan'),
('13', '13', 'Lain -lain');

-- --------------------------------------------------------

--
-- Table structure for table `m_pendidikan`
--

CREATE TABLE `m_pendidikan` (
  `kd` varchar(50) NOT NULL,
  `no` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_pendidikan`
--

INSERT INTO `m_pendidikan` (`kd`, `no`, `nama`) VALUES
('1', '1', 'Tidak Sekolah'),
('2', '2', 'Putus SD'),
('3', '3', 'SD Sederajat'),
('4', '4', 'SMP Sederajat'),
('5', '5', 'SMA Sederajat'),
('6', '6', 'D1'),
('7', '7', 'D2'),
('8', '8', 'D3'),
('9', '9', 'D4/S1'),
('10', '10', 'S2'),
('11', '11', 'S3');

-- --------------------------------------------------------

--
-- Table structure for table `m_penghasilan`
--

CREATE TABLE `m_penghasilan` (
  `kd` varchar(50) NOT NULL,
  `no` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_penghasilan`
--

INSERT INTO `m_penghasilan` (`kd`, `no`, `nama`) VALUES
('1', '1', 'Kurang dari 500.000'),
('2', '2', '500.000 - 999.999'),
('3', '3', '1 jt - 1.999.999'),
('4', '4', '2 jt - 4.999.999'),
('5', '5', '5 jt - 20 jt'),
('6', '6', 'Lebih dari 20 jt');

-- --------------------------------------------------------

--
-- Table structure for table `m_tempat_tinggal`
--

CREATE TABLE `m_tempat_tinggal` (
  `kd` varchar(50) NOT NULL,
  `no` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_tempat_tinggal`
--

INSERT INTO `m_tempat_tinggal` (`kd`, `no`, `nama`) VALUES
('1', '1', 'Bersama Orang Tua'),
('2', '2', 'Wali'),
('3', '3', 'Kos'),
('4', '4', 'Asrama'),
('5', '5', 'Panti Asuhan'),
('6', '6', 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `m_tingkat`
--

CREATE TABLE `m_tingkat` (
  `kd` varchar(50) NOT NULL,
  `no` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_tingkat`
--

INSERT INTO `m_tingkat` (`kd`, `no`, `nama`) VALUES
('1', '1', 'Sekolah'),
('2', '2', 'Kecamatan'),
('3', '3', 'Kabupaten'),
('4', '4', 'Provinsi'),
('5', '5', 'Nasional'),
('6', '6', 'Internasional');

-- --------------------------------------------------------

--
-- Table structure for table `nomerku`
--

CREATE TABLE `nomerku` (
  `noid` int(50) NOT NULL,
  `calon_kd` varchar(50) NOT NULL,
  `tapel_kd` varchar(50) NOT NULL,
  `tapel_nama` varchar(100) NOT NULL,
  `calon_nama` varchar(100) NOT NULL,
  `calon_noreg` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL,
  `jalur` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nomerku`
--

INSERT INTO `nomerku` (`noid`, `calon_kd`, `tapel_kd`, `tapel_nama`, `calon_nama`, `calon_noreg`, `postdate`, `jalur`) VALUES
(1, 'beb181ce73025ca46f99e4b2cc59a4df', '6da377428272056993453ac8c275c698', '2019', '', '201900001', '2019-12-27 03:07:14', 'REGULER'),
(2, '331401e97f7216b46770849735360571', '6da377428272056993453ac8c275c698', '2019', '', '201900002', '2019-12-27 03:22:00', 'REGULER');

-- --------------------------------------------------------

--
-- Table structure for table `psb_calon`
--

CREATE TABLE `psb_calon` (
  `kd` varchar(50) NOT NULL,
  `tapel_kd` varchar(50) NOT NULL,
  `tapel_nama` varchar(100) NOT NULL,
  `noreg` varchar(50) NOT NULL,
  `sekolah` varchar(100) NOT NULL,
  `c_jalur` varchar(100) NOT NULL,
  `c_sekolah_asal` varchar(100) NOT NULL,
  `c_nisn` varchar(100) NOT NULL,
  `c_nama` varchar(100) NOT NULL,
  `c_tmp_lahir` varchar(100) NOT NULL,
  `c_tgl_lahir` date NOT NULL,
  `c_kelamin` varchar(1) NOT NULL,
  `c_agama` varchar(100) NOT NULL,
  `c_anak_status` varchar(100) NOT NULL,
  `c_anak_ke` varchar(5) NOT NULL,
  `c_alamat` longtext NOT NULL,
  `c_telp` varchar(100) NOT NULL,
  `c_email` longtext NOT NULL,
  `c_filex` longtext NOT NULL,
  `ortu_ayah_nama` varchar(100) NOT NULL,
  `ortu_ayah_kerja` varchar(100) NOT NULL,
  `ortu_ibu_nama` varchar(100) NOT NULL,
  `ortu_ibu_kerja` varchar(100) NOT NULL,
  `ortu_alamat` longtext NOT NULL,
  `ortu_telp` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL,
  `reg_bayar` varchar(15) NOT NULL,
  `reg_bayar_filex` longtext NOT NULL,
  `reg_bayar_tgl` date NOT NULL,
  `cetak_kartu_tes` enum('true','false') NOT NULL DEFAULT 'false',
  `cetak_kartu_tes_postdate` datetime NOT NULL,
  `nilai` varchar(5) NOT NULL,
  `nilai_postdate` datetime NOT NULL,
  `diterima` enum('true','false') NOT NULL DEFAULT 'false',
  `diterima_postdate` datetime NOT NULL,
  `usernamex` varchar(100) NOT NULL,
  `passwordx` varchar(100) NOT NULL,
  `aktif` enum('true','false') NOT NULL DEFAULT 'false',
  `aktif_postdate` datetime NOT NULL,
  `passwordx2` varchar(100) NOT NULL,
  `last_login` datetime NOT NULL,
  `ruangan_kd` varchar(50) NOT NULL,
  `ruangan_kode` varchar(100) NOT NULL,
  `ruangan_nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `psb_calon`
--

INSERT INTO `psb_calon` (`kd`, `tapel_kd`, `tapel_nama`, `noreg`, `sekolah`, `c_jalur`, `c_sekolah_asal`, `c_nisn`, `c_nama`, `c_tmp_lahir`, `c_tgl_lahir`, `c_kelamin`, `c_agama`, `c_anak_status`, `c_anak_ke`, `c_alamat`, `c_telp`, `c_email`, `c_filex`, `ortu_ayah_nama`, `ortu_ayah_kerja`, `ortu_ibu_nama`, `ortu_ibu_kerja`, `ortu_alamat`, `ortu_telp`, `postdate`, `reg_bayar`, `reg_bayar_filex`, `reg_bayar_tgl`, `cetak_kartu_tes`, `cetak_kartu_tes_postdate`, `nilai`, `nilai_postdate`, `diterima`, `diterima_postdate`, `usernamex`, `passwordx`, `aktif`, `aktif_postdate`, `passwordx2`, `last_login`, `ruangan_kd`, `ruangan_kode`, `ruangan_nama`) VALUES
('beb181ce73025ca46f99e4b2cc59a4df', '6da377428272056993453ac8c275c698', '2019', '201900001', '', 'REGULER', '1', '1', '1', '1', '2019-12-06', 'L', 'Islam', 'Kandung', '1', '1', '1', '1', '', '1', '1', '1', '1', '1', '1', '2019-12-27 03:07:14', '150000', 'beb181ce73025ca46f99e4b2cc59a4df-bayar.jpg', '2019-12-06', 'false', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 'false', '0000-00-00 00:00:00', '201900001', '55249ec37bd524fef76acdaa56f3f022', 'true', '2019-12-27 03:14:16', '727df', '0000-00-00 00:00:00', '3b59a67f96e2e5de6628e6dcb3272a65', '12345', 'ruang A'),
('331401e97f7216b46770849735360571', '6da377428272056993453ac8c275c698', '2019', '201900002', '', 'REGULER', '3', '3', '3', '3', '2019-12-12', 'L', 'Islam', 'Kandung', '3', '3', '3', '3', '', '3', '3', '3', '3', '3', '3', '2019-12-27 03:22:00', '160000', '331401e97f7216b46770849735360571-bayar.jpg', '2019-12-13', 'false', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 'false', '0000-00-00 00:00:00', '201900002', 'efb2f2c3b4eceaed85ec0b733e5d5c6c', 'true', '2019-12-27 03:23:14', '1a021', '2019-12-27 03:24:45', '3b59a67f96e2e5de6628e6dcb3272a65', '12345', 'ruang A');

-- --------------------------------------------------------

--
-- Table structure for table `psb_login_log`
--

CREATE TABLE `psb_login_log` (
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_login` varchar(50) NOT NULL,
  `url_inputan` varchar(255) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `psb_m_mapel`
--

CREATE TABLE `psb_m_mapel` (
  `kd` varchar(50) NOT NULL,
  `sesi` varchar(1) NOT NULL,
  `jam` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psb_m_mapel`
--

INSERT INTO `psb_m_mapel` (`kd`, `sesi`, `jam`, `nama`, `postdate`) VALUES
('124001a79026c6379cfc132f9d1748f7', '1', '07:30 xstrix 09:30', 'mapel 1', '2019-11-15 02:13:32'),
('01f7189a172dc778f864bc31e7ff29de', '2', '07:30 xstrix 09:30', 'mapel 2', '2019-11-15 02:12:00'),
('3294fe76f09f5d86b27e606eeab70273', '1', '07:30 xstrix 09:30', 'mapel 1', '2019-11-15 02:12:12'),
('1684c35eac7ff5be4488090dd504ecea', '2', '09.30 xstrix 11.00', 'mapel 2', '2019-11-15 02:12:36');

-- --------------------------------------------------------

--
-- Table structure for table `psb_m_ruangan`
--

CREATE TABLE `psb_m_ruangan` (
  `kd` varchar(50) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psb_m_ruangan`
--

INSERT INTO `psb_m_ruangan` (`kd`, `kode`, `nama`, `postdate`) VALUES
('3b59a67f96e2e5de6628e6dcb3272a65', '12345', 'ruang A', '2019-11-15 02:19:29'),
('e09db5e9cda313b2faf34ba0bff1d792', 'a11111', 'ruang B', '2019-11-15 02:19:49'),
('fc41c2f7143ed1059a31b0715d3ec814', 'a4444', 'ruang C', '2019-11-15 02:19:59');

-- --------------------------------------------------------

--
-- Table structure for table `psb_m_tapel`
--

CREATE TABLE `psb_m_tapel` (
  `kd` varchar(50) NOT NULL,
  `tahun1` varchar(4) NOT NULL,
  `tahun2` varchar(4) NOT NULL,
  `status` enum('true','false') NOT NULL DEFAULT 'false',
  `postdate` datetime NOT NULL,
  `dayatampung` varchar(10) NOT NULL,
  `jml_reg` varchar(10) NOT NULL,
  `jml_diterima` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psb_m_tapel`
--

INSERT INTO `psb_m_tapel` (`kd`, `tahun1`, `tahun2`, `status`, `postdate`, `dayatampung`, `jml_reg`, `jml_diterima`) VALUES
('6da377428272056993453ac8c275c698', '2019', '2020', 'true', '2019-12-27 03:45:47', '1000', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `kd` varchar(50) NOT NULL,
  `nisn` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelamin` varchar(1) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `tmp_lahir` varchar(100) NOT NULL,
  `tgl_lahir` varchar(100) NOT NULL,
  `noreg_akta_lahir` varchar(100) NOT NULL,
  `agama` varchar(100) NOT NULL,
  `warga` varchar(100) NOT NULL,
  `kebutuhan_khusus` varchar(100) NOT NULL,
  `alamat_jalan` varchar(100) NOT NULL,
  `rt` varchar(10) NOT NULL,
  `rw` varchar(10) NOT NULL,
  `dusun` varchar(100) NOT NULL,
  `kelurahan` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kabupaten` varchar(100) NOT NULL,
  `kodepos` varchar(5) NOT NULL,
  `lintang` varchar(100) NOT NULL,
  `bujur` varchar(100) NOT NULL,
  `tempat_tinggal` varchar(100) NOT NULL,
  `moda_transportasi` varchar(100) NOT NULL,
  `nomor_kks` varchar(100) NOT NULL,
  `anak_ke` varchar(100) NOT NULL,
  `penerima_kps_pkh` varchar(100) NOT NULL,
  `nomor_kps_pkh` varchar(100) NOT NULL,
  `usulan_dari_sekolah` varchar(100) NOT NULL,
  `penerima_kip` varchar(100) NOT NULL,
  `nomor_kip` varchar(100) NOT NULL,
  `nama_kip` varchar(100) NOT NULL,
  `terima_kip` varchar(100) NOT NULL,
  `alasan_pip` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `bank_norek` varchar(100) NOT NULL,
  `bank_an` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL,
  `telp` varchar(100) NOT NULL,
  `hp` varchar(100) NOT NULL,
  `email` longtext NOT NULL,
  `berkas_ijazah` varchar(100) NOT NULL,
  `berkas_skhun` varchar(100) NOT NULL,
  `keluar_karena` varchar(100) NOT NULL,
  `keluar_tgl` varchar(100) NOT NULL,
  `keluar_alasan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`kd`, `nisn`, `nama`, `kelamin`, `nik`, `tmp_lahir`, `tgl_lahir`, `noreg_akta_lahir`, `agama`, `warga`, `kebutuhan_khusus`, `alamat_jalan`, `rt`, `rw`, `dusun`, `kelurahan`, `kecamatan`, `kabupaten`, `kodepos`, `lintang`, `bujur`, `tempat_tinggal`, `moda_transportasi`, `nomor_kks`, `anak_ke`, `penerima_kps_pkh`, `nomor_kps_pkh`, `usulan_dari_sekolah`, `penerima_kip`, `nomor_kip`, `nama_kip`, `terima_kip`, `alasan_pip`, `bank`, `bank_norek`, `bank_an`, `postdate`, `telp`, `hp`, `email`, `berkas_ijazah`, `berkas_skhun`, `keluar_karena`, `keluar_tgl`, `keluar_alasan`) VALUES
('d950a2cfac6ea8e59f5359949211e54e', 'u', 'u', 'L', '1', 'u', '2019xstrix11xstrix05', '2', 'Islam', '3', 'Bakat Istimewa', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', 'Kos', 'Jemputan Sekolah', '15', '1', 'Ya', '17', 'Ya', 'Ya', '19', '20', 'Tidak', 'Daerah Konflik', '21', '22', '23', '2019-11-23 17:34:27', '123', '234', '345', 'a123', 'bbb', 'Dikeluarkan', '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_ayah`
--

CREATE TABLE `siswa_ayah` (
  `kd` varchar(50) NOT NULL,
  `siswa_kd` varchar(50) NOT NULL,
  `siswa_nisn` varchar(100) NOT NULL,
  `siswa_nama` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `tahun_lahir` varchar(4) NOT NULL,
  `pendidikan` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `penghasilan_bulanan` varchar(100) NOT NULL,
  `kebutuhan_khusus` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa_ayah`
--

INSERT INTO `siswa_ayah` (`kd`, `siswa_kd`, `siswa_nisn`, `siswa_nama`, `nama`, `nik`, `tahun_lahir`, `pendidikan`, `pekerjaan`, `penghasilan_bulanan`, `kebutuhan_khusus`, `postdate`) VALUES
('2185c56a60a239b2072a873e12e04286', 'd950a2cfac6ea8e59f5359949211e54e', '', '', 'u', '1', '2019', 'u', 'u', 'Indigo', 'Hiper Aktif', '2019-11-23 17:34:43');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_beasiswa`
--

CREATE TABLE `siswa_beasiswa` (
  `kd` varchar(50) NOT NULL,
  `siswa_kd` varchar(50) NOT NULL,
  `siswa_nisn` varchar(100) NOT NULL,
  `siswa_nama` varchar(100) NOT NULL,
  `no` varchar(5) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `mulai` varchar(100) NOT NULL,
  `selesai` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa_beasiswa`
--

INSERT INTO `siswa_beasiswa` (`kd`, `siswa_kd`, `siswa_nisn`, `siswa_nama`, `no`, `jenis`, `ket`, `mulai`, `selesai`, `postdate`) VALUES
('5c22ab7bbc620ca7b2b154d907aac122', 'd950a2cfac6ea8e59f5359949211e54e', '', '', '3', 'Unggulan', 'g', 'h', 'i', '2019-11-23 18:08:55'),
('a1305f7769d890b657e8db7eb6866952', 'd950a2cfac6ea8e59f5359949211e54e', '', '', '2', 'Anak Berprestasi', 'd', 'e', 'f', '2019-11-23 18:08:55'),
('9962b3de6897411eac5542ccc6bbd73f', 'd950a2cfac6ea8e59f5359949211e54e', '', '', '1', 'Pendidikan', 'a', 'b', 'c', '2019-11-23 18:08:55');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_ibu`
--

CREATE TABLE `siswa_ibu` (
  `kd` varchar(50) NOT NULL,
  `siswa_kd` varchar(50) NOT NULL,
  `siswa_nisn` varchar(100) NOT NULL,
  `siswa_nama` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `tahun_lahir` varchar(4) NOT NULL,
  `pendidikan` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `penghasilan_bulanan` varchar(100) NOT NULL,
  `kebutuhan_khusus` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa_ibu`
--

INSERT INTO `siswa_ibu` (`kd`, `siswa_kd`, `siswa_nisn`, `siswa_nama`, `nama`, `nik`, `tahun_lahir`, `pendidikan`, `pekerjaan`, `penghasilan_bulanan`, `kebutuhan_khusus`, `postdate`) VALUES
('145bcd051d001111ec86a04c020de7fc', 'd950a2cfac6ea8e59f5359949211e54e', '', '', 'u', '1', '2', 'D4xgmringxS1', 'Karyawan Swasta', '1 jt xstrix 1.999.999', 'Daksa Ringan', '2019-11-23 17:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_ppdb`
--

CREATE TABLE `siswa_ppdb` (
  `kd` varchar(50) NOT NULL,
  `siswa_kd` varchar(50) NOT NULL,
  `siswa_nisn` varchar(100) NOT NULL,
  `siswa_nama` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `nis` varchar(100) NOT NULL,
  `tgl_masuk` varchar(100) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `no_ujian` varchar(100) NOT NULL,
  `no_ijazah` varchar(100) NOT NULL,
  `no_skhu` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `siswa_prestasi`
--

CREATE TABLE `siswa_prestasi` (
  `kd` varchar(50) NOT NULL,
  `siswa_kd` varchar(50) NOT NULL,
  `siswa_nisn` varchar(100) NOT NULL,
  `siswa_nama` varchar(100) NOT NULL,
  `no` varchar(5) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `tingkat` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tahun` varchar(100) NOT NULL,
  `penyelenggara` varchar(100) NOT NULL,
  `peringkat` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa_prestasi`
--

INSERT INTO `siswa_prestasi` (`kd`, `siswa_kd`, `siswa_nisn`, `siswa_nama`, `no`, `jenis`, `tingkat`, `nama`, `tahun`, `penyelenggara`, `peringkat`, `postdate`) VALUES
('31eee76659b076f51e4c1377c43de7da', 'd950a2cfac6ea8e59f5359949211e54e', '', '', '3', 'Olah Raga', 'Kabupaten', '4', '5', '6', '4', '2019-11-23 18:01:57'),
('840ad6c674ade5050d0e0d00cac72084', 'd950a2cfac6ea8e59f5359949211e54e', '', '', '2', 'Seni', 'Provinsi', '2', '3', '4', '3', '2019-11-23 18:01:57'),
('022230315e77d67db56237d4075d8b0c', 'd950a2cfac6ea8e59f5359949211e54e', '', '', '1', 'Sains', 'Sekolah', '1', '2', '3', '1', '2019-11-23 18:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_priodik`
--

CREATE TABLE `siswa_priodik` (
  `kd` varchar(50) NOT NULL,
  `siswa_kd` varchar(50) NOT NULL,
  `siswa_nisn` varchar(100) NOT NULL,
  `siswa_nama` varchar(100) NOT NULL,
  `tb` varchar(100) NOT NULL,
  `bb` varchar(100) NOT NULL,
  `jarak` varchar(100) NOT NULL,
  `jarak2` varchar(100) NOT NULL,
  `waktu_jam` varchar(100) NOT NULL,
  `waktu_menit` varchar(100) NOT NULL,
  `jml_saudara` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa_priodik`
--

INSERT INTO `siswa_priodik` (`kd`, `siswa_kd`, `siswa_nisn`, `siswa_nama`, `tb`, `bb`, `jarak`, `jarak2`, `waktu_jam`, `waktu_menit`, `jml_saudara`, `postdate`) VALUES
('831ac4c316ba6e9cb39151435d730c73', 'd950a2cfac6ea8e59f5359949211e54e', '', '', '1', '2', 'Lebih dari 1 Km', '3', '4', '5', '6', '2019-11-23 17:51:02');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_wali`
--

CREATE TABLE `siswa_wali` (
  `kd` varchar(50) NOT NULL,
  `siswa_kd` varchar(50) NOT NULL,
  `siswa_nisn` varchar(100) NOT NULL,
  `siswa_nama` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `tahun_lahir` varchar(4) NOT NULL,
  `pendidikan` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `penghasilan_bulanan` varchar(100) NOT NULL,
  `kebutuhan_khusus` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa_wali`
--

INSERT INTO `siswa_wali` (`kd`, `siswa_kd`, `siswa_nisn`, `siswa_nama`, `nama`, `nik`, `tahun_lahir`, `pendidikan`, `pekerjaan`, `penghasilan_bulanan`, `kebutuhan_khusus`, `postdate`) VALUES
('74c5749571621a74410f89586026702c', 'd950a2cfac6ea8e59f5359949211e54e', '', '', '1', '2', '3', 'Tidak Sekolah', 'Nelayan', '1 jt xstrix 1.999.999', 'Daksa Sedang', '2019-11-23 17:43:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cp_g_foto`
--
ALTER TABLE `cp_g_foto`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `cp_g_video`
--
ALTER TABLE `cp_g_video`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `cp_m_slideshow`
--
ALTER TABLE `cp_m_slideshow`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `cp_profil`
--
ALTER TABLE `cp_profil`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `cp_visitor`
--
ALTER TABLE `cp_visitor`
  ADD PRIMARY KEY (`kd`),
  ADD KEY `kd` (`kd`);

--
-- Indexes for table `m_agama`
--
ALTER TABLE `m_agama`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `m_alasan_pip`
--
ALTER TABLE `m_alasan_pip`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `m_jenis`
--
ALTER TABLE `m_jenis`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `m_jenis2`
--
ALTER TABLE `m_jenis2`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `m_karena`
--
ALTER TABLE `m_karena`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `m_kebutuhan`
--
ALTER TABLE `m_kebutuhan`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `m_moda`
--
ALTER TABLE `m_moda`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `m_pekerjaan`
--
ALTER TABLE `m_pekerjaan`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `m_pendidikan`
--
ALTER TABLE `m_pendidikan`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `m_penghasilan`
--
ALTER TABLE `m_penghasilan`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `m_tempat_tinggal`
--
ALTER TABLE `m_tempat_tinggal`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `m_tingkat`
--
ALTER TABLE `m_tingkat`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `nomerku`
--
ALTER TABLE `nomerku`
  ADD PRIMARY KEY (`calon_kd`),
  ADD UNIQUE KEY `noid` (`noid`);

--
-- Indexes for table `psb_calon`
--
ALTER TABLE `psb_calon`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `psb_m_mapel`
--
ALTER TABLE `psb_m_mapel`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `psb_m_ruangan`
--
ALTER TABLE `psb_m_ruangan`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `psb_m_tapel`
--
ALTER TABLE `psb_m_tapel`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `siswa_ayah`
--
ALTER TABLE `siswa_ayah`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `siswa_beasiswa`
--
ALTER TABLE `siswa_beasiswa`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `siswa_ibu`
--
ALTER TABLE `siswa_ibu`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `siswa_ppdb`
--
ALTER TABLE `siswa_ppdb`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `siswa_prestasi`
--
ALTER TABLE `siswa_prestasi`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `siswa_priodik`
--
ALTER TABLE `siswa_priodik`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `siswa_wali`
--
ALTER TABLE `siswa_wali`
  ADD PRIMARY KEY (`kd`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nomerku`
--
ALTER TABLE `nomerku`
  MODIFY `noid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
