<?php

/******************************/
// connecting to GCP cloud SQL instance

$username = 'projuser';
$password = 'asdfasdf';

$dbname = 'spotify4u';

// if PHP is on GCP standard App Engine, use instance name to connect
$host = 'cs4750db-268423:us-east4:db-demo';

// if PHP is hosted somewhere else (non-GCP), use public IP address to connect
// $host = "public-IP-address-to-cloud-instance";


/******************************/
// connecting to DB on XAMPP (local)
//
// $username = 'your-username';
// $password = 'your-password';
// $host = 'localhost:3306';
// $dbname = 'your-database-name';


/******************************/
// connecting to DB on CS server

$username = 'projuser';
$password = 'asdfasdf';
$host = 'cs4750db-268423:us-east4:db-demo';
$dbname = 'spotify4u';

// $dsn = "mysql:host=$host;dbname=$dbname";
$dsn = "mysql:unix_socket=/cloudsql/$host;dbname=$dbname";
$db = "";

/** connect to the database **/
try 
{
   $db = new PDO($dsn, $username, $password);   
   // echo "<p>You are connected to the database</p>";
}
catch (PDOException $e)     // handle a PDO exception (errors thrown by the PDO library)
{
   // Call a method from any object, 
   // use the object's name followed by -> and then method's name
   // All exception objects provide a getMessage() method that returns the error message 
   $error_message = $e->getMessage();        
   echo "<p>An error occurred while connecting to the database: $error_message </p>";
}
catch (Exception $e)       // handle any type of exception
{
   $error_message = $e->getMessage();
   echo "<p>Error message: $error_message </p>";
}

?>
