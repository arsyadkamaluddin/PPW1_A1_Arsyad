<?php
include "user.php";
session_start();
if(isset($_POST["emailuname"])){
    if(login($_POST["emailuname"],$_POST["password"])){
        $_SESSION["userId"]=getId($_POST["emailuname"]);
        $uname = getUserName($_SESSION["userId"]);
        setcookie("username",$uname,time()+3600,"/");
        header("Location: ../");
    }else{
        header("Location: ../login?fail");
    }
}else{
    header("Location: ../signup");
}