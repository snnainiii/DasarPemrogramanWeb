<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan 2</title>
</head>
<body>
    <?php
        $halaman = $_SERVER['PHP_SELF'];
    ?>

    <form name="tugas2" method="post" action="<?php $halaman; ?>">
        <table>
            <tr>
                <td colspan=2>
                    <div align="center">Macam - Macam Fungsi</div>
                </td>
            </tr>
            <tr>
                <td>Masukkan Bilangan : </td>
                <td><input type="text" name="bilangan" id="bilangan"></td>
            </tr>
            <tr>
                <td>Masukkan Pilihan : </td>
                <td>
                    <select name="pilih" id="pilih">
                        <option value="faktorial">Faktorial</option>
                        <option value="fibonacci">Fibonacci</option>
                        <option value="konversisuhu">Konversi Suhu</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="proses" id="proses" value="Proses"></td>
            </tr>
        </table>
    </form>

    <?php
        function faktorial($bilangan){
            $bilangan = intval($bilangan);
            if($bilangan==0){
                return 1;
            }
            else{
                return $bilangan * faktorial($bilangan - 1);
            }
        }

        function fibonacci($bilangan){
            if ($bilangan == 1 || $bilangan == 2){
                return 1;
            }
            else{
                return fibonacci($bilangan-1) + fibonacci($bilangan-2);
            }
        }

        function fahrenheit($bilangan){
            $bilangan = doubleval($bilangan);
            $fahrenheit = (9/5 * $bilangan) + 32;
            return $fahrenheit;
        }

        function reamur($bilangan){
            $bilangan = doubleval($bilangan);
            $reamur = (4/9 * $bilangan) + 32;
            return $reamur;
        }

        function kelvin($bilangan){
            $bilangan = doubleval($bilangan);
            $kelvin = 273 + $bilangan;
            return $kelvin;
        }

        $proses = $_POST['proses'];
        $bilangan = $_POST['bilangan'];
        $pilih = $_POST['pilih'];

        if($proses){
            if($pilih == "faktorial"){
                $hasil = faktorial($bilangan);
                print("Hasil Faktorial dari $bilangan adalah $hasil");
            }
            elseif($pilih == "fibonacci"){
                $hasil = fibonacci($bilangan);
                print("Hasil Fibonacci dari $bilangan adalah $hasil");
            }
            elseif($pilih == "konversisuhu"){
                $fah = fahrenheit($bilangan);
                $ream = reamur($bilangan);
                $kel = kelvin($bilangan);

                print("Konversi Suhu dari Celcius : <br>");
                print("Fahrenheit = $fah <br>");
                print("Reamur = $ream <br>");
                print("Kelvin = $kel");
            }
        }
    ?>
</body>
</html>