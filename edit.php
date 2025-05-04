<?php
include('db.php');

// Ellenőrizzük, hogy van-e ID a URL-ben
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Az adat lekérdezése
    $sql = "SELECT * FROM koltsegek WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Nincs ilyen rekord.");
    }
} else {
    die("Nincs ID megadva.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ha POST kérés érkezik, frissítjük az adatokat
    $datum = $_POST['datum'];
    $kategoria = $_POST['kategoria'];
    $osszeg = $_POST['osszeg'];
    $megjegyzes = $_POST['megjegyzes'];

    // Az adatfrissítés SQL lekérdezése
    $sql_update = "UPDATE koltsegek SET datum = ?, kategoria = ?, osszeg = ?, megjegyzes = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssdsi", $datum, $kategoria, $osszeg, $megjegyzes, $id);

    if ($stmt_update->execute()) {
        // Ha sikeres a módosítás, visszairányítjuk a táblázathoz
        header("Location: tablazat.php?update_success=true");
        exit();
    } else {
        // Hiba esetén visszajelzés
        echo "Hiba történt a módosítás során.";
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Költség Módosítása</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<!-- Navigáció -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fs-5" href="index.html">Költségnyilvántartó</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto fs-6">
                <li class="nav-item"><a class="nav-link" href="index.html">Kezdőlap</a></li>
                <li class="nav-item"><a class="nav-link" href="rolunk.html">Rólunk</a></li>
                <li class="nav-item"><a class="nav-link" href="tablazat.php">Táblázat</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="koltsegek.php">Költségek</a></li>
                <li class="nav-item"><a class="nav-link" href="kapcsolat.html">Kapcsolat</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center mb-4">Költség Módosítása</h1>
    <p class="text-center">Itt módosíthatod a kiválasztott költség adatokat.</p>

    <form method="POST">
        <div class="mb-3">
            <label for="kategoria" class="form-label">Kategória</label>
            <input type="text" class="form-control" id="kategoria" name="kategoria" value="<?php echo $row['kategoria']; ?>" required />
        </div>
        <div class="mb-3">
            <label for="osszeg" class="form-label">Összeg</label>
            <input type="number" class="form-control" id="osszeg" name="osszeg" value="<?php echo $row['osszeg']; ?>" required />
        </div>
        <div class="mb-3">
            <label for="datum" class="form-label">Dátum</label>
            <input type="date" class="form-control" id="datum" name="datum" value="<?php echo $row['datum']; ?>" required />
        </div>
        <div class="mb-3">
            <label for="megjegyzes" class="form-label">Megjegyzés</label>
            <textarea class="form-control" id="megjegyzes" name="megjegyzes" rows="3"><?php echo $row['megjegyzes']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Módosítás mentése</button>
    </form>
</div>

<footer class="bg-dark text-light text-center p-4 mt-5">
    <p class="mb-0">© 2025 Költségnyilvántartó. Minden jog fenntartva.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
// Kapcsolat lezárása
$conn->close();
?>
