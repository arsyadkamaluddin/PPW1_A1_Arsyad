<?php
$kendaraan = array(
    array("Motor","Astrea"),
    array("Motor","Vario"),
    array("Mobil","Innova"),
    array("Mobil","Avanza")
);

foreach($kendaraan as $row){
    foreach($row as $col){
        if($col=="Motor"){
            echo $col." beroda 2 ";
        }else if($col=="Mobil"){
            echo $col." beroda 4 ";
        }else{
            echo " dengan brand ".$col."<br>";
        }
    }
}