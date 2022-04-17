<?php 
	if(isset($_POST["kaydet"]))
	{
		$ktcno = $_POST["ktcno"];
		$kadi = $_POST["kadi"];
		$ksoyadi = $_POST["ksoyadi"];
		$kmail = $_POST["kmail"];
		$kullaniciadi = $_POST["kullaniciadi"];
		$ksifre = $_POST["ksifre"];
		$ksifretekrar = $_POST["ksifretekrar"];
		$kgizlisoru = $_POST["kgizlisoru"];
		$kgizlicevap = $_POST["kgizlicevap"];
		$kcinsiyet = $_POST["kcinsiyet"];
		$tarih = date("Y-m-d H:i:s");
		if($ksifre != $ksifretekrar)
		{
			echo "<font color='red'>Şifreler eşleşmiyor. Tekrar giriniz.</font><br>";
		}
		else
		{
			include "veritabani.php";
			$sorgu = "INSERT INTO kayitlikullanicilar(kayitli_tc,kayitli_adi,kayitli_soyadi,
			kayitli_mail,kayitli_cinsiyet,kayitli_tarih,kayitli_kadi,kayitli_sifre,kayitli_gizlisoru,
			kayitli_gizlisorucevap,yetki) VALUES('$ktcno','$kadi','$ksoyadi','$kmail','$kcinsiyet','$tarih',
			'$kullaniciadi','$ksifre','$kgizlisoru','$kgizlicevap','kullanıcı')";
			mysql_query($sorgu) or die(mysql_error());
			echo "<font color='green'>Kayıt gerçekleştirilmiştir.</font><br><a href='index.php'>Ana Sayfa</a>";
		}
	}
?>
<form action="kullanicikayit.php" method="POST">
	<table border="0">
		<tbody>
			<tr>
				<td>T.C. Kimlik No</td>
				<td><input type="text" name="ktcno" maxlength="11" required /></td>
			</tr>
			<tr>
				<td>Adı</td>
				<td><input type="text" name="kadi" required /></td>
			</tr>
			<tr>
				<td>Soyadı</td>
				<td><input type="text" name="ksoyadi" required /></td>
			</tr>
			<tr>
				<td>Mail</td>
				<td><input type="email" name="kmail" required /></td>
			</tr>
			<tr>
				<td>Kullanıcı Adı</td>
				<td><input type="text" name="kullaniciadi" required /></td>
			</tr>
			<tr>
				<td>Şifre</td>
				<td><input type="password" name="ksifre" required /></td>
			</tr>
			<tr>
				<td>Şifre Tekrar</td>
				<td><input type="password" name="ksifretekrar" required /></td>
			</tr>
			<tr>
				<td>Gizli Soru</td>
				<td>
					<select name="kgizlisoru">
						<option value="En sevdiğiniz hayvan?">En sevdiğiniz hayvan?</option>
						<option value="Doğduğunuz şehir?">Doğduğunuz şehir?</option>
						<option value="Sevdiğiniz karakter?">Sevdiğiniz karakter?</option>
						<option value="Annenizin kızlık soyadı?">Annenizin kızlık soyadı?</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Gizli Soru Cevap</td>
				<td><input type="text" name="kgizlicevap" required /></td>
			</tr>
			<tr>
				<td>Cinsiyet</td>
				<td>
					<select name="kcinsiyet">
						<option value="Erkek">Erkek</option>
						<option value="Kadın">Kadın</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="kaydet" value="Kaydet" /></td>
			</tr>
		</tbody>
	</table>
</form>