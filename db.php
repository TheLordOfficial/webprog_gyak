<?php
$servername = "localhost";
$username = "root"; // Alapértelmezett XAMPP felhasználónév
$password = ""; // Alapértelmezett XAMPP jelszó (ha nem állítottad be másképp)
$dbname = "koltsegek_db"; // Az adatbázis neve

// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolódás ellenőrzése
if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}
?>