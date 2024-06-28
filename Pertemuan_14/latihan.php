<?php
$conn = mysqli_connect("localhost","root","","akademik",3306);
if(!$conn){
    die("Connection failed. ".mysqli_connect_error());
}
echo "Connected to database";
echo "<br>";

$sql = "SELECT * FROM mahasiswa";
$res = mysqli_query($conn,$sql);
if(mysqli_num_rows($res)){
    while($row=mysqli_fetch_assoc($res)){
        echo "NIM : ".$row["nim"]." - Nama : ".$row["nama"]." - Alamat : ".$row["alamat"]."<br>";
    }
}else{
    echo "No Data Founded";
}