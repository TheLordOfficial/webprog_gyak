<?php
include('db.php');

// Költségek lekérése az adatbázisból
$sql = "SELECT * FROM koltsegek ORDER BY datum DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Költségek Nyilvántartása</title>
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
            <li class="nav-item"><a class="nav-link" href="tablazat.html">Táblázat</a></li>
            <li class="nav-item"><a class="nav-link" href="koltsegek.html">Költségek</a></li>
            <li class="nav-item"><a class="nav-link" href="kapcsolat.html">Kapcsolat</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <h1 class="text-center mb-4">Költségnyilvántartás</h1>
    <p class="text-center">Itt rögzítheted és megtekintheted a költségeidet.</p>

    <form action="submit_koltseg.php" method="POST">
      <div class="mb-3">
        <label for="kategoria" class="form-label">Kategória</label>
        <input type="text" class="form-control" id="kategoria" name="kategoria" required />
      </div>
      <div class="mb-3">
        <label for="osszeg" class="form-label">Összeg</label>
        <input type="number" class="form-control" id="osszeg" name="osszeg" required />
      </div>
      <div class="mb-3">
        <label for="datum" class="form-label">Dátum</label>
        <input type="date" class="form-control" id="datum" name="datum" required />
      </div>
      <div class="mb-3">
        <label for="megjegyzes" class="form-label">Megjegyzés</label>
        <textarea class="form-control" id="megjegyzes" name="megjegyzes" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Költség hozzáadása</button>
    </form>

    <h2 class="mt-5">Rögzített Költségek</h2>
    <table class="table table-striped mt-3">
      <thead>
        <tr>
          <th scope="col">Kategória</th>
          <th scope="col">Összeg</th>
          <th scope="col">Dátum</th>
          <th scope="col">Megjegyzés</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['kategoria'] . "</td>";
            echo "<td>" . $row['osszeg'] . " Ft</td>";
            echo "<td>" . $row['datum'] . "</td>";
            echo "<td>" . $row['megjegyzes'] . "</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='4'>Nincsenek költségek</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
