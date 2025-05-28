<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    http_response_code(403);
    exit("Giriş yapmanız gerekiyor.");
}?>
