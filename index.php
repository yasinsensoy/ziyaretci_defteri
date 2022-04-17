    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Ana Sayfa</title>
</head>
<?php
	include "veritabani.php";
	session_start();
	@$kontrol = $_SESSION["kontrol"];
	$hata = "";
	$gizle = "text";
	if(isset($_SESSION["girisyapildi"]))
	{
		$gizle = "hidden";
	}
	if(isset($_POST["gonder"]))
	{	
		$kadi = $_POST['kadi'];
		$ksoyadi = $_POST['ksoyadi'];
		$email = $_POST['email'];
		$yorum = $_POST["mesaj"];
		$tarih = date("Y-m-d H:i:s");		
		if(isset($_SESSION["girisyapildi"]))
		{
			$id = $_SESSION["id"];
			$onay = "onaysız";
			if($kontrol == "admin")
			{
				$onay = "onaylı";
			}
			$sorgu1 = "INSERT INTO yorumlar(yorum_tarih,kullanici_id,yorum,onay) VALUES('$tarih','$id','$yorum','$onay')";
			mysql_query($sorgu1);
			$hata = "<font color='green'>Mesajınız gönderilmiştir.</font>";
		}
		else
		{
			if($kadi != "" && $ksoyadi != "" && $email != "")
			{
				$sorgu2 = "SELECT kullanici_id FROM kullanicilar WHERE kullanici_email = '$email'";
				$sql = mysql_query($sorgu2);
				if(mysql_num_rows($sql) > 0)
				{
					$satir = mysql_fetch_row($sql);
					$sorgu1 = "INSERT INTO yorumlar(yorum_tarih,kullanici_id,yorum,onay) VALUES('$tarih','$satir[0]','$yorum','onaysız')";
					mysql_query($sorgu1);
					$hata = "<font color='green'>Mesajınız gönderilmiştir.</font>";
				}
				else
				{
					$sorgu3 = "INSERT INTO kullanicilar(kullanici_adi,kullanici_soyadi,kullanici_email) 
							VALUES('$kadi','$ksoyadi','$email')";
					mysql_query($sorgu3) or die(mysql_error());
					$sorgu4 = "SELECT kullanici_id FROM kullanicilar WHERE kullanici_email = '$email'";
					$sql = mysql_query($sorgu4);
					@$satir = mysql_fetch_row($sql);
					$sorgu1 = "INSERT INTO yorumlar(yorum_tarih,kullanici_id,yorum,onay) VALUES('$tarih','$satir[0]','$yorum','onaysız')";
					mysql_query($sorgu1);
					$hata = "<font color='green'>Mesajınız gönderilmiştir.</font>";
				}
			}	
			else
			{
				$hata = "<font color='red'>Adı, soyadı ve e-mail boş bırakılamaz.</font>";
			}
		}		 
	}
?>
<table align="center" border="1" width="300" cellspacing="0">
	<tbody>
		<?php			
			$sorgu1 = "SELECT k.kullanici_adi,k.kullanici_soyadi,y.yorum,y.yorum_tarih FROM yorumlar AS y 
			INNER JOIN kullanicilar AS k ON y.kullanici_id = k.kullanici_id WHERE onay = 'onaylı'";
			$sorgu2 = "SELECT k.kayitli_adi,k.kayitli_soyadi,y.yorum,y.yorum_tarih FROM yorumlar AS y 
			INNER JOIN kayitlikullanicilar AS k ON y.kullanici_id = k.kayitli_tc WHERE onay = 'onaylı'";
			$sql1 = mysql_query($sorgu1);
			$sql2 = mysql_query($sorgu2);
			while(@$satir = mysql_fetch_row($sql1))
			{
				echo "<tr><td bgcolor='#00ffff'>$satir[0] $satir[1]</td><td bgcolor='#00ffff'>$satir[3]</td></tr>
				<tr><td colspan='2' bgcolor='#cccccc'>$satir[2]</td></tr>";
			}
			while(@$satir = mysql_fetch_row($sql2))
			{
				echo "<tr><td bgcolor='#00ffff'>$satir[0] $satir[1]</td><td bgcolor='#00ffff'>$satir[3]</td></tr>
				<tr><td colspan='2' bgcolor='#cccccc'>$satir[2]</td></tr>";
			}
		?>
	</tbody>
</table>
<form action="index.php" method="POST">
	<table align="center" border="0" width="300">
		<tbody>
			<tr>
				<td colspan="2"><?php echo $hata; ?></td>
			</tr>
			<tr>
				<td width="150">Kullanıcı adı:</td>
				<td width="150"><input type="<?php echo $gizle; ?>" size="16" name="kadi" /></td>
			</tr>
			<tr>
				<td>Kullanıcı soyadı:</td>
				<td><input type="<?php echo $gizle; ?>" size="16" name="ksoyadi" /></td>		
			</tr>
			<tr>
				<td>E-mail:</td>
				<td><input type="<?php echo $gizle; ?>" size="16" name="email" /></td>		
			</tr>
			<tr>
				<td colspan="2"><textarea maxlength="150" cols="40" rows="10" name="mesaj"></textarea></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="gonder" value="Gönder" /></td>
			</tr>		
		</tbody>
	</table>
</form>
<table align="left" border="0" width="300">
	<tbody>
		<tr>
			<td>
				<a href="index.php">Ana Sayfa</a><br>
				<?php					
					if($kontrol == "admin")
					{
				?>
					<a href="onay.php">Onay Sayfası</a><br>
					<a href="cikis.php">Çıkış Yap</a><br>
				<?php 
					} 
					else if($kontrol == "kullanıcı") 
					{ 
				?>
					<a href="cikis.php">Çıkış Yap</a><br>					
				<?php 
					} 
					else 
					{ 
				?>
					<a href="kullanicikayit.php">Kayıt Ol</a><br>
					<a href="giris.php">Giriş Yap</a><br>
				<?php 
					} 
				?>
			</td>
		</tr>
	</tbody>
</table>