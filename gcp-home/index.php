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
<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand">Welcome to Spotify4u</a>
  <form class="form-inline">
  
    <a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">LOGOUT</a>
  </form>
</nav>

<!-- Potential scrollbar -->
<div id="list-example" class="list-group movedown">
  <a class="list-group-item list-group-item-action" href="#stats">Stats</a>
  <a class="list-group-item list-group-item-action" href="#friends">Friends</a>
  <a class="list-group-item list-group-item-action" href="#songs">Songs</a>
  <a class="list-group-item list-group-item-action" href="#playlists">Playlists</a>
</div>


<div class="container">
<?php
session_start();

// Login stuff
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  echo '<pre>'; 
  print_r($_SESSION['username']);
  echo '</pre>';
  echo '<h1>HELLOOOO' . $_SESSION['username'] .'</h1>';

  // echo "<h1>Welcome to Spotify4U, " . $_SESSION['username'] . "!</h1>";
}
else{
  // header('Location: login.php');
  echo '<script> window.location.href="/" </script>'; 

  exit;
}

echo "Hello World" ;
require("connectdb.php");
require("sql.php");

$userID = "1";

$results = getPlaylists($userID, NULL);

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

<!-- Your Stats -->
<div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">

<div class="jumbotron jumbotron-fluid">
  <div class="container" id ="stats">
    <form action="index.php" method="post">
      <h1 class="display-4">Your Stats</h1>
      <div class="form-group">
      <p class="lead">Song Name</p>
        <input type="text" class="form-control" name="name"  />     
        Artist Name
        <input type="text" class="form-control" name="major" />     
              <!-- add required if wanted -->
      </div>  
      <input type="submit" value="Create" class="btn btn-dark" name="db-btn"/>
      <input type="submit" value="Drop" class="btn btn-dark" name="db-btn"/>
      <input type="submit" value="Insert" class="btn btn-dark" name="db-btn"/>

      <br/>
      <?php echo $msg;  ?>
    </form> 
  </div>

  <!-- Your Friends -->
  <div class="container" id ="friends">
    <form action="index.php" method="post">
      <h1>Your Friends</h1>
      <div class="form-group">
        Friend Name
        <input type="text" class="form-control" name="name"  />     
      </div>  
      <input type="submit" value="Create" class="btn btn-dark" name="db-btn"/>
      <input type="submit" value="Drop" class="btn btn-dark" name="db-btn"/>
      <input type="submit" value="Insert" class="btn btn-dark" name="db-btn"/>

      <br/>
      <?php echo $msg;  ?>
    </form> 
  </div>

  <!-- Your Songs -->
  <div class="container" id ="songs">
    <form action="index.php" method="post">
      <h1>Your Songs</h1>
      <div class="form-group">
        Song Name
        <input type="text" class="form-control" name="name"  />     
        Artist Name
        <input type="text" class="form-control" name="major" />     
      </div>  
      <input type="submit" value="Create" class="btn btn-dark" name="db-btn"/>
      <input type="submit" value="Drop" class="btn btn-dark" name="db-btn"/>
      <input type="submit" value="Insert" class="btn btn-dark" name="db-btn"/>

      <br/>
      <?php echo $msg;  ?>
    </form> 
  </div>

  <!-- Your Playlists -->
  <div class="container" id ="playlists">
    <form action="index.php" method="post">
      <h1>Your Playlists</h1>
      <div class="form-group">
        Playlist Name
        <input type="text" class="form-control" name="name"  />     
        Creator Name
        <input type="text" class="form-control" name="major" />    
      </div>  
      <input type="submit" value="Create" class="btn btn-dark" name="db-btn"/>
      <input type="submit" value="Drop" class="btn btn-dark" name="db-btn"/>
      <input type="submit" value="Insert" class="btn btn-dark" name="db-btn"/>

      <br/>
      <?php echo $msg;  ?>
    </form> 
  </div>
  </div>

</div>

</body>
</html>