<?php
  global $db;

  require('connectdb.php');
  require('sql.php');

  //  Create table id (int, primary), user (varchar, 50), pass (varchar, 50)
  if(isset($_POST["username2"])){
    $uname = $_POST['username2'];
    $password = $_POST["password2"];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    // echo "<h1>".$hash."</h1>";

    $query = "insert into registered_users  (username, password) values (:username, :password)";


    $statement = $db->prepare($query);
    $statement->bindValue(':username', $uname);
    $statement->bindValue(':password', $hash);

    $result = $statement->execute();

    $statement->closeCursor();

    if($result){
        echo "<div class='alert alert-success' role='alert'>
        You have successfully created your account!</div>" ;
    }
    else{
        echo "<div class='alert alert-danger' role='alert'>
        Error! That username already exists!</div>";    
    }
}
?>

<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Yubin Kang, Timothy Kim, Jerry Lu, Sung Joon Park">
  <meta name="description" content="PHP Database for Spotify Friendship">      
  <title>Title</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link type="text/css" rel="stylesheet" href="/stylesheets/index.css" />
</head>

<form action="register.php" method="post">
    <!-- Navbar/Register -->  
    <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand">Welcome to Spotify4u</a>
    <form class="form-inline">
        <a class="btn btn-outline-success my-2 my-sm-0" href="/">LOGIN</a>
    </form>
    </nav>
    <h1>Register!</h1>
    <div class="form-group">
        <label for="uname">Username</label>
        <input class="form-control" type="text" placeholder="Enter Username" name="username2" required>
    </div>
    <div class="form-group">
        <label for="psd">Password</label>
        <input class="form-control" type="password" placeholder="Enter Password" name="password2" required>
    </div>
    <!-- <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username2" required>
        <label for="psd"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password2" required>
    </div> -->
    <button type="submit" name = 'submit' value="Register" class="btn btn-primary">Submit</button>
</form>