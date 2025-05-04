<?php
require 'db.php';
session_start();

$username = $_SESSION['username'];
$current = $_POST['current_password'];
$new = $_POST['new_password'];

$stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
$stmt->execute([$username]);
$row = $stmt->fetch();

if ($row && password_verify($current, $row['password'])) {
    $hashed = password_hash($new, PASSWORD_DEFAULT);
    $update = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
    $update->execute([$hashed, $username]);
    echo "Şifre başarıyla güncellendi.";
} else {
    echo "Mevcut şifre yanlış.";
}
?>
