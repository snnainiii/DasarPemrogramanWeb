<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contoh Array</title>
</head>
<body>
    <?php
    $kota = array("Medan","Jakarta","Bangung","Denpasar","Makasar");
    $jumlah = count($kota);
    for ($i=0; $i < $jumlah ; $i++) {   
        print("\$kota[$i] : $kota[$i] <br>\n");
    }
    ?>
</body>
</html>