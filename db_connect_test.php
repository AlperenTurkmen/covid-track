<?php
$con = new mysqli("127.0.0.1", "root", "At121212!.", "mydb");
$username = $con->query("SELECT password FROM users WHERE username=$_POST('')")->fetch_object()->username;
$con->close();
echo "$username <br/>";
echo "Hello From Sites Folder!";
