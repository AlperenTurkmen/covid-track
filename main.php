<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href='covid_track.css'>
    </head>
    <body>
    <?php   
     
    $servername = "127.0.0.1";
    $dbuser = "root";
    $password = "At121212!.";
    $dbname = "users";
    
    // Create connection
    $conn = new mysqli($servername, $dbuser, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $username=$_POST['username'];
    #echo $username;
    #echo 'DFSDFS';

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
      $conn->close();

    ?>
     echo "<br>";
    Welcome <?php echo $_POST["username"]; ?><br>
    Your password is: <?php echo $_POST["password"]; ?>
    </body>
</html>