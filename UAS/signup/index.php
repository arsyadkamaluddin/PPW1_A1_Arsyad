<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar || Arsyafess</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="">
    <div class="mask d-flex align-items-center vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-center mb-5">BUAT AKUN</h2>
                            <form action="../api/signup.php" method="post">
                                <div class="form-outline mb-4">
                                    <input type="text" name="nickname" class="form-control form-control-lg" />
                                    <label class="form-label">Nama Lengkap</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="email"name="email" class="form-control form-control-lg" />
                                    <label class="form-label">Email</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" name="password" class="form-control form-control-lg" />
                                    <label class="form-label">Password</label>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Daftar" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block btn-lg text-light">
                                </div>
                                <p class="text-center text-muted mt-5 mb-0">Sudah mempunyai akun? <a href="../login" class="fw-bold text-body"><u>Login disini</u></a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php 
if(isset($_GET["fail"])){
    echo '<script>
    Swal.fire({
  title: "Registrasi Gagal",
  text: "Email telah digunakan",
  icon: "error"
});
    </script>';
}
?>