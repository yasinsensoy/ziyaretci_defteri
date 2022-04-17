<?php 
	$vt_sunucu = "localhost";
	$vt_kadi = "root";
	$vt_sifre = "";
	$vt_adi = "ziyaretci_defteri";
	@$baglanti = mysql_connect($vt_sunucu,$vt_kadi,$vt_sifre) 
	or die("Veritabanına bağlanılamadı. Hata: ".mysql_error());
	@mysql_select_db($vt_adi) or die("Veritabanı seçilemedi. Hata: ".mysql_error());
	mysql_query("SET NAMES UTF8");
?>