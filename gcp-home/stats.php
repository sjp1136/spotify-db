<?php

session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Yubin Kang, Timothy Kim, Jerry Lu, Sung Joon Park">
  <meta name="description" content="PHP Database for Spotify Friendship">      
  <!-- <title>Title</title> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link type="text/css" rel="stylesheet" href="/stylesheets/index.css" />

</head>

<body>

<!-- Navbar -->
<nav class="navbar fixed-top navbar-dark bg-dark">
  <a class="navbar-brand">Spotify4u - Statistics</a>
  <form class="form-inline">
    <a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">LOGOUT</a>
  </form>
</nav>


<div class="container">
<?php
global $db;
require("connectdb.php");
require("sql.php");

// Login stuff
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
}
else{
  echo '<script> window.location.href="/" </script>'; 
  exit;
}

// Change Username

if(isset($_POST["username"])){
  $userID = $_SESSION['userID'];
  $username = $_POST['username'];

  $query = "update registered_users set username = :username where usernameID = :userID";

  $statement = $db->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->bindValue(':userID', (int)$userID, PDO::PARAM_INT);

  $result = $statement->execute();

  if($statement->rowCount() != 0){
    echo "<div class='alert alert-success movedown2' role='alert'>
    You have changed your username!</div>" ;
    $_SESSION['username'] = $username;

  }
  else{
      echo "<div class='alert alert-danger movedown2' role='alert'>
      Error! That username is invalid!</div>";    
  }
  // $result = $statement->fetchAll(); //fetch()
  $statement->closeCursor();
}

?>
</div>  




<div class="jumbotron jumbotron-fluid movedown">
<div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">
  
  <!-- Your Stats -->
  <div class="container" id ="stats">
      <?php
        $uname = $_SESSION['username'];
        echo "<h1>HELLO, " .$uname. "!</h1>"; 
      ?>
      <h1 class="display-4">Your Stats</h1>

      <div class="form-group">
      <p class="lead">Song Name</p>
        <input type="text" class="form-control" name="name"  />     
        Artist Name
        <input type="text" class="form-control" name="major" />     
              <!-- add required if wanted -->
    </div>  

      <br/>
      <?php 
      // $userID = $_SESSION['userID'];
      // $results = getStats($userID);
      // print_r($results[0])
      ?>
  </div>
  <form method = "post" action = "">
      <div class="form-group">
          <label for="">Change Username</label>
          <input class="form-control" type="text" placeholder="Enter new username" name="username" required>
        </div>
        <button type="submit" name = 'submit' value="LOGIN" class="btn btn-primary">Submit</button>
    </form>
  <a href="index.php">Go back</a>
  </div>
  </div>

</div>

</body>
</html>