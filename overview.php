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
     /*echo $username,' <br>';
     echo $password,' <br>';
     echo $name,' <br>';
     echo $surname,' <br>';
    */
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

    if(is_null($name)){ //Checks if it's login or register
        //echo 'LOGGED IN<br>';
        $sql="SELECT password FROM users WHERE username='$username'";
        //echo 'SQL', $sql , "<br>";
        $result = $conn->query($sql);
        //echo 'result=' , $result->num_rows ,  "<br>";
    
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) { 
              echo "Username: " . $row["userame"]. "<br>";
            }
          } else {
              
            echo "Password Error or User Not found";
          }
    }   else {
        # code to register
        #TODO Check if username is already in use.
        $sql="INSERT INTO users (name,surname,username,password) values ('$name','$surname','$username','$password')";
        //echo 'SQL ', $sql, "<br>";
        $result = $conn->query($sql);
        //echo 'result=' , $result->num_rows;

        //echo 'REGISTERED SUCCESSFULLY!';
    }
    $conn->close();
    ?>

    <div class="column_100">
        <div class="covid19_title"><h1>COVID - 19 Contact Tracing</h1></div>
        <div class="column_100">
            <div class="menu" >
                <h2 style=background-color: rgb(100, 185, 202);> <a href="main.php"> Home </a></h2>
                <h2><a href="overview.php"> Overview</a><h2>
                <h2><a href="add_visit.php"> Add Visit</a></h2>
                <h2><a href="report.php"> Report</a></h2>
                <h2><a href="settings.php"> Settings</a></h2>
                <h2> &nbsp;</h2>
                <h2> Logout</h2>
            </div>
            <div class="content_main"> 
                <div class="column_100"  >
                    <h2> Status</h2> 
                </div>
                <div >
                    <div style="width: 200px; float:left; height:250px;; margin:5px">
                        <p align="justify">
                            Hi <?php echo $_POST["name"] ?>
                            you might have had a connection to an infected person at the location shown in red.'
                            <br><br><br><br><br><br>
                            Click on the marker to see details about the infection.</h2> 
                        </p>
                    </div>      
                </div>
                
            </div>
        </div>
    </div>

   
    
    </body>
</html>