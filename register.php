<?php

session_start();

require_once "db.php";
// PHPMailer için

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$recaptcha_secret = 'YOUR-SECRET-KEY';       //CHANGE THİS LİNE
$response = $_POST['g-recaptcha-response'];
$remoteip = $_SERVER['REMOTE_ADDR'];

$verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$response&remoteip=$remoteip");
$response_data = json_decode($verify);

if (!$response_data->success) {
    die("reCAPTCHA doğrulaması başarısız.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $role = "low_user";

    $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $expires = date("Y-m-d H:i:s", time() + 300); // 5 dakika geçerli

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role,twofa_code, twofa_expires, is_verified) VALUES (?, ?, ?, ?, ?, ?, 0)");
    $stmt->execute([$username, $email, $password, $role, $code, $expires]);

    $_SESSION["temp_user_id"] = $pdo->lastInsertId();

    $mail = new PHPMailer(true);
    try {//this try block write for mailtrap.io

        //This try block depends on your SMTP server.          
        //Bu try bloğunu kendi smtp sunucuna göre değiştir.
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 0;  //CHANGE THİS                                
        $mail->Username = 'CHANGE THİS';
        $mail->Password = 'CHANGE THİS';

        $mail->setFrom('site@example.com', 'kayit sistemi');
        $mail->addAddress($email, $username);

        $mail->isHTML(true);
        $mail->Subject = 'Hesabinizi dogrulayin';
        $mail->Body = "Merhaba $username,<br><br> Doğrulama kodunuz: <b>$code</b><br>Bu kod 5 dakika geçerlidir.";

        $mail->send();
        header("Location: verify_2fa.php");
        exit;
    } catch (Exception $e) {
        echo "Kod gönderilemedi: {$mail->ErrorInfo}";
    }
}
?>
