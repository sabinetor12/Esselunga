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
      <li class="nav-item active">
        <a class="nav-link" href="home.php"> Home</a>
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
        <a class="nav-link" href="Bevande.php">Bevande<span class="sr-only">(current)</span></a>
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
    <?php

require "../connect.php";

$mysqli = connect();
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
session_start();

$query = "SELECT count(id_prodotto) as conta,id_prodotto,id_login
FROM esselungadb.carrello
where id_login =" . $_SESSION["id_utente"] . " group by id_login,id_prodotto";

$result = $mysqli->query($query);
if ($result != false && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $query = "update munit set quantità=quantità-" . $row["conta"] . " where id_prodotto=" . $row["id_prodotto"];
        $mysqli->query($query) or die($mysqli->error);
    }
    $query = "delete from carrello where id_login=" . $_SESSION["id_utente"];
    $result = $mysqli->query($query);
//acquisto riuscito
}
else {
//acquisto fallito
}

?>
</body>
</html>