<?php
require "../api/functions.php";
$_POST["nama"] = ucwords($_POST["nama"]);
$_POST["username"] = strtolower(str_replace(" ","",$_POST["username"]));
$_POST["email"] = strtolower($_POST["email"]);
$_POST["avatar"] = $_POST["avatar"]=="Pilihan"?"":"avatar ".$_POST["avatar"];
if(updateUser($_GET["uid"],$_POST)){
    setcookie("username",$_POST["username"],time()+3600,"/");
    header("Location: ./?name=".$_POST["username"]);
}else{
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
