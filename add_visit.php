<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    } 
    require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> COVID-CT: Add visit</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href='covid_track.css'>
</head>
<body>

<html>
    <head>
        <link rel="stylesheet" href='covid_track.css'>
        
    </head>
    <body>
        
    <?php   
     if($_SERVER["REQUEST_METHOD"] == "POST"){
        $time=$_POST['time'];
        $date=$_POST['date'];
        $x=$_POST['x'];
        $y=$_POST['y'];
        //echo 'x,y',$x, ',' ,$y ,'.', '<br>';
        $date_time=$date . $time;
        $duration=$_POST['duration'];
        //echo 'date_time:', $date_time,' <br>';
        //echo 'date:', $date,'-',$time,' <br>';
        $username=$_SESSION["username"] ;
        
        //$sql="INSERT INTO visits (username, visit_date_time, visit_location_x, visit_location_y, duration) 
        //values ('$username', str_to_date('$date_time','%Y-%m-%d%H:%i'),'$x','$y','$duration')";
        #echo 'SQL:', $sql;
        //$result = $conn->query($sql);
        //$conn->close();
        $stmt = $conn->prepare('INSERT INTO visits 
        (username, visit_date_time, visit_location_x, visit_location_y, duration) #This lines check for sql injections
                values (?,str_to_date(?,"%Y-%m-%d%H:%i"),?,?,?)' );
        $stmt->bind_param('sssss', $username,$date_time,$x,$y,$duration); 
        $stmt->execute();
        $result = $stmt->get_result();
        
     }
    ?>

    <div class="column_100">
        <div class="covid19_title">COVID - 19 Contact Tracing</div>
        <div class="column_100">
            <div class="menu" >
                <a href="index.php" style="text-decoration:none;"><div class="side_menu"> Home</div></a>
                <a href="overview.php" style="text-decoration:none;"><div class="side_menu"> Overview</div></a>
                <a href="add_visit.php" style="text-decoration:none;"><div class="side_menu" style="background: rgb(132, 151, 176);"> Add Visit</div></a>
                <a href="report.php" style="text-decoration:none;"><div class="side_menu"> Report</div></a>
                <a href="settings.php" style="text-decoration:none;"><div class="side_menu"> Settings</div></a>
                &nbsp;<br><br><br>
                <a href="logout.php" style="text-decoration:none;"><div class="side_menu"> Logout</div></a>
            </div>
            <div class="content_main"> 
                <div class="column_100"  >
                    <h2> Add visit</h2> 
                    <hr>
                </div>
                <div >
                    <div style="width: 200px; float:left; height:250px;; margin:5px align-items: center;">
  
                        <form id="form" action='' method='post'> 
                        <div class="row">
                            <input style="width: 96%;height:40px;text-align:center;" type="date" placeholder="Date" name="date" required>
                        </div>
                        <div class="row" >
                        <input style="width: 96%;height:40px;text-align:center;" type="time" placeholder="Time" name="time" required>
                        </div>
                        <div class="row" >
                        <input style="width: 96%;height:40px;" type="number" placeholder="Duration" name="duration" required>
                        </div>
                        <div>  &nbsp;</div>
                        <div>  &nbsp;</div>
                        <div>  &nbsp;</div>
                        <div>  &nbsp;</div>
                        <div class="row">
                            <button onclick="checkCoordinates()"class="btn" type="submit"   >Add</button>
                        </div>
                        <div class="row">
                            <button onclick="clearForm()" class="btn" type="button"  >Cancel</button>
                        </div>
                        <div class="row" >
                            <input id="x" type="hidden"  name="x" required >
                        </div>
                        <div class="row" >
                            <input id="y" type="hidden" name="y" required >
                        </div>

 
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