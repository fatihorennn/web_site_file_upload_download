<?php
require_once "db.php";

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
