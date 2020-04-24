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
<h1>Friend book</h1>
<form action="simpleform.php" method="post">   
  <div class="form-group">
    Your name:
    <input type="text" class="form-control" name="name" required />        
  </div>  
  <div class="form-group">
    Major:
    <input type="text" class="form-control" name="major" required />        
  </div>  
  <div class="form-group">
    Year:
    <input type="text" class="form-control" name="year" required />        
  </div> 
     
  <input type="submit" value="Save info" class="btn btn-dark" />  
  
</form>  

    
</div>    
</body>
</html>