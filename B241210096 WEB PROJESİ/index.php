<?php
ini_set('display_errors', 1); // Geçici olarak hataları görmek için açabilirsiniz
ini_set('display_startup_errors', 1); // Geçici olarak hataları görmek için açabilirsiniz
error_reporting(E_ALL); // Geçici olarak hataları görmek için açabilirsiniz

session_start();

$kullanici = $_POST['kullanici'] ?? ''; // POST gelmediğinde hata olmaması için
$sifre = $_POST['sifre'] ?? ''; // POST gelmediğinde hata olmaması için

$hata_mesaji = ''; // Hata mesajı değişkenini başlat

// POST isteği gelip gelmediğini kontrol et
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $parca = explode("@", $kullanici);
    $kisa_kullanici = $parca[0];

    // NOT: Bu kısım hala sabit kullanıcı adı ve şifreyi kullanıyor.
    // Gerçek bir uygulamada burası veritabanı sorgusu olmalıdır.
    $dogru_kullanici = "b241210096@sakarya.edu.tr";
    $dogru_sifre = "15221538232Omer.";

    if ($kullanici === $dogru_kullanici && $sifre === $dogru_sifre) {
        $_SESSION['giris'] = true;
        $_SESSION['kullanici'] = $kisa_kullanici;
        // Başarılı girişte index.html sayfasına yönlendir
        header("Location: index.html");
        exit(); // Yönlendirmeden sonra kodun devam etmesini önler
    } else {
        // Hatalı giriş durumunda bir hata mesajı sesi ayarlayabiliriz.
        // Bu mesaj HTML içinde gösterilecektir.
        $hata_mesaji = "Kullanıcı adı veya şifre hatalı.";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Login Sayfası</title>
  <style>
    body { font-family: Arial; display: flex; justify-content: center; align-items: center; height: 100vh; }
    form { border: 1px solid #ccc; padding: 30px; border-radius: 10px; background-color: #f4f4f4; }
    input { display: block; width: 100%; margin-bottom: 10px; padding: 8px; }
  </style>
</head>
<body>
  <form method="POST" action="index.php" onsubmit="return validateForm()">
    <h2>Login</h2>
    <?php
    // Eğer bir hata mesajı varsa, onu göster
    if (!empty($hata_mesaji)) { // Hata mesajı boş değilse göster
        echo '<p style="color: red;">' . htmlspecialchars($hata_mesaji) . '</p>';
    }
    ?>
    <label for="kullanici">Kullanıcı Adı (Mail):</label>
    <input type="text" id="kullanici" name="kullanici" required value="<?php echo htmlspecialchars($kullanici); ?>"> <!-- Hata durumunda değeri koru -->

    <label for="sifre">Şifre:</label>
    <input type="password" id="sifre" name="sifre" required>

    <input type="submit" value="Giriş Yap">
  </form>

  <script>
    function validateForm() {
      const kullaniciInput = document.getElementById('kullanici');
      const sifreInput = document.getElementById('sifre');
      const kullanici = kullaniciInput.value.trim(); // Boşlukları temizle
      const sifre = sifreInput.value.trim(); // Boşlukları temizle


      if (!kullanici || !sifre) {
        alert("Tüm alanları doldurun.");
        return false;
      }

      const emailPattern = /^[a-zA-Z0-9._%+-]+@sakarya\.edu\.tr$/;
      if (!emailPattern.test(kullanici)) {
        alert("Geçerli bir Sakarya mail adresi girin.");
        return false;
      }

      return true;
    }
  </script>
</body>
</html>