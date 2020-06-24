<?php
//DbConnection
$servername = "localhost";
$username = "db-user";
$password = "SecuREPAssword!";

// Create connection
$conn = new mysqli($servername, $username, $password);

//Setting up SQL DB
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
   $errors[]=" ";
}

?>
