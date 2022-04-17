-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 16 May 2017, 10:21:12
-- Sunucu sürümü: 10.1.21-MariaDB
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ziyaretci_defteri`
--
CREATE DATABASE IF NOT EXISTS `ziyaretci_defteri` DEFAULT CHARACTER SET utf8 COLLATE utf8_turkish_ci;
USE `ziyaretci_defteri`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kayitlikullanicilar`
--

CREATE TABLE `kayitlikullanicilar` (
  `kayitli_tc` bigint(11) NOT NULL,
  `kayitli_adi` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `kayitli_soyadi` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `kayitli_mail` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `kayitli_cinsiyet` enum('Erkek','Kadın') CHARACTER SET utf16 COLLATE utf16_turkish_ci NOT NULL,
  `kayitli_tarih` datetime NOT NULL,
  `kayitli_kadi` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `kayitli_sifre` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `kayitli_gizlisoru` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kayitli_gizlisorucevap` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `yetki` enum('admin','kullanıcı') COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `kullanici_id` int(10) NOT NULL,
  `kullanici_adi` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_soyadi` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_email` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `yorum_id` int(10) NOT NULL,
  `yorum_tarih` datetime NOT NULL,
  `kullanici_id` bigint(11) NOT NULL,
  `yorum` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `onay` enum('onaylı','onaysız') COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=COMPACT;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kayitlikullanicilar`
--
ALTER TABLE `kayitlikullanicilar`
  ADD PRIMARY KEY (`kayitli_tc`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`kullanici_id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`yorum_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `kullanici_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `yorum_id` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
