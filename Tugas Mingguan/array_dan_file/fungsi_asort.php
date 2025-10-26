<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fungsi Asort</title>
</head>
<body>
    <?php
    $buah = array("A" => "Nanas",
                "E" => "Pepaya",
                "C" => "Mangga",
                "F" => "Apel");
    print("Data asli:<br>");
    foreach ($buah as $index => $nilai) {
        print("[$index] adalah $nilai <br>");
    }

    print("Hasil asort:<br>");
    asort($buah);
    foreach ($buah as $index => $nilai) {
        print("[$index] adalah $nilai <br>");
    }
    ?>
</body>
</html>