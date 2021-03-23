<?php
   $db_servername = "127.0.0.1";
   $dbuser = "root";
   $dbpassword = "At121212!.";
   $dbname = "users";
   
   // Create connection
   $conn = new mysqli($db_servername, $dbuser, $dbpassword, $dbname);
   // Check connection
   if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
   }
?>