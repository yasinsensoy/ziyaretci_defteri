<?php
	 session_start();
	 @$kontrol = $_SESSION["kontrol"];
	 if($kontrol != "admin")
	 {
		 header("Location:giris.php");
	 }
	 else
	 {	 
		include "veritabani.php";
		@$tur = $_GET["tur"];
		@$id = $_GET["id"];
		if($tur == "onay")
		{
				$sorgu = "UPDATE yorumlar SET onay = 'onaylı' WHERE yorum_id = $id";
				mysql_query($sorgu);
		}
		else if($tur == "red")
		{
				$sorgu = "UPDATE yorumlar SET onay = 'onaysız' WHERE yorum_id = $id";
				mysql_query($sorgu);
		}
		else if($tur == "sil")
		{
				$sorgu = "DELETE FROM yorumlar WHERE yorum_id = $id";
				mysql_query($sorgu);
		}	
?>
<table align="center" border="1" width="300" cellspacing="0">
	<tbody>
	<?php
			$sorgu1 = "SELECT k.kullanici_adi,k.kullanici_soyadi,y.yorum,y.yorum_tarih,y.yorum_id,y.onay FROM yorumlar AS y 
			INNER JOIN kullanicilar AS k ON y.kullanici_id = k.kullanici_id";
			$sorgu2 = "SELECT k.kayitli_adi,k.kayitli_soyadi,y.yorum,y.yorum_tarih,y.yorum_id,y.onay FROM yorumlar AS y 
			INNER JOIN kayitlikullanicilar AS k ON y.kullanici_id = k.kayitli_tc";
			$sql1 = mysql_query($sorgu1);
			$sql2 = mysql_query($sorgu2);
			while($satir = mysql_fetch_row($sql1))
			{
				$durum;
				if($satir[5] == 'onaylı') 
					$durum = "<font color='green'>Mesaj Onaylanmıştır.</font>"; 
				else
					$durum = "<font color='red'>Mesaj Onaylanmamıştır.</font>"; 
				echo "<tr>
						<td colspan='2' bgcolor='#00ffff'>$satir[0] $satir[1]</td>
						<td bgcolor='#00ffff'>$satir[3]</td>
					  </tr>
					  <tr>
						<td colspan='3' bgcolor='#cccccc'>$satir[2]</td>
					  </tr>
					  <tr>
						<td colspan='3' align='center' bgcolor='#00ffff'>$durum</td>
					  </tr>
					  <tr>
						<td colspan='3' bgcolor='#cccccc'>
							<a href='onay.php?tur=onay&id=$satir[4]'>Onayla</a>&nbsp;&nbsp;
					  		<a href='onay.php?tur=red&id=$satir[4]'>Reddet</a>&nbsp;&nbsp;
							<a href='onay.php?tur=sil&id=$satir[4]'>Sil</a>
						</td>
					  </tr>";
			}
			while($satir = mysql_fetch_row($sql2))
			{
				$durum;
				if($satir[5] == 'onaylı') 
					$durum = "<font color='green'>Mesaj Onaylanmıştır.</font>"; 
				else
					$durum = "<font color='red'>Mesaj Onaylanmamıştır.</font>"; 
				echo "<tr>
						<td colspan='2' bgcolor='#00ffff'>$satir[0] $satir[1]</td>
						<td bgcolor='#00ffff'>$satir[3]</td>
					  </tr>
					  <tr>
						<td colspan='3' bgcolor='#cccccc'>$satir[2]</td>
					  </tr>
					  <tr>
						<td colspan='3' align='center' bgcolor='#00ffff'>$durum</td>
					  </tr>
					  <tr>
						<td colspan='3' bgcolor='#cccccc'>
							<a href='onay.php?tur=onay&id=$satir[4]'>Onayla</a>&nbsp;&nbsp;
					  		<a href='onay.php?tur=red&id=$satir[4]'>Reddet</a>&nbsp;&nbsp;
							<a href='onay.php?tur=sil&id=$satir[4]'>Sil</a>
						</td>
					  </tr>";
			}
	 }
	 
		?>
	</tbody>
</table>
<a href="index.php">Ana Sayfa</a><br>
<a href="cikis.php">Çıkış Yap</a><br>