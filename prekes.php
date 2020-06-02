<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prekių sąrašas</title>
    <style>
        * {box-sizing: border-box;}
        main {width:1000px; margin:0 auto; background: #CC9;}
        main h1 {padding:20px;}
        .clear {  content: "";   clear: both;  display: table;}
        .prekes {padding:5px;}
        .preke {width: 300px; min-height: 360px; float:left; margin:15px; background: #fff; border: 1px solid #ccc; position: relative; padding-bottom: 10px; }
        .preke img {max-width: 100%;}
        .preke h4 {text-align: center;}
        .preke .kaina {text-align: center; color: #C33; font-weight: bold; font-size: 20px;}
        .preke .kaina span {text-decoration:line-through; color:#ccc; font-weight: normal; margin:5px; font-size:12px;}
        .preke .akcija {width: 50px; height:50px; line-height: 50px; text-align: center; background-color: #C33; color:#fff; font-weight: bold; font-size: 20px; position: absolute; top:-10px; right: -10px; border-radius: 50%;}
    
    </style>
</head>
<body>
    <main>
        <h1>Prekių sąrašas</h1>
        <div class="prekes">

<form action="prekes.php" method="post">
    <input type="submit" name="devynios" value="Pirmos 9 prekes"/>
</form>  
<form action="prekes.php" method="post">
    <input type="submit" name="visos" value="Visos prekes"/>
</form> 
<form action="prekes.php" method="post">
    <input type="submit" name="desimpenk" value="nuo 10 iki 50"/>
</form> 
<form action="prekes.php" method="post">
    <input type="submit" name="akcija" value="Akcija"/>
</form> 

<?php 

include 'array.php';

function preke ($pav, $pic, $kaina, $nuol=0)
        {
            echo '<div class="preke">';
            echo "<img src=\"" . $pic . "\">";
            echo '<h4>' . $pav . '</h4>';            
            if ($nuol > 0){
                $kainos20 = $kaina * $nuol / 100;
                $kaina2 = $kaina - $kainos20;
                echo '<div class="kaina">';
                    echo '<span>' . number_format($kaina, 2, ",", " ") . ' EUR</span>';
                    echo number_format($kaina2, 2, ",", " ") . ' EUR';
                echo '</div>';
                echo '<div class="akcija">-' . $nuol . '%</div>';
            } else {
                echo '<div class="kaina">' . number_format($kaina, 2, ",", " ") . ' EUR</div>';
            }
            echo '</div>';
        }
//2 dalis: iškviesti pirmas 9 prekės - funkcija          
function kuriPreke ($numeris, $kiekiskviesti){
    
include 'array.php';
            
for ($numeris = 0; $numeris <= $kiekiskviesti; $numeris++){
    
    preke($prekes[$numeris]['pav'],$prekes[$numeris]['pic'],$prekes[$numeris]['kaina'],$prekes[$numeris]['nuol']);
    }
}
            
//2 dalis: išvesti pirmas 9 prekės - išvedimas
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['devynios']))
    {
        kuriPreke(0, 8);
    }

//3 dalis: išvesti visas prekes: kuriPreke(0, 29); arba:

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['visos']))
    {
        foreach($prekes as $pre){
    preke($pre['pav'], $pre['pic'], $pre['kaina'], $pre['nuol']);
                }
    }            


//4 dalis: vios prekės, kurių kaina nuo 10€ iki 50€
            
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['desimpenk']))
    {
    for ($numeris = 0; $numeris <= 29; $numeris++){
    
    if($prekes[$numeris]['kaina']<50 && $prekes[$numeris]['kaina']>10){
        preke($prekes[$numeris]['pav'],$prekes[$numeris]['pic'],$prekes[$numeris]['kaina'],$prekes[$numeris]['nuol']);  
    }}
    }



//5 dalis: visos prekės, kurioms taikoma akcija
               
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['akcija']))
    {
for ($numeris = 0; $numeris <= 29; $numeris++){
    
    if($prekes[$numeris]['nuol'] !== '0'){
        preke($prekes[$numeris]['pav'],$prekes[$numeris]['pic'],$prekes[$numeris]['kaina'],$prekes[$numeris]['nuol']);  
        }
    }
}
?> 
            
            <div class="clear"></div>
        </div>
    </main>
</body>
</html>                                                                                                                                                                                                                                      