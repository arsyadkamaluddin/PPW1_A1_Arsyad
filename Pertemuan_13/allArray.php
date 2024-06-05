<?php
echo "Ini adalah array satu dimensi dan nilainya diakses dengan indeksnya<br>";
$cars = array("Volvo","BMW","Toyota");
$len = count($cars);
echo "I like ".$cars[0].", ".$cars[1].", ".$cars[2];
echo "<br>panjang array ini adalah ".$len;
echo "<br><br>untuk mencetak menggunakan perulangan for loop<br>";
for($i=0;$i<$len;$i++){
    echo "Mobil ".$cars[$i]."<br>";
}

echo "<br>ini adalah associative array yaitu array dengan pasangan key-value";
$age = array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
echo "<br>untuk mencetaknya dapat dengan foreach<br>";
foreach($age as $key=>$val){
    echo $key." is ".$val." years old<br>";
}

echo "<br>ini adalah array ,multidimensi yang dicetak menggunakan for loop<br>";
$cars = array(
    array("Volvo",22,18),
    array("BMW",15,13),
    array("Saab",5,2),
    array("Land Rover",17,15)
);
for($row = 0; $row < 4; $row++){
    echo "<b>Baris ke $row</b><br>";
    echo "<ul>";
    for($col=0;$col<3;$col++){
        echo "<li>".$cars[$row][$col]."</li>";
    }
    echo "</ul>";
}