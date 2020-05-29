-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2020 at 09:34 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE `anketa` (
  `id` int(11) NOT NULL,
  `pitanje` varchar(40) NOT NULL,
  `aktivna` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `autori`
--

CREATE TABLE `autori` (
  `id` int(11) NOT NULL,
  `kor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `autori`
--

INSERT INTO `autori` (`id`, `kor_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id`, `naziv`) VALUES
(1, 'Sport'),
(2, 'Zabava'),
(3, 'Sci&IT'),
(4, 'Svet'),
(5, 'Kultura');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `id` int(11) NOT NULL,
  `vest_id` int(11) NOT NULL,
  `tekst` varchar(255) NOT NULL,
  `kor_id` int(11) NOT NULL,
  `roditelj_id` int(11) DEFAULT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `vest_id`, `tekst`, `kor_id`, `roditelj_id`, `datum`) VALUES
(2, 1, 'Samo 400 milina$?', 1, NULL, '2020-05-21 14:32:20'),
(3, 1, 'Ovo je treci komentar za ovu vest!', 1, NULL, '2020-05-21 15:14:15'),
(4, 1, 'Ovo je cetvrit komenta', 1, NULL, '2020-05-21 15:17:09'),
(5, 1, 'Ovo je peti komentar', 1, NULL, '2020-05-21 15:21:25'),
(11, 1, 'Ovaj i jos jedan', 1, NULL, '2020-05-21 15:33:00'),
(12, 1, 'Ovo bi trebalo da je poslendji za sada', 1, NULL, '2020-05-21 15:33:16'),
(15, 1, 'Ovo je odgovor na to pitanje jer je 400$ mnogo', 1, 2, '2020-05-24 16:51:21'),
(18, 1, 'Jos jedan sto da ne', 1, NULL, '2020-05-24 17:32:41'),
(19, 1, 'Cek bre', 1, NULL, '2020-05-24 17:34:57'),
(25, 1, 'Sada nece da spusti', 1, NULL, '2020-05-24 20:33:21'),
(26, 1, 'Ovo je odgovro na taj treci komentar', 1, 3, '2020-05-24 20:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `ime` varchar(30) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `mail` varchar(90) NOT NULL,
  `username` varchar(30) NOT NULL,
  `sifra` varchar(255) NOT NULL,
  `verifikacija_kod` varchar(80) NOT NULL,
  `verifikacija` bit(1) NOT NULL DEFAULT b'0',
  `datum_registracije` timestamp NOT NULL DEFAULT current_timestamp(),
  `uloga_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `ime`, `prezime`, `mail`, `username`, `sifra`, `verifikacija_kod`, `verifikacija`, `datum_registracije`, `uloga_id`) VALUES
(1, 'Djordje', 'Antanaskovic', 'djolo123@gmail.com', 'djolo', 'sifra123', 'kodic', b'1', '2020-05-17 18:40:08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik_odgovor`
--

CREATE TABLE `korisnik_odgovor` (
  `id` int(11) NOT NULL,
  `kor_id` int(11) NOT NULL,
  `odg_id` int(11) NOT NULL,
  `datum_odg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `navigacija`
--

CREATE TABLE `navigacija` (
  `id` int(11) NOT NULL,
  `link` varchar(40) NOT NULL,
  `naziv` varchar(30) NOT NULL,
  `prioritet` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `navigacija`
--

INSERT INTO `navigacija` (`id`, `link`, `naziv`, `prioritet`) VALUES
(1, 'index.php', 'Naslovna', 1),
(2, 'index.php?page=news', 'Vesti', 2),
(3, 'index.php?page=signIn', 'Prijava', 3),
(4, 'index.php?page=register', 'Registracija', 4);

-- --------------------------------------------------------

--
-- Table structure for table `odgovori`
--

CREATE TABLE `odgovori` (
  `id` int(11) NOT NULL,
  `anketa_id` int(11) NOT NULL,
  `tekst` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `id` int(11) NOT NULL,
  `src` varchar(40) NOT NULL,
  `alt` varchar(40) NOT NULL,
  `tip_id` int(11) NOT NULL,
  `vest_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slike`
--

INSERT INTO `slike` (`id`, `src`, `alt`, `tip_id`, `vest_id`) VALUES
(1, 'vestSlika2.jpg', 'Naslovna slika za vest', 1, 1),
(2, 'vestSlikathumbnail.jpg', 'Slicica za vest', 2, 1),
(3, 'olimpijada.jpg', 'olimpijada', 1, 2),
(4, 'olimpijadathumbnail.jpg', 'olimpijadathumbnail', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tagovi`
--

CREATE TABLE `tagovi` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tagovi`
--

INSERT INTO `tagovi` (`id`, `naziv`) VALUES
(1, 'Facebook'),
(2, 'Giphy'),
(6, 'Korona'),
(4, 'olimpijada'),
(3, 'pera'),
(5, 'Tokio');

-- --------------------------------------------------------

--
-- Table structure for table `tag_vest`
--

CREATE TABLE `tag_vest` (
  `id` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL,
  `id_vest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tag_vest`
--

INSERT INTO `tag_vest` (`id`, `id_tag`, `id_vest`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(5, 4, 2),
(6, 5, 2),
(4, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tip_slike`
--

CREATE TABLE `tip_slike` (
  `id` int(11) NOT NULL,
  `naziv` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tip_slike`
--

INSERT INTO `tip_slike` (`id`, `naziv`) VALUES
(1, 'cover'),
(2, 'thumbnail');

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

CREATE TABLE `uloge` (
  `id` int(11) NOT NULL,
  `naziv` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uloge`
--

INSERT INTO `uloge` (`id`, `naziv`) VALUES
(1, 'admin'),
(2, 'autor'),
(3, 'korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `vesti`
--

CREATE TABLE `vesti` (
  `id` int(11) NOT NULL,
  `naslov` varchar(60) NOT NULL,
  `tekst` text NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `kat_id` int(11) NOT NULL,
  `autor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vesti`
--

INSERT INTO `vesti` (`id`, `naslov`, `tekst`, `datum`, `kat_id`, `autor_id`) VALUES
(1, 'Facebook kupio GIPHY!', 'Facebook je objavio da kupuje GIPHY, popularnu onlajn platformu za kreiranje i postavljanje animiranih GIF-ova i kratkih videa. Društvena mreža nije objavila vrednost ove kupovine, ali pojedini izvori tvrde da je akvizicija obavljena za 400 miliona dolara.\r\n\r\nKupovina će omogućiti da GIPHY postane deo Facebookovog Instagram tima, koji je zaslužan za velkiki deo prometa GIPHY servisa. Servis za hostovanje GIF-ova koriste mnoge onlajn platforme, koje korisnicima omogućavaju da ostavljaju brze reakcije na sadržaj. Facebook ističe da polovina protoka na GIPHY ionako već stiže sa kompanijinih servisa, uključujući WhatsApp, Facebook Messenger i Instagram.', '2020-05-17 18:44:27', 3, 1),
(2, 'Olimpijske igre odložene prvi put u istoriji!', 'Olimpijske igre u Tokiju biće održane 2021. godine, a ne ove, pošto je premijer Japana Šinzo Abe postigao dogovor sa prvim čovekom Međunarodnog olimpijskog komiteta Tomasom Bahom o njihovom odlaganju zbog pandemije koronavirusa u svetu.\r\nU saopštenju koje je objavila Vlada Japana navodi se da će prvi put u istoriji Olimpijske igre biti odložene, a da postoji mogućnost da one čak budu održane tokom proleća naredne godine. Svakako će one biti održane najkasnije u leto 2021. godine, objavio je MOK.\r\nPostojala je opcija da Igre budu odložene za oktobar, ali pošto se ne zna kada će se širenje koronavirusa smiriti, najbezbednije je bilo da se one pomere za narednu godinu, uz nadu da će situacija biti bolja.\r\nTo je prvo otkazivanje Olimpijskih igara u vreme mira. Prethodno, Olimpijske igre nisu održane 1940. i 1944. godine zbog Drugog svetskog rata.', '2020-05-25 14:31:18', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anketa`
--
ALTER TABLE `anketa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autori`
--
ALTER TABLE `autori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kor_id` (`kor_id`);

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kor_id` (`kor_id`),
  ADD KEY `vest_id` (`vest_id`),
  ADD KEY `roditelj_id` (`roditelj_id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `uloga_id` (`uloga_id`);

--
-- Indexes for table `korisnik_odgovor`
--
ALTER TABLE `korisnik_odgovor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kor_id` (`kor_id`,`odg_id`),
  ADD KEY `odg_id` (`odg_id`);

--
-- Indexes for table `navigacija`
--
ALTER TABLE `navigacija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `odgovori`
--
ALTER TABLE `odgovori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anketa_id` (`anketa_id`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tip_id` (`tip_id`),
  ADD KEY `vest_id` (`vest_id`);

--
-- Indexes for table `tagovi`
--
ALTER TABLE `tagovi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- Indexes for table `tag_vest`
--
ALTER TABLE `tag_vest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tag` (`id_tag`,`id_vest`),
  ADD KEY `id_vest` (`id_vest`);

--
-- Indexes for table `tip_slike`
--
ALTER TABLE `tip_slike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uloge`
--
ALTER TABLE `uloge`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- Indexes for table `vesti`
--
ALTER TABLE `vesti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autor_id` (`autor_id`),
  ADD KEY `kat_id` (`kat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anketa`
--
ALTER TABLE `anketa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `autori`
--
ALTER TABLE `autori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `korisnik_odgovor`
--
ALTER TABLE `korisnik_odgovor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `navigacija`
--
ALTER TABLE `navigacija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `odgovori`
--
ALTER TABLE `odgovori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slike`
--
ALTER TABLE `slike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tagovi`
--
ALTER TABLE `tagovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tag_vest`
--
ALTER TABLE `tag_vest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tip_slike`
--
ALTER TABLE `tip_slike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `uloge`
--
ALTER TABLE `uloge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vesti`
--
ALTER TABLE `vesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `autori`
--
ALTER TABLE `autori`
  ADD CONSTRAINT `autori_ibfk_1` FOREIGN KEY (`kor_id`) REFERENCES `korisnici` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `komentari_ibfk_1` FOREIGN KEY (`vest_id`) REFERENCES `vesti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentari_ibfk_2` FOREIGN KEY (`kor_id`) REFERENCES `korisnici` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentari_ibfk_3` FOREIGN KEY (`roditelj_id`) REFERENCES `komentari` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD CONSTRAINT `korisnici_ibfk_1` FOREIGN KEY (`uloga_id`) REFERENCES `uloge` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `korisnik_odgovor`
--
ALTER TABLE `korisnik_odgovor`
  ADD CONSTRAINT `korisnik_odgovor_ibfk_1` FOREIGN KEY (`odg_id`) REFERENCES `odgovori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `korisnik_odgovor_ibfk_2` FOREIGN KEY (`kor_id`) REFERENCES `korisnici` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `odgovori`
--
ALTER TABLE `odgovori`
  ADD CONSTRAINT `odgovori_ibfk_1` FOREIGN KEY (`anketa_id`) REFERENCES `anketa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `slike`
--
ALTER TABLE `slike`
  ADD CONSTRAINT `slike_ibfk_1` FOREIGN KEY (`tip_id`) REFERENCES `tip_slike` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `slike_ibfk_2` FOREIGN KEY (`vest_id`) REFERENCES `vesti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tag_vest`
--
ALTER TABLE `tag_vest`
  ADD CONSTRAINT `tag_vest_ibfk_1` FOREIGN KEY (`id_vest`) REFERENCES `vesti` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tag_vest_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tagovi` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `vesti`
--
ALTER TABLE `vesti`
  ADD CONSTRAINT `vesti_ibfk_1` FOREIGN KEY (`autor_id`) REFERENCES `autori` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `vesti_ibfk_2` FOREIGN KEY (`kat_id`) REFERENCES `kategorije` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
