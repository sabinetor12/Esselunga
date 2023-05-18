<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
     <meta charset="UTF-8">
  <meta http-equity="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width-device-width,initial-scale=1,0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    
    <link rel = "preconnect" href = "https://fonts.gstatic.com">
    <link href = "https://fonts.googleapis.com/css2? family = Source + Code + Pro: wght @ 200 & display = swap "rel =" stylesheet ">
    
</head>   
<!--<body style="background-image: url(./Images/sfondoLogin.jpg" > -->
<!-- style="background-image: url(./Images/sfondoLogin.jpg)" -->
  <div class="moving">
  <div class="moving-bg"></div>
</div>

  <section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">
            <form action="index.php " method="POST">
              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <div class="form-outline form-white mb-4">
                <input name="mail" type="email" id="typeEmailX" class="form-control form-control-lg"/>
                <label class="form-label" for="typeEmailX">Email</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input name="password" type="password" id="typePasswordX" class="form-control form-control-lg" />
                <label class="form-label" for="typePasswordX">Password</label>
              </div>

              <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
            </div>


            </form>
            

            
            <div>
              <p class="mb-0">Don't have an account? <a href="Pages/Signup.php" class="text-white-50 fw-bold">Sign Up</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php

require "connect.php";
if (isset($_POST["mail"]) && isset($_POST["password"])) 
{
  $mysqli = connect();

  $query = "SELECT id FROM login where mail='" . $_POST["mail"] . "' and password='" . $_POST["password"] . "' ";

  $result = $mysqli->query($query) //cambia alert
    or die("echo query fallita ");

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    session_start();
    $_SESSION["id_utente"] = $row["id"];
    header("location:Pages/home.php");
  }
  else { //metti alert bellino

  }

}

?>
  </body>
</html>
