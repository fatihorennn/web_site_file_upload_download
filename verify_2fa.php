<?php
session_start();
require 'db.php'; // PDO bağlantısı

if (!isset($_SESSION["temp_user_id"])) {
    die("Geçersiz oturum. Lütfen yeniden kayıt olun.");
}

$user_id = $_SESSION["temp_user_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input_code = trim($_POST["code"]);

    // Veritabanından kod ve süresini çek
    $stmt = $pdo->prepare("SELECT twofa_code, twofa_expires FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if ($user) {
        $db_code = $user["twofa_code"];
        $expires = strtotime($user["twofa_expires"]);

        if ($input_code === $db_code && $expires > time()) {
            // Doğrulama başarılı → kullanıcıyı aktif et
            $stmt = $pdo->prepare("UPDATE users SET is_verified = 1, twofa_code = NULL, twofa_expires = NULL WHERE id = ?");
            $stmt->execute([$user_id]);

            unset($_SESSION["temp_user_id"]);
            header("Location: logout.php");
            exit;
        } else {
            $error = "Kod hatalı veya süresi dolmuş.";
        }
    } else {
        $error = "Kullanıcı bulunamadı.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Doğrulama Kodu</title>
</head>
<body>
    <h2>Doğrulama Kodunu Girin</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="code" maxlength="6" required placeholder="6 haneli kod"><br>
        <button type="submit">Doğrula</button>
    </form>
</body>
</html>
