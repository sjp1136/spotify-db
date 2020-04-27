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
  <a class="navbar-brand">Spotify4u - Songs</a>
  <form class="form-inline">
    <a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">LOGOUT</a>
  </form>
</nav>


<div class="container">
<?php

require("connectdb.php");
require("sql.php");
// Login stuff
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
}
else{
  echo '<script> window.location.href="/" </script>'; 
  exit;
}
?>
</div>  


<div class="jumbotron jumbotron-fluid movedown">
      <?php
      // Add songs
      if(isset($_POST["song"]) && isset($_POST["artist"]) && 
      isset($_POST["songID"]) && isset($_POST["genre"])&& isset($_POST["duration"])){
        // $userID = $_SESSION['userID'];
        $songID = $_POST['songID'];
        $song = $_POST['song'];
        $artist = $_POST['artist'];
        $duration = $_POST['duration'];
        $genre = $_POST['genre'];

        // $query = "insert into friend (userID, friendID) values (:userID, :friendID)";
        $query = "insert into song VALUES (:songID, :duration, :artist, :genre, :song, 10);";

        $statement = $db->prepare($query);
        $statement->bindValue(':songID', (int)$songID, PDO::PARAM_INT);
        $statement->bindValue(':song', $song);
        $statement->bindValue(':artist', $artist);
        $statement->bindValue(':duration', (int)$duration, PDO::PARAM_INT);
        $statement->bindValue(':genre', $genre);

        $result = $statement->execute();


        if($statement->rowCount() != 0){
          echo "<div class='alert alert-success movedown2' role='alert'>
          You have added a song!</div>" ;
        }
        else{
            echo "<div class='alert alert-danger movedown2' role='alert'>
            Error! Could not add song!</div>";    
        }
        $statement->closeCursor();
      }

      // delete songs
      if(isset($_POST["songID2"])){
        // $userID = $_SESSION['userID'];
        $songID = $_POST['songID2'];

        // $query = "insert into friend (userID, friendID) values (:userID, :friendID)";
        $query = "delete from song where song.songID = :songID";

        $statement = $db->prepare($query);
        $statement->bindValue(':songID', (int)$songID, PDO::PARAM_INT);

        $result = $statement->execute();

        if($statement->rowCount() != 0){
          echo "<div class='alert alert-success movedown2' role='alert'>
          You have removed a song!</div>" ;
        }
        else{
            echo "<div class='alert alert-danger movedown2' role='alert'>
            Error! Could not remove song!</div>";    
        }
        $statement->closeCursor();
      }
    ?>
  <!-- Your Songs -->
  <div class="container" id ="songs">
    <a href="index.php">Go back</a>

    <form action="" method="post">
    <h1 class="display-4">Add Songs</h1>
      <div class="form-group">
      <p class="lead">SongID</p>
        <input type="text" class="form-control" name="songID" required/>    
      <p class="lead">Song Name</p>
        <input type="text" class="form-control" name="song" required/>     
        <p class="lead">Artist Name</p>
        <input type="text" class="form-control" name="artist" required/>    
        <p class="lead">Genre</p>
        <input type="text" class="form-control" name="genre" required/>   
        <p class="lead">Duration (seconds)</p>
        <input type="text" class="form-control" name="duration" required/>    
      </div>  
      <button type="submit" value="Drop" class="btn btn-primary" name="button">Insert</button>
      <br/>
    </form> 

    <hr>

    <form action="" method="post">
    <h1 class="display-4">Delete Songs</h1>
      <div class="form-group">
      <p class="lead">SongID</p>
        <input type="text" class="form-control" name="songID2" required/> 
      </div>  
      <button type="submit" value="Drop" class="btn btn-primary" name="button">Delete</button>
      <br/>
    </form> 

    <table>

    <?php
      $results = getSongs();
      foreach($results as $row) {
        echo "<tr><td>"  .$row['songID']." ".$row['title']." by ".$row['artist']."</td></tr>";
      }
    ?>
  </table>

      </div>
  </div>


</body>
</html>