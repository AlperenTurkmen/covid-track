<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href='covid_track.css'>
    </head>
    <body>
    <?php   
     $username=$_POST['username'];
     $password=$_POST['password'];
     $name=$_POST['name'];
     $surname=$_POST['surname'];
     echo $username,' <br>';
     echo $password,' <br>';
     echo $name,' <br>';
     echo $surname,' <br>';
     #echo 'DFSDFS';
    
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

    if(is_null($name)){
        echo 'LOGGED IN<br>';
        $sql="SELECT password FROM users WHERE username='$username'";
        echo 'SQL', $sql;
        echo "<br>";
        $result = $conn->query($sql);
        echo 'result=' , $result->num_rows;
        echo "<br>";
    
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) { 
              echo "id: " . $row["password"]. "<br>";
            }
          } else {
              
            echo "Password Error or User Not found";
          }
    }   else {
        # code to register
        #TODO Check if username is already in use.
        $sql="INSERT INTO users (name,surname,username,password) values ('$name','$surname','$username','$password')";
        echo 'SQL ', $sql;
        echo "<br>";
        $result = $conn->query($sql);
        echo 'result=' , $result->num_rows;

        echo 'REGISTERED SUCCESSFULLY!';
    }

    
      $conn->close();

    ?>
     echo "<br>";
    Welcome <?php echo $_POST["username"]; ?><br>
    Your password is: <?php echo $_POST["password"]; ?>
    </body>
</html>