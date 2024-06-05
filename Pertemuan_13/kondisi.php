<?php
$hour = date("H");
if($hour<10){
    echo "Good morning !";
}else if($hour < 20){
    echo "Good afternoon !";
}else{
    echo "Good night";
}