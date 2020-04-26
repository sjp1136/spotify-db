<?php
  require('connectdb.php');
  require('sql.php');
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
</head>

<body>
<div class="container">

    <form action="login.php" method="post">
        <div class="form-group">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button type="submit"><a href="simpleform.php">Log In</a></button>
        </div>
    </form>

    <div class="container">
      <form action="/register.php">
            <label for="uname"><b>Not registered??</b></label>
            
            <a href="register.php">REGISTER</a>

            <!-- <button type="submit"><a href="./register.php">Register2</a></button> -->
      </form>
    </div>
</div>
</body>

</html>