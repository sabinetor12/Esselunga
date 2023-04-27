
<?php
function connect(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "esselungadb";
    // connessione al DBMS
    $mysqli = new mysqli($host, $user, $pass, $db)
        or die("<br>Connessione non riuscita " . $mysqli->connect_error . " " . $mysqli->connect_errno);
    return $mysqli;
}

?>