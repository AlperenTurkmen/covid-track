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
        $db_servername = "127.0.0.1";
        $dbuser = "root";
        $dbpassword = "At121212!.";
        $dbname = "users";
        
        // Create connection
        $conn = new mysqli($db_servername, $dbuser, $dbpassword, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        //TODO   EXIT or ERROR
        }
    
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
            <?php   
                $sql="SELECT username,visit_date_time , visit_location_x,visit_location_y ,duration 
                FROM visits order by duration asc limit 15;";
               // echo 'SQL', $sql , "<br>";
                $result = $conn->query($sql);
                //echo 'result=' , $result->num_rows ,  "<br>";
                if ($result->num_rows > 0) {
                        echo '<div class="overview-container">';
                        echo '<div class="overview-item"><b>Date Time</b></div>';
                        echo '<div class="overview-item"><b>Duration</b></div>';
                        echo '<div class="overview-item"><b>X</b></div>';
                        echo '<div class="overview-item"><b>Y</b></div>';
                        echo '<div class="overview-item"><b> &nbsp; </b></div>';
                        // output data of each row
                        while ($row = $result->fetch_assoc()) { 
                            echo '<div class="overview-item">' . $row["visit_date_time"]. '</div>';
                            echo '<div class="overview-item">' . $row["duration"]. '</div>';
                            echo '<div class="overview-item">' . $row["visit_location_x"].' </div>';
                            echo '<div class="overview-item">' . $row["visit_location_y"].' </div>';
                            echo '<div class="overview-item"> X </div>';
                        }
                        echo '</div>'; 
                } else {
                        echo "Record Not found";
                    }              
                $conn->close();
            ?>     
            </div>
        </div>
    </div>

   
    
    </body>
</html>