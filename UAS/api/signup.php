<?php
include "functions.php";
if(isset($_POST["nickname"])){
    $_POST["password"] = password_hash($_POST["password"],PASSWORD_DEFAULT);
    if(addUser($_POST)){
        header("Location: ../login?sign");
    }else{
        header("Location: ../signup?fail");
    }
}else{
    header("Location: ../signup?fail");
}