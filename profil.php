<?php
require_once 'auth_check.php';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Profil Sayfası</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="form-container">
    <h2>Profil Bilgileri</h2>
    <p>Kullanıcı Adı: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
    <p>Rol: <strong><?php echo htmlspecialchars($_SESSION['role']); ?></strong></p>

    <hr>
    <h3>Şifre Değiştir</h3>
    <form action="sifre_degistir.php" method="POST">
      <label for="current">Mevcut Şifre:</label>
      <input type="password" name="current_password" required>

      <label for="new">Yeni Şifre:</label>
      <input type="password" name="new_password" required>

      <input type="submit" value="Şifreyi Güncelle">
    </form>

    <hr>
    <h3>Hesabı Sil</h3>
    <form action="hesap_sil.php" method="POST" onsubmit="return confirm('Hesabınızı silmek istediğinize emin misiniz? Bu işlem geri alınamaz!');">
      <input type="submit" value="Hesabı Kalıcı Olarak Sil" style="background-color:red;">
    </form>

    <br>
    <a href="dashboard.php" class="btn btn-secondary">← Geri Dön</a>
  </div>
</body>
</html>
