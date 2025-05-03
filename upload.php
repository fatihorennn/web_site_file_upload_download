<?php
require_once "db.php";
require_once "auth_check.php";

$user_id = $_SESSION["user_id"];
$hedef_klasor = "yuklenenler/";
$dosya_adi = basename($_FILES["yuklenen_dosya"]["name"]);
$gecici_dosya = $_FILES["yuklenen_dosya"]["tmp_name"];
$hedef_yol = $hedef_klasor . $dosya_adi;

if ($_FILES["yuklenen_dosya"]["error"] !== UPLOAD_ERR_OK) {
    echo "Yükleme hatası: " . $_FILES["yuklenen_dosya"]["error"];
    exit;
}

if (move_uploaded_file($gecici_dosya, $hedef_yol)) {
    $stmt = $pdo->prepare("INSERT INTO uploads (user_id, file_name) VALUES (?, ?)");
    $stmt->execute([$user_id, $dosya_adi]);
    echo "✅ Dosya yüklendi!";
} else {
    echo "❌ Dosya taşınamadı!";
}
?>
