<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../css/styles.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2? family = Source + Code + Pro: wght @ 200 & display = swap " rel=" stylesheet ">

</head>

<body class="sfondobody">
  <div class="pacini-titolo">
    <h1 class="h1-titolo">ESSELUNGA</h1>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img src="../Images/esselunga.png" height="50px">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="home.php"> Home <span class="sr-only">(current)</span></a>
        <li class="nav-item">
          <a class="nav-link" href="Colazione.php">Colazione</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="Pasta.php">Pasta</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="Salumeria.php">Salumeria</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="Frutta%20e%20verdura.php">Frutta e verdura</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="Dolci.php">Dolci</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="Bevande.php">Bevande</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="Casa.php">Casa</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="Scuola.php">Scuola</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="Storia.php">La nostra storia</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link">Carrello</a>
        </li>
      </ul>
    </div>
  </nav>

  <br>
  <center>
    <?php

    require "../connect.php";

    $mysqli = connect();
    if ($mysqli->connect_error) {
      die("Connection failed: " . $mysqli->connect_error);
    }
    session_start();
    if (isset($_POST["id_prodotto"])) {
      $query = "delete from carrello where id_login=" . $_SESSION["id_utente"] . " and id_prodotto=" . $_POST["id_prodotto"] . "";
      $result = $mysqli->query($query)
        or die("echo '<script type='text/javascript'>alert('errore');</script>';");
    }

    $query = "SELECT count(c.id_prodotto) as conta,c.id_prodotto,p.immagine,p.descrizione,mu.costo_euro FROM Prodotti p join Reparto r on p.idReparto=r.id 
              join munit mu on p.id=mu.id_prodotto join carrello c on c.id_prodotto=p.id where c.id_login=" . $_SESSION["id_utente"] . " group by c.id_login,c.id_prodotto";


    $result = $mysqli->query($query);

    $_SESSION["carrello"] = $result;

    if ($result != false && $result->num_rows > 0) {
      // output data of each row
      echo "<div class='container'>
    <div class='row'>";
      while ($row = $result->fetch_assoc()) {

        echo "<form method='post' action='./Carrello.php'>
    <div class='col-sm-6 col-md-4'>
    <div class='card  cartepazzesgravate' style='width: 18rem;'>
       <img src='" . $row["immagine"] . "' height=150px class='card-img-top' alt='...'>
         <div class='card-body'>
         <h5 class='card-title'>" . $row["descrizione"] . "</h5>
         <p class='card-text'>prezzo unitario: " . $row["costo_euro"] . "€ 
         <br>quantità: " . $row["conta"] . "</p>
         <button class='btn btn-primary' type='submit'>Rimuovi!</button>
        </div>
     </div>
   </div>
   <input type='hidden' name='id_prodotto' value='" . $row["id_prodotto"] . "'>
   </form>";
      }
    } else {
      echo "<h1>Non ci sono prodotti nel carrello</h1>";
    }

    ?>
    </center>
    <br>
    <center>
    <div>

      <form method='post' action='./Acquisto.php'>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
          Acquista!
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Acquisto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?php

                $query = "SELECT count(c.id_prodotto) as conta,c.id_prodotto,sum(mu.costo_euro) as costoTot FROM Prodotti p join Reparto r on p.idReparto=r.id 
                          join munit mu on p.id=mu.id_prodotto join carrello c on c.id_prodotto=p.id 
                          where c.id_login=" . $_SESSION['id_utente'] . " group by c.id_login";
                $result = $mysqli->query($query) or die($mysqli->error);
                while ($row = $result->fetch_assoc()) {
                  echo "<p>Costo tolale: " . $row["costoTot"] . "</p>";
                }
                ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">chiudi</button>
                <button type="submit" class="btn btn-primary">acquista</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    </center>
</body>

</html>