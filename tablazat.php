<?php
// Kapcsolódás az adatbázishoz
include('db.php');

// Alapértelmezett rendezési beállítások
$order_by = "datum";
$order_direction = "DESC"; // Csökkenő sorrend alapértelmezetten

// Ha a felhasználó módosítja a rendezési szempontot
if (isset($_POST['order_by']) && isset($_POST['order_direction'])) {
    $order_by = $_POST['order_by'];
    $order_direction = $_POST['order_direction'];
}

// Ellenőrizzük, hogy van-e sikeres módosítás vagy törlés
if (isset($_GET['update_success']) && $_GET['update_success'] == 'true') {
    echo '<div class="alert alert-success">A módosítás sikeres volt!</div>';
}

if (isset($_GET['delete_success']) && $_GET['delete_success'] == 'true') {
    echo '<div class="alert alert-success">A törlés sikeres volt!</div>';
}

// SQL lekérdezés a költségek lekérésére a kiválasztott rendezés szerint
$sql = "SELECT * FROM koltsegek ORDER BY $order_by $order_direction";
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
          <li class="nav-item"><a class="nav-link active" aria-current="page" href="tablazat.php">Táblázat</a></li>
          <li class="nav-item"><a class="nav-link" href="koltsegek.php">Költségek</a></li>
          <li class="nav-item"><a class="nav-link" href="kapcsolat.html">Kapcsolat</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Tartalom -->
  <div class="container mt-4">
    <h1>Havi Kiadások</h1>

    <!-- Rendezés lehetősége -->
    <form method="POST" class="mb-4">
      <div class="row align-items-end g-3">
        <div class="col-md-4">
          <label for="order_by" class="form-label">Rendezés alapja</label>
          <select id="order_by" name="order_by" class="form-select">
            <option value="datum" <?php if ($order_by == 'datum') echo 'selected'; ?>>Dátum</option>
            <option value="kategoria" <?php if ($order_by == 'kategoria') echo 'selected'; ?>>Kategória</option>
            <option value="osszeg" <?php if ($order_by == 'osszeg') echo 'selected'; ?>>Összeg</option>
          </select>
        </div>
        <div class="col-md-4">
          <label for="order_direction" class="form-label">Rendezés iránya</label>
          <select id="order_direction" name="order_direction" class="form-select">
            <option value="ASC" <?php if ($order_direction == 'ASC') echo 'selected'; ?>>Növekvő</option>
            <option value="DESC" <?php if ($order_direction == 'DESC') echo 'selected'; ?>>Csökkenő</option>
          </select>
        </div>
        <div class="col-md-4 d-grid">
          <button type="submit" class="btn btn-primary">Rendezés alkalmazása</button>
        </div>
      </div>
    </form>

    <!-- Költségek táblázata -->
    <table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th> <!-- Számozás oszlop -->
      <th>Dátum</th>
      <th>Kategória</th>
      <th>Összeg</th>
      <th>Leírás</th>
      <th>Akciók</th> <!-- Egyesített oszlop -->
    </tr>
  </thead>
  <tbody>
    <?php
    $counter = 1; // Számláló inicializálása
    // Ha van találat
    if ($result->num_rows > 0) {
        // Minden sor végigjárása és megjelenítése
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $counter++ . "</td> <!-- Számozás -->
                    <td>" . $row['datum'] . "</td>
                    <td>" . $row['kategoria'] . "</td>
                    <td>" . $row['osszeg'] . " Ft</td>
                    <td>" . $row['megjegyzes'] . "</td>
                    <td>
                      <div class='d-flex justify-content-around'>
                        <!-- Módosítás gomb -->
                        <a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Módosítás</a>
                        <!-- Törlés gomb -->
                        <a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Törlés</a>
                      </div>
                    </td>
                  </tr>";
        }
    } else {
        // Ha nincs adat
        echo "<tr><td colspan='6'>Nincsenek rögzített költségek.</td></tr>";
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
    <div class="card bg-light mb-4 shadow-sm border-primary">
  <div class="card-body text-center">
    <h3 class="card-title text-primary">Összes költség</h3>
    <p class="display-6 fw-semibold text-dark"><?php echo number_format($total_row['total'], 0, ',', ' '); ?> Ft</p>
  </div>
</div>

  <footer class="bg-dark text-light text-center p-4 mt-5">
    <p class="mb-0">© 2025 Költségnyilvántartó. Minden jog fenntartva.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
</body>
</html>

<?php
// Kapcsolat lezárása
$conn->close();
?>
