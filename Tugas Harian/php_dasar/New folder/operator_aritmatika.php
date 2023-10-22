<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Aritmatika</title>
</head>

<body>
    <form name="calculator" method="post" action="operator_aritmatika.php">
        <table>
            <tr>
                <td colspan="2">
                    <div align="center">Calculator Sederhana</div>
                </td>
            </tr>
            <tr>
                <td>Operand Pertama</td>
                <td><input type="text" name="nilaipertama"></td>
            </tr>
            <tr>
                <td>Operator</td>
                <td>
                    <select name="operator">
                        <option value="*">Perkalian</option>
                        <option value="/">Pembagian</option>
                        <option value="%">Modulus</option>
                        <option value="+">Penjumlahan</option>
                        <option value="-">Pengurangan</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Operand Kedua</td>
                <td><input type="text" name="nilaikedua"></td>
            </tr>
            <tr>
                <td><input type="submit" name="proses" value="Hitung"></td>
            </tr>
        </table>
    </form>
    <?PHP
    $nilaipertama = $_POST['nilaipertama'];
    $operator = $_POST['operator'];
    $nilaikedua = $_POST['nilaikedua'];
    if ($operator =='*') {
        $hasil = $nilaipertama * $nilaikedua;
        print("Hasil Perkalian = <b>$hasil</b>");
    }
    elseif ($operator =='/') {
        $hasil = $nilaipertama / $nilaikedua;
        print("Hasil Pembagian = <b>$hasil</b>");
    }
    elseif ($operator =='%') {
        $hasil = $nilaipertama % $nilaikedua;
        print("Hasil Modulus = <b>$hasil</b>");
    }
    elseif ($operator =='+') {
        $hasil = $nilaipertama + $nilaikedua;
        print("Hasil Penjumlahan = <b>$hasil</b>");
    }
    elseif ($operator =='-') {
        $hasil = $nilaipertama - $nilaikedua;
        print("Hasil Pengurangan = <b>$hasil</b>");
    }
    ?>
</body>

</html>