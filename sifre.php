<html>
<head>
<?php
	$mesaj = "";
	if(isset($_POST["gonder"]))
	{
		include "veritabani.php";
		$kadi = $_POST["kadi"];
		$kgizlisoru = $_POST["kgizlisoru"];
		$kgizlicevap = $_POST["kgizlicevap"];
		$sorgu = "SELECT kayitli_sifre FROM kayitlikullanicilar WHERE kayitli_kadi = '$kadi' AND kayitli_gizlisoru = '$kgizlisoru' 
		AND kayitli_gizlisorucevap = '$kgizlicevap'";
		$sql = mysql_query($sorgu);
		if(mysql_num_rows($sql) > 0)
		{
			$satir = mysql_fetch_row($sql);
			$mesaj = "Şifreniz: $satir[0]<br><a href='index.php'>Ana Sayfa</a>";
		}
		else
		{
			$mesaj = "Bilgileriniz hatalı.";
		}
	}
?>
</head>
<body>
<form action="sifre.php" method="POST"> 
	<table align="center" border="0" width="300" cellspacing="0">
		<tbody>
		<tr>
				<td width="160">Gizli soru</td>
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
				<td>Gizli soru cevap</td>
				<td><input type="text" size="19" name="kgizlicevap" required /></td>
			</tr>
			<tr>
				<td>Kullanıcı adı:</td>
				<td><input type="text" size="19" name="kadi" required /></td>
			</tr>
			<tr>
				<td colspan='2' align="right"><input type="submit" name="gonder" value="Gönder" /></td>
			</tr>
			<tr>
				<td><?php echo $mesaj; ?></td>
			</tr>
		</tbody>
	</table>
</form>
</body>
</html>