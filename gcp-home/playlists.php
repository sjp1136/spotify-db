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
  <a class="navbar-brand">Spotify4u - Playlists</a>
  <form class="form-inline">
    <a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">LOGOUT</a>
  </form>
</nav>


<div class="container">
<?php

// Login stuff
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  echo '<pre><h1>'; 
  print_r($_SESSION['username']);
  echo '</h1></pre>';
  // echo "<h1>Welcome to Spotify4U, " . $_SESSION['username'] . "!</h1>";
}


// echo "Hello World" ;
require("connectdb.php");
require("sql.php");


// echo'<div class="card" style="width: 18rem;">
//   <img src="..." class="card-img-top" alt="...">
//   <div class="card-body">
//     <h5 class="card-title">Card title</h5>
//     <p class="card-text">'. $results .
//     '</p>
//     <a href="#" class="btn btn-primary">Go somewhere</a>
//   </div>
// </div>';
?>
</div>  


<!-- Potential scrollbar -->
<!-- <div id="list-example" class="list-group movedown">
  <a class="list-group-item list-group-item-action" href="#stats">Your Stats</a>
  <a class="list-group-item list-group-item-action" href="#friends">Your Friends</a>
  <a class="list-group-item list-group-item-action" href="#songs">Your Songs</a>
  <a class="list-group-item list-group-item-action" href="#playlists">Your Playlists</a>
</div> -->

<div class="jumbotron jumbotron-fluid movedown">
<div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">
 
  <!-- Your Playlists -->
  <div class="container" id ="playlists">
    <form action="index.php" method="post">
    <h1 class="display-4">Your Playlists</h1>
      <div class="form-group">
      <p class="lead">Playlist Name</p>
        <input type="text" class="form-control" name="name"  />     
        <p class="lead">Creator Name</p>
        <input type="text" class="form-control" name="major" />    
      </div>  
      <input type="submit" value="Create" class="btn btn-dark" name="db-btn"/>
      <input type="submit" value="Drop" class="btn btn-dark" name="db-btn"/>
      <input type="submit" value="Insert" class="btn btn-dark" name="db-btn"/>

      <br/>

    </form> 
    <table>
      <tr>
        <td>Name</td>
        <td>Length</td>
      </tr>
      <?php
      $userID = $_SESSION['userID'];
      $results = getPlaylists($userID);
      foreach($results as $row) {
        echo "<tr><td><a href='playlist.php?id=" .$row['pID']. "'>" .$row['name']. "</a></td><td>" .$row['numSongs']. "</td></tr>";
      }
      ?>
    </table>
<a href="index.php">Go back</a>
  </div>
  </div>

</div>

</body>
</html>