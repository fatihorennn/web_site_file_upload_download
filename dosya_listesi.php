<?php
require_once 'auth_check.php';
require 'db.php';

$username = $_SESSION['username'];
$stmt = $pdo->prepare("SELECT uploads.file_name, uploads.uploaded_at
                       FROM uploads
                       JOIN users ON uploads.user_id = users.id
                       WHERE users.username = ?");
$stmt->execute([$username]);
$dosyalar = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Yüklenen Dosyalar</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="form-container">
    <h2>Yüklediğiniz Dosyalar</h2>

    <?php if (count($dosyalar) === 0): ?>
      <p>Henüz hiç dosya yüklemediniz.</p>
    <?php else: ?>
      <ul>
        <?php foreach ($dosyalar as $dosya): ?>
          <li>
            <a href="yuklenenler/<?php echo htmlspecialchars($dosya['file_name']); ?>" target="_blank">
              <?php echo htmlspecialchars($dosya['file_name']); ?>
            </a>
            (<?php echo $dosya['uploaded_at']; ?>)
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <br>
    <a href="dashboard.php" class="btn btn-secondary">← Geri Dön</a>
  </div>
</body>
</html>
