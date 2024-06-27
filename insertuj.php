<?php
ini_set('display_errors', '1');
include 'konekcija.php';
// Ručno definirajte korisničko ime i lozinku
$admin_username = 'marino';
$admin_password = 'marino123';
// Hashirajte lozinku prije umetanja u bazu
$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

// Izvršite umetanje u bazu
$sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
$pokreni = $konekt->prepare($sql);
$pokreni->bind_param("ss", $admin_username, $hashed_password);
$pokreni -> execute();
?>
