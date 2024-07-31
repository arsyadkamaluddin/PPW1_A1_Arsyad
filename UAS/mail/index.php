<?php
require("../api/functions.php");
if(isset($_GET["email"])){
    $email_penerima = $_GET["email"];
    $uId = getId($email_penerima);
}else{
    header("Location: ../index.php");
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('./Exception.php');
include('./PHPMailer.php');
include('./SMTP.php');

$email_pengirim = env('EMAIL');
$nama_pengirim = "ArsyaFess";
$subjek = "Ubah Kata Sandi";
$pesan = "<body style='color:black;'><h1 style='text-align:center;'>Ubah Password Arsyafess</h1><p>Seseorang mencoba untuk mengubah kata sandi anda, apabila itu anda maka silahkan buka tautan dibawah untuk mengganti kata sandi</p><br><a href='localhost/forgot/?ufw=".$uId."'>Klik disini</a><br><p>Jika itu bukan anda maka abaikan pesan ini dan jaga keamanan akun anda</p></body>";

$mail = new PHPMailer;
$mail -> isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->Username = $email_pengirim;
$mail->Password = env('EMAIL_PASSWORD');
$mail->SMTPAuth= true;
$mail->Port= 465;
$mail->SMTPSecure= "ssl";
$mail->SMTPDebug= 2;
$mail->setFrom($email_pengirim,$nama_pengirim);
$mail->addAddress($email_penerima);
$mail->isHTML(true);
$mail->Subject= $subjek;
$mail->Body = $pesan;
$send = $mail->send();
header("Location: ../forgot?ml");
?>
