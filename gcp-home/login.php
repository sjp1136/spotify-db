<?php
  global $db;
  require('connectdb.php');
  require('sql.php');


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

      // echo '<pre>'; 
      // print_r($result[0]['password']);
      // $hello = password_verify($password, $result[0]['password']);
      // print_r($hello);
      // echo '</pre>';

      if(password_verify($password, $result[0]['password'])){
        header('Location: simpleform.php');
        exit;
      }
      else{
        echo "<h1>Login Fail!</h1>";
      }
    }
    else{
      echo "<h1>Login Fail!</h1>";
    }

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
</head>

<body>
<div class="container">

    <form action="" method="post">
        <div class="form-group">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <button type="submit" name = 'submit' value="LOGIN">Submit</button>
        </div>
    </form>

    <div class="container">
        <label for="uname"><b>Not registered??</b></label>
            
        <a href="register.php">REGISTER</a>
    </div>
</div>
</body>

</html>