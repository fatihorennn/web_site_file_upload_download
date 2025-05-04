<?php
require 'db.php';
session_start();

$username = $_SESSION['username'];

$stmt = $pdo->prepare("DELETE FROM users WHERE username = ?");
$stmt->execute([$username]);

session_destroy();
header("Location: login.html");
exit();
