<?php
$angka = array(1,2,3,4,5,6,7,8,9);
foreach($angka as $num){
    if($num%2==1){
        echo $num." adalah angka ganjil<br>";
    }else{
        echo $num." adalah angka genap<br>";
    }
}