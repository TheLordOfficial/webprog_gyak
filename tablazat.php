<?php
// Kapcsolódás az adatbázishoz
include('db.php');

// SQL lekérdezés a költségek lekérésére
$sql = "SELECT * FROM koltsegek";
$result = $conn->query($sql);

// SQL lekérdezés az egyes kategóriák összesített költségeinek lekérésére
$sql_category = "SELECT kategoria, SUM(osszeg) AS total FROM koltsegek GROUP BY kategoria";
$category_result = $conn->query($sql_category);

// SQL lekérdezés az összes költség összegzésére
$sql_total = "SELECT SUM(osszeg) AS total FROM koltsegek";
$total_result = $conn->query($sql_total);
$total_row = $total_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Táblázat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

  <!-- Navigáció -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html">Költségnyilvántartó</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="index.html">Kezdőlap</a></li>
            <li class="nav-item"><a class="nav-link" href="rolunk.html">Rólunk</a></li>
            <li class="nav-item"><a class="nav-link" href="tablazat.php">Táblázat</a></li>
            <li class="nav-item"><a class="nav-link" href="koltsegek.php">Költségek</a></li>
            <li class="nav-item"><a class="nav-link" href="kapcsolat.html">Kapcsolat</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Tartalom -->
  <div class="container mt-4">
    <h1>Havi Kiadások</h1>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Dátum</th>
          <th>Kategória</th>
          <th>Összeg</th>
          <th>Leírás</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Ha van találat
        if ($result->num_rows > 0) {
            // Minden sor végigjárása és megjelenítése
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['datum'] . "</td>
                        <td>" . $row['kategoria'] . "</td>
                        <td>" . $row['osszeg'] . " Ft</td>
                        <td>" . $row['megjegyzes'] . "</td>
                      </tr>";
            }
        } else {
            // Ha nincs adat
            echo "<tr><td colspan='7'>Nincsenek rögzített költségek.</td></tr>";
        }
        ?>
      </tbody>
    </table>

    <!-- Kategóriák összesítése -->
    <h2>Kategóriák szerint</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Kategória</th>
          <th>Összeg</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Kategóriák összesített költségeinek kiírása
        if ($category_result->num_rows > 0) {
            while ($category = $category_result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $category['kategoria'] . "</td>
                        <td>" . $category['total'] . " Ft</td>
                      </tr>";
            }
        }
        ?>
      </tbody>
    </table>

    <!-- Összes költség -->
    <h3>Összes költség</h3>
    <p><?php echo $total_row['total']; ?> Ft</p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
</body>
</html>

<?php
// Kapcsolat lezárása
$conn->close();
?>
