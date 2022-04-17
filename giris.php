<html>
<head>
<?php
	session_start();
	$mesaj = "";
	if(isset($_SESSION["girisyapildi"]))
	{
		header("Location:index.php");
	}
	else
	{
		if(isset($_POST["gonder"]))	
		{
			include "veritabani.php";
			$kadi = $_POST["kadi"];
			$sifre = $_POST["sifre"];
			$sorgu = "SELECT kayitli_tc,yetki FROM kayitlikullanicilar WHERE kayitli_kadi = '$kadi' AND kayitli_sifre = '$sifre'";
			$sql = mysql_query($sorgu);
			if(mysql_num_rows($sql) > 0)
			{
				$satir = mysql_fetch_row($sql);
				$_SESSION["girisyapildi"] = true;
				$_SESSION["id"] = $satir[0];
				$_SESSION["kontrol"] = $satir[1];
				header("Location:index.php");
			}
			else
			{
				$mesaj = "<font color='red'>Kullanıcı adı yada şifre hatalı.</font>";
			}
		}
?>
</head>
<body>
<form action="giris.php" method="POST"> 
	<table align="center" border="0" width="300" cellspacing="0">
		<tbody>
			<tr>
				<td colspan="2"><?php echo $mesaj; ?></td>
			</tr>
			<tr>
				<td width="160">Kullanıcı adı:</td>
				<td><input type="text" size="18" name="kadi" /></td>
			</tr>
			<tr>
				<td>Şifre:</td>
				<td><input type="password" size="18" name="sifre" /></td>		
			</tr>
			<tr>
				<td><a href="sifre.php">Şifremi Unuttum</a></td>
				<td align="right"><input type="submit" name="gonder" value="Gönder" /></td>
			</tr>	
		</tbody>
	</table>
</form>
<?php } ?>
</body>
</html>