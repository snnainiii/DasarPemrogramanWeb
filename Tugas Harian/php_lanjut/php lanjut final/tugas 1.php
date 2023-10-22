<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <?php
        $halaman=$_SERVER['PHP_SELF'];
    ?>
    <h1>Pemilihan Tampilan Text</h1>
    <form name="latihan3" id="latihan3" method="post" action="<?php $halaman; ?>">
      <table>
        <tr>
          <td>Teks :</td>
          <td><input type="text" name="teks" id="teks" required/></td>
        </tr>
        <tr>
          <td>Ditampilkan sebanyak :</td>
          <td>
            <select name="jumlahteks" id="jumlahteks">
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="15">15</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Lakukan :</td>
          <td><input name="ea" value="break" type="radio" id="ea"/>Break</td>
          <td><input type="radio" name="ea" value="continue" id="ea"/>Continue</td>
        </tr>
        <tr>
          <td>Pada Hitungan ke :</td>
          <td>
            <select name="hitunganke" id="hitunganke">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </td>
        </tr>
        <tr>
          <td><input type="submit" name="proses" value="Proses" id="proses"/></td>
        </tr>
      </table>
    </form>
    <?php
        $proses=$_POST['proses'];
        $teks=$_POST['teks'];
        $jumlahteks=$_POST['jumlahteks'];
        $ea=$_POST['ea'];
        $hitunganke=$_POST['hitunganke'];

        if($proses){
            for($i=1; $i<=$jumlahteks; $i++){
                    print("hitungan ke-$i : ");
                    if($i==$hitunganke){
                        if($ea=="break"){
                                print("break <br>"); 
                                break; 
                        }elseif($ea=="continue"){ 
                                print("continue <br />"); 
                                continue; 
                        } 
                    } 
                    print(" $teks<br />"); 
            } 
        } 
      ?>
  </body>
</html>
