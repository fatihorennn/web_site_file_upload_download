<?php
session_start();
require 'db.php';

$recaptcha_secret = "YOUR_SECRET_KEY";               //CHANGE THİS LİNE
$response = $_POST['g-recaptcha-response'] ?? '';
$remoteip = $_SERVER['REMOTE_ADDR'];

// Google sunucusuna doğrulama isteği gönder
$verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$response&remoteip=$remoteip");
$response_data = json_decode($verify);

if (!$response_data || !$response_data->success) {
    echo "Robot doğrulaması başarısız.";
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {

    if ($user["is_verified"] == 0) {
                echo "Hesabınız henüz doğrulanmamış. Lütfen e-posta adresinize gelen kod ile doğrulayın.";
                header("Location: register.php");
                exit;
            }

    $_SESSION['username'] = $user['username'];
    $_SESSION['user_id'] = $user['id'];  // dosya yüklemede lazım
    $_SESSION['role'] = $user['role'];
    echo "success";
} else {
    echo "Hatalı kullanıcı adı veya şifre";
}
?>
