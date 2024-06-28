<?php
require("../api/functions.php");
    if(isset($_POST["emailuname"])){
        setcookie("emailuname",$_POST["emailuname"],time()+10);
        header("Location: ../mail?email=".$_POST["emailuname"]);
    }
    if(isset($_POST["newPass"])&&isset($_POST["conPass"])){
        $new = $_POST["newPass"];
        $con = $_POST["conPass"];
        if($new!=$con){
            echo "<script>alert('Password anda tidak cocok keduanya !');</script>";
            header("Refresh:0");
        }else{
            changePassword($_GET["ufw"],password_hash($new,PASSWORD_DEFAULT));
            header("Location: ../login");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget || ArsyaFess</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>
<body class="">
    <div class="mask d-flex align-items-center vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-center mb-5">LUPA PASSWORD</h2>
                            <?php if(isset($_GET["ufw"])):?>
                                <form action="" method="post">
                                    <div class="form-outline mb-4">
                                        <input type="password"name="newPass" class="form-control form-control-lg" />
                                        <label class="form-label">Password Baru</label>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password"name="conPass" class="form-control form-control-lg" />
                                        <label class="form-label">Konfirmasi Password</label>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <input type="submit" value="Konfirmasi" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block btn-lg text-light">
                                    </div>
                                </form>
                                <?php elseif(isset($_GET["ml"])):?>
                                    <p>Silahkan buka link yang kami kirimkan ke <?=$_COOKIE["emailuname"]?></p>
                                <?php else:?>
                                <form action="" method="post">
                                    <div class="form-outline mb-4">
                                        <input type="email"name="emailuname" class="form-control form-control-lg" />
                                        <label class="form-label">Email</label>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <input type="submit" value="Konfirmasi" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block btn-lg text-light">
                                    </div>
                                </form>
                                <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>