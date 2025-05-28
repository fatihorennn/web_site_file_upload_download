<?php
require_once 'auth_check.php';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Kullanıcı Paneli</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="form-container">
    <h2>Hoş Geldiniz, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>Rolünüz: <strong><?php echo htmlspecialchars($_SESSION['role']); ?></strong></p>
    
    <p>Bir işlem seçiniz:</p>
    <ul style="list-style-type:none; padding:0;">
      <li><a href="uploadpage.html" class="btn">📁 Dosya Yükleme</a></li>
      <li><a href="dosya_listesi.php" class="btn">📋 Yüklenen Dosyalar</a></li>
      <li><a href="profil.php" class="btn btn-secondary">👤 Profil Sayfası</a></li>
      
    </ul>

    <br>
    <a href="logout.php" class="btn btn-secondary">Çıkış Yap</a>
  </div>

</body>
</html>
