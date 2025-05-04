<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Költség adatainak bekérése
    $kategoria = $_POST['kategoria'];
    $osszeg = $_POST['osszeg'];
    $datum = $_POST['datum'];
    $megjegyzes = $_POST['megjegyzes'];

    // SQL lekérdezés az adatbázisba történő beszúráshoz
    $sql = "INSERT INTO koltsegek (kategoria, osszeg, datum, megjegyzes) 
            VALUES ('$kategoria', '$osszeg', '$datum', '$megjegyzes')";

    // Végrehajtjuk a lekérdezést
    if ($conn->query($sql) === TRUE) {
        header("Location: koltsegek.php"); // Visszairányítjuk a felhasználót a költségek oldalra
    } else {
        echo "Hiba: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
