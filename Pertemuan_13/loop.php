<?php
echo "Ini dengan while<br>";
$angka = 1;
while($angka <=5){
    echo "ini angka ".$angka."<br>";
    $angka++;
}

echo "<br>Ini dengan do while<br>";
do{
    echo "ini angka ".$angka."<br>";
    $angka++;
}while($angka<=10);

echo "<br>Ini dengan for loop<br>";
for($angka;$angka<=15;$angka++){
    echo "ini angka ".$angka."<br>";    
}

echo "<br>Ini adalah array dicetak dengan foreach<br>";
$nama = array("John","Mark","Lee","Theo");
foreach($nama as $name){
    echo "My name is ".$name."<br>";
}