<?php
$conn = mysqli_connect("localhost","root","","akademik",3306);
if(!$conn){
    die("Connection failed. ".mysqli_connect_error());
}
echo "Connected to database";