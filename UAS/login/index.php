<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login || ArsyaFess</title>
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
                            <h2 class="text-center mb-5">MASUK</h2>
                            <form action="../api/login.php" method="post">
                                <div class="form-outline mb-4">
                                    <input type="text"name="emailuname" class="form-control form-control-lg" />
                                    <label class="form-label">Email atau Username</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" name="password" class="form-control form-control-lg" />
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label">Password</label>

                                        </div>
                                        <div class="col-6 text-end"><a href="../forgot">Lupa password ?</a></div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Masuk" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block btn-lg text-light">
                                </div>
                                <p class="text-center text-muted mt-5 mb-0">Belum mempunyai akun? <a href="../signup" class="fw-bold text-body"><u>Daftar disini</u></a></p>
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
if(isset($_GET["sign"])){
    echo '<script>
    Swal.fire({
  title: "Registrasi Berhasil",
  text: "Silahkan login",
  icon: "success"
});
    </script>';
}
if(isset($_GET["fail"])){
    echo '<script>
    Swal.fire({
  title: "Data Tidak Valid",
  text: "Silahkan login kembali",
  icon: "error"
});
    </script>';
}
?>