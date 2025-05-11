<?php
require_once "db.php";
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
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $role = "low_user";

    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    try {
        $stmt->execute([$username, $password, $role]);

        //Başarılı kayıt sonrası yönlendirme
        header("Location: login.html");
        exit;

    } catch (PDOException $e) {
        // Kayıt başarısızsa hata mesajı
        echo "Kayıt başarısız: " . $e->getMessage();
    }
}
?>
