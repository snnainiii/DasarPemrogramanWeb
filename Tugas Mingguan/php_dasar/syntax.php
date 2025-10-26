<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syntax PHP</title>
</head>

<body>
    <?
    echo "Menggunakan echo<br>";
    echo "================<br>";
    $data = "devie <br>";
    echo  $data;
    echo "D3 Management Informatika<br>";
    echo $data."Dosen Unijoyo";
    ?>

    <?
    print ("<br><br> Menggunakan print <br>");
    print ("================<br>");
    $data = "devie <br>";
    print  ($data);
    print ("D3 Management Informatika<br>");
    print ($data."Dosen Unijoyo");
    ?>

    <?
    printf ("<br><br> Menggunakan print <br>");
    printf ("================<br>");
    $data = "devie";
    printf  ("%s",$data);
    printf ("%s Dosen Unijoyo");
    ?>

</body>

</html>