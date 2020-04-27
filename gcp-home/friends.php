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
  <a class="navbar-brand">Spotify4u - Friends</a>
  <form class="form-inline">
    <a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">LOGOUT</a>
  </form>
</nav>


<div class="container">
<?php

session_start();

// Login stuff
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  echo '<pre><h1>'; 
  print_r($_SESSION['username']);
  echo '</h1></pre>';
  // echo "<h1>Welcome to Spotify4U, " . $_SESSION['username'] . "!</h1>";
}
else{
  // header('Location: login.php');
  echo '<script> window.location.href="/" </script>'; 

  exit;
}


// echo "Hello World" ;
require("connectdb.php");
require("sql.php");
?>
</div>  


<div class="jumbotron jumbotron-fluid movedown">
<div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">

  <!-- Your Friends -->
  <div class="container" id ="friends">
    <form action="index.php" method="post">
    <h1 class="display-4">Your Friends</h1>
      <?php
      // $userID = $_SESSION['usernameID'];
      // $results = getFriends($userID);
      ?>
    </form> 
    <table>
      <tr>
        <td>Name</td>
      </tr>
      <?php
      global $db;
      $userID = $_SESSION['userID'];

      $query = "select * from registered_users";
      $statement = $db->prepare($query);
      $statement->execute();
  
      $results = $statement->fetchAll();

      
      foreach($results as $row) {
        echo "<tr><td>" . $row['username'] . "</td></tr>";
      }
      ?>
    </table>
<a href="index.php">Go back</a>
  <!-- </div> -->
  </div>

</div>

</body>
</html>