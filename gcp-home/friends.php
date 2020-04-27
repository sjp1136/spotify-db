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
<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand">Spotify4u - Friends</a>
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
 
// add friends
if(isset($_POST["friendID2"])){
  $userID = $_SESSION['userID'];
  $friendID = $_POST['friendID2'];

  $query = "insert into friend  (userID, friendID) values (:userID, :friendID)";

  // one side
  $statement = $db->prepare($query);
  $statement->bindValue(':userID', (int)$userID, PDO::PARAM_INT);
  $statement->bindValue(':friendID', (int)$friendID, PDO::PARAM_INT);
  $result = $statement->execute();

  // other side
  $statement = $db->prepare($query);
  $statement->bindValue(':friendID', (int)$userID, PDO::PARAM_INT);
  $statement->bindValue(':userID', (int)$friendID, PDO::PARAM_INT);
  $result = $statement->execute();


  if($statement->rowCount() != 0){
    echo "<div class='alert alert-success movedown2' role='alert'>
    You have added a friend!</div>" ;
  }
  else{
      echo "<div class='alert alert-danger movedown2' role='alert'>
      Error! That username does not exists!</div>";    
  }
  // $result = $statement->fetchAll(); //fetch()
  $statement->closeCursor();
}

// delete friends
if(isset($_POST["friendID"])){
  $userID = $_SESSION['userID'];
  $friendID = $_POST['friendID'];
  $query = "delete from friend where friend.userID = :userID and friend.friendID = :friendID";
  $statement = $db->prepare($query);
  $statement->bindValue(':userID', (int)$userID, PDO::PARAM_INT);

  $statement->bindValue(':friendID', (int)$friendID, PDO::PARAM_INT);

  $result = $statement->execute();


  if($statement->rowCount() != 0){
    echo "<div class='alert alert-success movedown2' role='alert'>
    You have deleted a friend!</div>" ;
  }
  else{
      echo "<div class='alert alert-danger movedown2' role='alert'>
      Error! That username does not exists!</div>";    
  }
  // $result = $statement->fetchAll(); //fetch()
  $statement->closeCursor();
}

?>
</div>  


<div class="jumbotron jumbotron-fluid">
<a href="index.php">Go back</a>

  <!-- Your Friends -->
  <div class="container" id ="friends">
    <!-- Search Users -->
    <form method = "post" action = "">
      <div class="form-group">
      <h1 class="display-4">Search Users</h1>
          <input class="form-control" type="text" placeholder="Enter username (type '%' for all users)" name="username" required>
        </div>
        <button type="submit" name = 'submit' value="LOGIN" class="btn btn-primary">Submit</button>
    </form>

    <h4 class="">All Users</h1>
    <table>

      <?php
      global $db;
      $userID = $_SESSION['userID'];
      $username = "";

      if(isset($_POST["username"])){
        $username = $_POST["username"];
      }
      $results = searchUsers($username);

      foreach($results as $row) {
        echo "<tr><td>"  .$row['usernameID'].  " " . $row['username'] . "</td></tr>";
      }
      ?>
    </table>
    <hr>

    <!-- Add Friends -->
    <form method = "post" action = "">
      <div class="form-group">
      <h1 class="display-4">Add Friend</h1>
          <input class="form-control" type="text" placeholder="Enter friendID" name="friendID2" required>
        </div>
        <button type="submit" name = 'submit' value="LOGIN" class="btn btn-primary">Submit</button>
    </form>

    <!-- <h4 class="">All Users</h1> -->
    <!-- <table> -->

      <?php
      // global $db;
      // // $userID = $_SESSION['userID'];
      // $results = getUsers($sort);

      // foreach($results as $row) {
      //   echo "<tr><td>"  .$row['usernameID'].  " " . $row['username'] . "</td></tr>";
      // }
      ?>
    <!-- </table> -->

    <!-- <hr> -->

    <!-- Delete/Sort Friends -->
    <form method = "post" action = "">
      <div class="form-group">
          <h1 class="display-4">Delete Friend</h1>
          <input class="form-control" type="text" placeholder="Enter friendID" name="friendID" required>
        </div>
        <button type="submit" name = 'submit' value="LOGIN" class="btn btn-primary">Submit</button>
    </form>

    <form method = "post" action = "">
      <div class="form-group">
          <h1 class="display-4">Sort Friend</h1>
          <input class="form-control" type="text" placeholder="Type 'sortid' to sort by ID or 'sortname' to sort by username" name="sort" required>
      </div>
      <button type="submit" name = 'submit' value="LOGIN" class="btn btn-primary">Sort</button>
    </form>

    <h4 class="">Your Friends</h1>
    <table>

      <?php
      global $db;
      $userID = $_SESSION['userID'];
      $sort = "";

      if(isset($_POST["sort"])){
        $sort = $_POST["sort"];
      }
      $results = getFriends($userID, $sort);
      
      foreach($results as $row) {
        echo "<tr><td>"  .$row['usernameID'].  " " . $row['username'] . "</td></tr>";
      }
      ?>
    </table>
    <!-- <a href="index.php">Go back</a> -->

  </div>

</div>

</body>
</html>