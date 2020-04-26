
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Yubin Kang, Timothy Kim, Jerry Lu, Sung Joon Park">
  <meta name="description" content="PHP Database for Spotify Friendship">      
  <title>Title</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
<div class="container">
<h1>Spotify4U</h1>
<?php

session_start();

// Login stuff
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  echo "Welcome to Spotify4U, " . $_SESSION['username'] . "!";
} else {
  echo "Please log in first to see this page.";
}


echo "Hello World" ;
require("connectdb.php");
require("sql.php");

$userID = "1";

$results = getPlaylists($userID, NULL);
print_r($results);

?>

<a href='logout.php'>Click here to log out</a>
    
</div>    
</body>
</html>