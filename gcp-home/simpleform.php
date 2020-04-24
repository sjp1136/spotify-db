<?php
  // The difference between include and require arises when the file being included cannot be found: 
  // include will emit a warning ( E_WARNING ) and the script will continue, 
  // whereas require will emit a fatal error ( E_COMPILE_ERROR ) and halt the script

  //include('connectdb.php');
  require('connectdb.php');
  require('sql.php')
  // steps:
  // 1. connect (configure: load driver, specify host, specify username/password)
  // 2. preparing query (prepared statement allows you to have a fill in the blank to be sent to the server)
  // 3. bind value, execute 
  // 4. use result 
  // 5. close connection   
?>

<?php
$msg = "";

if(!empty($_POST['db-btn'])){
  if($_POST['db-btn'] == "Create")
      create_table();
  else if($_POST['db-btn'] == "Drop")
      drop_table();
  else if($_POST['db-btn'] == "Insert"){
      if (!empty($_POST['name']) && !empty($_POST['major']) && !empty($_POST['year']))     
        addFriend($_POST['name'], $_POST['major'], $_POST['year']); 
      else 
        $msg = "Enter friend information before adding";
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
  <title>Bootstrap example</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
<div class="container">

  <form action="simpleform.php" method="post">
    <div class="form-group">
      Your Name
      <input type="text" class="form-control" name="name"  />     
      Your Major
      <input type="text" class="form-control" name="major" />     
      Your Year
      <input type="text" class="form-control" name="year" />  
            <!-- add required if wanted -->
    </div>  
    <input type="submit" value="Create" class="btn btn-dark" name="db-btn"/>
    <input type="submit" value="Drop" class="btn btn-dark" name="db-btn"/>
    <input type="submit" value="Insert" class="btn btn-dark" name="db-btn"/>

    <br/>
    <?php echo $msg;  ?>
  </form>   
</body>

</div>    
</html>