<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel = "preconnect" href = "https://fonts.gstatic.com">
    <link href = "https://fonts.googleapis.com/css2? family = Original + Surfer & display = swap" rel = "foglio di stile">
</head>   
<body class="sfondobody">
    <div class="pacini-titolo"><h1 class="h1-titolo">ESSELUNGA</h1></div>
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
      <li class="nav-item active">
        <a class="nav-link">Frutta e verdura</a>
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
      <li class="nav-item ">
        <a class="nav-link" href="Carrello.php">Carrello</a>
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
  $query = "insert into carrello values (default," . $_POST["id_prodotto"] . "," . $_SESSION["id_utente"] . ")";
  $result = $mysqli->query($query)
    or die("echo '<script type='text/javascript'>alert('errore');</script>';");
}

$query = "SELECT p.id,p.immagine,p.descrizione,mu.costo_euro FROM Prodotti p join Reparto r on p.idReparto=r.id join munit mu on p.id=mu.id_prodotto where r.nome ='frutta e verdura' ";

$result = $mysqli->query($query); //cambia alert

if ($result != false && $result->num_rows > 0) {
  // output data of each row
  echo "<div class='container'>
<div class='row'>";
  while ($row = $result->fetch_assoc()) {
    echo "<form method='post' action='./Frutta%20e%20verdura.php'>
    <div class='col-sm-6 col-md-4'>
    <div class='card  cartepazzesgravate' style='width: 18rem;'>
       <img src='" . $row["immagine"] . "' height=150px class='card-img-top' alt='...'>
         <div class='card-body'>
         <h5 class='card-title'>" . $row["descrizione"] . "</h5>
         <p class='card-text'>prezzo: " . $row["costo_euro"] . "€ </p>
         <button class='btn btn-primary' type='submit'>AGGIUNGI AL CARRELLO!</button>
        </div>
     </div>
   </div>
   <input type='hidden' name='id_prodotto' value='" . $row["id"] . "'>
   </form>";

  }

}
else {
  echo "nulla";
}

?>
</center>
  </div>
</div>
    
    <br>
    <div class="citazione2">
      <hr class="hr-color">
      <em><h3 class="h3-citazione">Se non puoi venire all'esselunga, l'esselunga arriva a casa tua</h3></em>
    </div>
</body>
</html>