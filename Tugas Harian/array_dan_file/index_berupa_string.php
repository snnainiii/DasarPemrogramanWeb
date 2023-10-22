<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Berupa String</title>
</head>
<body>
    <?php
    $mobil["tipe"] = "SideKick";
    $mobil["merk"] = "Suzuki";
    $mobil["warna"] = "Merah";
    foreach ($mobil as $index => $element) {
        print("$indeks: $element <br>\n");
    }
    ?>
</body>
</html>