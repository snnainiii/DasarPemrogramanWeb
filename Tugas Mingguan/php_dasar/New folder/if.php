<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IF</title>
</head>

<body>
    <form name="diskon" method="post" action="pernyataanif.php">
        <table>
            <tr>
                <td>Penentuan Diskon</td>
            </tr>
            <tr>
                <td>Besar Pembelian: Rp. <input type="text" name="beli"></td>
            </tr>
            <tr>
                <td><input type="submit" name="proses" value="Hitung"></td>
            </tr>
        </table>
    </form>
    <?php 
    $beli = $_POST['beli'];

    if($beli != ""){
        $beli = intval($beli);
        $diskon = 0;
        if ($beli >= 10000){
            $diskon = intval(0.1 * $beli);
        print("Diskon = Rp.".$diskon."<br>");
        print("Pembayaran = Rp.".($beli-$diskon)."<br>");
        }
    }
    ?>
</body>

</html>