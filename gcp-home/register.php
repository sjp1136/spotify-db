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
        echo "  You have successfully created your account!" ;
    }
    else{
        echo "Error. That username already exists!" ;
    }
}
?>

<form action="register.php" method="post">
    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username2" required>

        <label for="psd"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password2" required>

    </div>
    <button type="submit" name = 'submit' value="Register">Submit</button>
</form>

<a href="/">Go to Login</a>
