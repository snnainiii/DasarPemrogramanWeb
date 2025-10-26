<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Simpan</title>
</head>
<body>
	<?PHP
		$nama=$_POST['nama'];
		$sex=$_POST['sex'];
		$email=$_POST['email'];
		$komentar=$_POST['komentar'];
		$minatl=$_POST['minat1'];
		$minat2=$_POST['minat2'];
		$minat3=$_POST['minat3'];

		if(empty($nama) OR empty($email)) {
			print("Data nama, email, dan komentar harap diisi");
		}
		if(isset($minat1)) {
			$kode_minat1="v";
		}else{
			$kode_minat1="-";
		}
		if(isset($minat2)) {
			$kode_minat2="v";
		}else{
			$kode_minat2="-";
		}
		if(isset($minat3)) {
			$kode_minat3="v";
		}else{
			$kode_minat3="-";
		}
		$kode_minat=$kode_minat1.$kode_minat2.$kode_minat3;

		//membuka file
			$pegangan =fopen("bukutamu.txt","a+");
		// menyimpan data
		fputs($pegangan, $nama."\n");
		fputs($pegangan, $sex."\n");
		fputs($pegangan, $email."\n");
		fputs($pegangan, $kode_minat."\n");
		fputs($pegangan, $komentar."\n");
		fputs($pegangan, "*-*\n");

		//menutup file
		fclose($pegangan);

		print("Halo, $nama. Data Anda sudah disimpan<br>");
		print("Terima Kasih <br>");
		print("<FORM name='bacabukutamu' method='post' action='bacabukutamu.php'>");
		print("<input type='submit' value='Baca Data'>");
		print("</FORM>");
	?>
</body>
</html>
