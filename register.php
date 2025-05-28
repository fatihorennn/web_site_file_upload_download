<?php
session_start();

require_once "db.php";
// PHPMailer için

require 'PHPmailer/src/PHPMailer.php';
require 'PHPmailer/src/SMTP.php';
require 'PHPmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$recaptcha_secret = '6LcfZzErAAAAAGufPLxrYZWO4Ja1t5S-gfpsfKmd';
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
    try {
        // Looking to send emails in production? Check out our Email API/SMTP product!
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'fe90fb116eea75';
        $mail->Password = 'da2d636d958c1e';

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
