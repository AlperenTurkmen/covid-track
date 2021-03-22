<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href='covid_track.css'>
        
    </head>
    <body>
        
    <?php   
     $time=$_POST['time'];
     $date=$_POST['date'];
     $x=$_POST['x'];
     $y=$_POST['y'];
     echo 'x,y',$x, ',' ,$y ,'.', '<br>';
     $date_time=$date . $time;
     $duration=$_POST['duration'];
     echo 'date_time:', $date_time,' <br>';
     echo 'date:', $date,'-',$time,' <br>';
     
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
    $sql="INSERT INTO visits (visit_date_time, visit_location_x, visit_location_y, duration) values (str_to_date('$date_time','%Y-%m-%d%H:%i'),'$x','$y','$duration')";
    echo 'SQL:', $sql;
    $result = $conn->query($sql);
    $conn->close();
    ?>

    <div class="column_100">
        <div class="covid19_title"><b><h1>COVID - 19 Contact Tracing</h1></b></div>
        <div class="column_100">
            <div class="menu" >
                <h2><a href="main.php"> Home </a></h2>
                <h2><a href="overview.php"> Overview</a><h2>
                <h2><a href="add_visit.php"> Add Visit</a></h2>
                <h2><a href="report.php"> Report</a></h2>
                <h2><a href="settings.php"> Settings</a></h2>
                <h2> &nbsp;</h2>
                <h2> Logout</h2>
            </div>
            <div class="content_main"> 
                <div class="column_100"  >
                    <h2> Add visit</h2> 
                </div>
                <div >
                    <div style="width: 200px; float:left; height:250px;; margin:5px">
                        <p align="justify">
                        <form id="form" action='' method='post'> 
                        <div class="row" >
                            <input type="date" placeholder="Date" name="date" required>
                        </div>
                        <div class="row" >
                        <input type="time" placeholder="Time" name="time" required>
                        </div>
                        <div class="row" >
                        <input type="time" placeholder="Duration" name="duration" required>
                        </div>
                        <div class="row">
                            <button class="button_100" type="submit"  class="cancelbtn">Add</button>
                        </div>
                        <div class="row">
                            <button onclick="clearForm()" class="button_100" type="button"  class="cancelbtn">Cancel</button>
                        </div>
                        <div class="row" >
                            <input id="x" type="text"  name="x" required >
                        </div>
                        <div class="row" >
                            <input id="y" type="text" name="y" required >
                        </div>

                            <br><br><br><br><br><br>
                        </h2> 
                        </p>
                    </div>
                    </form>
                    <div id="map" style=" border-style: dashed; padding:30; width: 400px; float:right; height:400px; background:gray; margin:0px ">
                        <img style="max-width:100%;max-height:100%; float:right;" src='exeter.jpg'>   
                    </div>       
                </div>
                
            </div>
        </div>
    </div>
    <img src="marker_black.png" id="marker" name="marker" 
        style="display: none; position: absolute;  width:30px; height:30px;" />
    

    <script src="map.js"></script>
    
    </body>
</html>