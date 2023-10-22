<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switch</title>
</head>
<body>
    <form name="bangun2d" method="post" action="pernyataanswitch.php">
        <table>
            <tr>
                <td colspan="2"><div align="center">Menentukan Karakteristik Bangun 2 Dimensi</div></td>
            </tr>
            <tr>
                <td>Nama Bangun</td>
                <td>
                    <select name="bangun">
                        <option value="stg">Segitiga</option>
                        <option value="bs">Bujur</option>
                        <option value="psp">Persegi Panjang</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Pilih" name="pilih"></td>
            </tr>
        </table>
    </form>
    <?php
    $namabangun = $_POST['bangun'];
    switch ($namabangun) {
        case 'stg':
            print("Karakteristik dari Segitiga adalah:<br>");
        print(" - ada 3 sisi<br>");
        print(" - besar setiap sudut 60 derajat<br>");
        print(" - memiliki 3 diagonal<br>");
        break;

        case 'bs':
            print("Karakteristik dari Bujur Sangkar adalah:<br>");
        print(" - ada 4 sisi<br>");
        print(" - besar setiap sudut 90 derajat<br>");
        print(" - memiliki 4 sisi yang sama panjang<br>");
        print(" - memiliki 4 diagonal<br>");
        break;

        case 'psp':
            print("Karakteristik dari Persegi Panjang adalah:<br>");
            print(" - ada 4 sisi<br>");
            print(" - besar setiap sudut 90 derajat<br>");
            print(" - memiliki panjang dan lebar<br>");
            print(" - memiliki 2 diagonal<br>");
    break;
    }
    ?>
</body>
</html>