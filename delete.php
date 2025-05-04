<?php
// Kapcsolódás az adatbázishoz
include('db.php');

// Ellenőrizzük, hogy van-e ID a URL-ben
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Az adat törlése az adatbázisból
    $sql = "DELETE FROM koltsegek WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Törlés sikeres, visszairányítjuk a felhasználót a táblázathoz
        header("Location: tablazat.php?delete_success=true");
        exit();
    } else {
        // Hiba történt a törlés során
        echo "Hiba történt a törlés közben.";
    }
} else {
    die("Nincs ID megadva.");
}

?>

<?php
// Kapcsolat lezárása
$conn->close();
?>
