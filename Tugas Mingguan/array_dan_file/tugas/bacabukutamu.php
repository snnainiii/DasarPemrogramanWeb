<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baca Buku Tamu</title>
</head>
<body>
        <?php
    $no_data=1;
    //$pegangan=fopen("bukutamu.dat","r");
        $pegangan=fopen("bukutamu.txt","r");
    while (!feof($pegangan)) {
        //untuk nama, kelamin, email
        $nama= trim(fgets($pegangan,255));
        if ($nama==FALSE) {
            break;
        }
        $kelamin = trim(fgets($pegangan,255));
        if ($kelamin=="p"){
            $kelamin ="Perempuan<br>";
        }else{
            $kelamin ="Laki-Laki<br>";
        }
        $email= trim(fgets($pegangan,255));

        //untuk minat
        $kode_minat=trim(fgets($pegangan,255));
        $minat="";
        for($i=0; $i<3; $i++){
            if(substr($kode_minat,$i,1)=='v'){
                switch($i){
                    case 0:
                    $minat .="Pemrograman<br>";
                    break;
                    case 1:
                    $minat .="Manajemen<br>";
                    break;
                    case 2:
                    $minat .="Sosial<br>";
                    break;
                }
            }
        }
        //untuk komentar
        $ket="";
        while(!feof($pegangan)){
            $tamp= trim(fgets($pegangan,255));
                if($tamp=="*-*"){
                    break;
            }
                $ket .= ($tamp."<br>");
        }
        //tampilkan
        print("<b>Data ke-$no_data : </b><br>");
        print("Nama : $nama <br>");
        print("Jenis Kelamin: $kelamin <br>");
        print("E-mail: $email<br>");
        if (!empty ($minat)) {
            print("Minat: <br> $minat <br>");
        }
        print("Komentar : <br> $ket<br>");
        $no_data++;
    }
?>
</body>
</html>
