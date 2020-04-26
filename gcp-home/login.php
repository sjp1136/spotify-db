<?php
  global $db;
  require('connectdb.php');
  require('sql.php');

  session_start();

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    // echo '<pre>'; 
    // print_r($_SESSION['username']);
    // echo '</pre>';
    header('Location: index.php');
  } 

  if(isset($_POST["username"])){

    $uname = $_POST['username'];
    $password = $_POST["password"];

    // $query = "select * from registered_users where username= :username AND password = :password";
    $query = "select * from registered_users where username= :username";

    $statement = $db->prepare($query);
    $statement->bindValue(':username', $uname);
    // $statement->bindValue(':password', $password);

    $statement->execute();
    $result = $statement->fetchAll(); //fetch()
    $statement->closeCursor();

    if(!empty($result)){

      if(password_verify($password, $result[0]['password'])){
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $uname; 
        header('Location: index.php');
        // exit;
      }
      else{
        echo "<div class='alert alert-danger' role='alert'>
        Login Fail!</div>" ;      }
    }
    else{
      echo "<div class='alert alert-danger' role='alert'>
      Login Fail!</div>" ;      }

  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">      
  <title>Our Login Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link type="text/css" rel="stylesheet" href="/stylesheets/index.css" />

</head>

<body>
<!-- Navbar/Register -->  
<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand">Welcome to Spotify4u</a>
  <form class="form-inline">
    <a class="btn btn-outline-success my-2 my-sm-0" href="register.php">CLICK TO REGISTER</a>
  </form>
</nav>

<!-- Navbar/Register -->  
<form action="/" method="post">
  <div class="">
    <div class="form-group">
      <label for="uname">Username</label>
      <input class="form-control" type="text" placeholder="Enter Username" name="username" required>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input class="form-control" type="password" placeholder="Enter Password" name="password" required>
    </div>
    <button type="submit" name = 'submit' value="LOGIN" class="btn btn-primary">Submit</button>
  </div>
</form>   

<!-- <div class="container">
  <label for="uname"><b>Not registered??</b></label>   
  <a href="register.php">REGISTER</a>
</div> -->


<!-- Carousel -->
<!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleInd" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://i.imgur.com/YsbWg4F.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://i.imgur.com/RvvcYYM.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://i.imgur.com/GRZnXvd.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="/#" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="/#2" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> -->

</body>

</html>