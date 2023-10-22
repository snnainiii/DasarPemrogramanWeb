<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Logika</title>
</head>

<body>
    <?php
    $nilai = $_POST['nilai1']; 
    $operator = $_POST['operator']; 
    $nilai2 = $_POST['nilai2']; 

    if($operator == 'XOR') { 
        if ($nilai1 == 'TRUE') { 
            if ($nilai2 == 'TRUE') { 
                print($nilai1."<b> XOR </b>".$nilai2."= FALSE"); 
            }else { 
                print($nilai1."<b> XOR </b>".$nilai2."= TRUE"); }
        }else{ 
            if ($nilai2 == 'TRUE'){ 
                print($nilai1."<b> XOR </b>".$nilai2."= TRUE"); 
            }else{ 
                print($nilai1."<b> XOR </b>".$nilai2."= FALSE"); } 
        } 

    }elseif($operator == '&&'){ 
        if ($nilai1 == 'TRUE') { 
            if($nilai2 == 'TRUE') { 
                print($nilai1."<b> AND </b>".$nilai2."= TRUE") 
            }else{ print($nilai1."<b> AND </b>".$nilai2."= FALSE") } 
        }else{ 
            if($nilai2 == 'TRUE') { 
                print($nilai1."<b> AND </b>".$nilai2."= FALSE") 
            }else{ 
                print($nilai1."<b> AND </b>".$nilai2."= FALSE") } 
        } 

    }elseif($operator == '!!') { 
        if($nilai1 == 'TRUE') { 
            if($nilai2 == 'TRUE'){ 
                print($nilai1."<b> OR </b>".$nilai2."= TRUE") 
            }else{ 
                print($nilai1."<b> OR </b>".$nilai2."= TRUE") } 
        }elseif{ 
            if($nilai2 == 'TRUE'){ 
                print($nilai1."<b> OR </b>".$nilai2."= TRUE") 
            }else{ 
                print($nilai1."<b> OR </b>".$nilai2."= FALSE") 
            } 
        } 
    } 
    ?>
</body>

</html>