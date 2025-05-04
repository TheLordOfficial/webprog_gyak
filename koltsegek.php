<?php
include('db.php');

// Költségek lekérése az adatbázisból, csak az utolsó 5 legfrissebb
$sql = "SELECT * FROM koltsegek ORDER BY datum DESC LIMIT 5";
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
    <h1 class="text-center mb-4">Költségnyilvántartás</h1>
    <p class="text-center">Itt rögzítheted és megtekintheted a frissen hozzáadott költségeidet.</p>

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

    <div class="container mt-4 mb-4">
    <div class="text-center mt-4 mb-4">
        <a href="tablazat.php" class="btn btn-secondary">További költségek megtekintése</a>
    </div>
    <div class="text-center mb-4">
        <a href="index.html" class="btn btn-secondary">Vissza a kezdőlapra</a>
    </div>
  </div>

<div class="container mt-5">
    <h2 class="text-center mb-4">Elérhető Kategóriák</h2>
    <div class="row g-4 text-center">
        <div class="col-md-4">
            <div class="card shadow-sm animate__animated animate__fadeIn">
                <img src="images/food.jpg" alt="Élelmiszer" class="card-img-top rounded-top">
                <div class="card-body">
                    <h5 class="card-title">Élelmiszer</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm animate__animated animate__fadeIn animate__delay-1s">
                <img src="images/transport.jpg" alt="Közlekedés" class="card-img-top rounded-top">
                <div class="card-body">
                    <h5 class="card-title">Közlekedés</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm animate__animated animate__fadeIn animate__delay-2s">
                <img src="images/entertainment.jpg" alt="Szórakozás" class="card-img-top rounded-top">
                <div class="card-body">
                    <h5 class="card-title">Szórakozás</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 text-center mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm animate__animated animate__fadeIn animate__delay-3s">
                <img src="images/health.jpg" alt="Egészség" class="card-img-top rounded-top">
                <div class="card-body">
                    <h5 class="card-title">Egészség</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm animate__animated animate__fadeIn animate__delay-4s">
                <img src="images/education.jpg" alt="Oktatás" class="card-img-top rounded-top">
                <div class="card-body">
                    <h5 class="card-title">Oktatás</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm animate__animated animate__fadeIn animate__delay-5s">
                <img src="images/other.jpg" alt="Egyéb" class="card-img-top rounded-top">
                <div class="card-body">
                    <h5 class="card-title">Egyéb</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Footer -->
  <footer class="bg-dark text-light text-center p-4 mt-5">
    <p class="mb-0">© 2025 Költségnyilvántartó. Minden jog fenntartva.</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
