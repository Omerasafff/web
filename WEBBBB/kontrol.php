<?php
session_start();

$kullanici = $_POST['kullanici'];
$sifre = $_POST['sifre'];

$parca = explode("@", $kullanici);
$kisa_kullanici = $parca[0];

$dogru_kullanici = "b241210096@sakarya.edu.tr";
$dogru_sifre = "15221538232Omer.";

if ($kullanici == $dogru_kullanici && $sifre == $dogru_sifre) {
    $_SESSION['giris'] = true;
    $_SESSION['kullanici'] = $kisa_kullanici;
    echo "Hoşgeldiniz, " . htmlspecialchars($kisa_kullanici) . "!";
} else {
    echo "Kullanıcı adı veya şifre hatalı.";
}
?>
