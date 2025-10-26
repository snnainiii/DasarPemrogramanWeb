<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Comparison</title>
</head>

<body>
    <?PHP
    $kode_hari = date("w");
    if ($kode_hari == 0)
        print("Minggu");
    elseif ($kode_hari == 1)
        print("Senin");
    elseif ($kode_hari == 2)
        print("Selasa");
    elseif ($kode_hari == 3)
        print("Rabu");
    elseif ($kode_hari == 4)
        print("Kamis");
    elseif ($kode_hari == 5)
        print("Jumat");
    else
        print("Sabtu");
    ?>
</body>

</html>