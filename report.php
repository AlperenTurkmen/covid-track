<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    } 
    require_once "config.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href='covid_track.css'>
    </head>
    <body>
    <?php   

    if(isset($_COOKIE["window"])) {
        $window_value=$_COOKIE["window"];
    }
    if(isset($_COOKIE["distance"])) {
        $distance=$_COOKIE["distance"];
    }

    //echo $window_value * 7, ' </br>'; //mltipy 7 days for a week 

    $date=$_POST['date'];
    $time=$_POST['time'].':00';
    $date_time=$date . $time;
    $username=$_SESSION["username"];
    
    //echo $date-$window_value * 7;

    $date2=date_create($date);
    date_sub($date2,date_interval_create_from_date_string("4 weeks"));
    //echo 'XX:', date_format($date2,'Y-m-d').' '.$time;

    $date_time2 = date_format($date2,'Y-m-d').' '.$time;

    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
          $srv_url = 'http://ml-lab-7b3a1aae-e63e-46ec-90c4-4e430b434198.ukwest.cloudapp.azure.com:60999/ctracker/report.php?';
         
         $sql="SELECT visit_date_time , visit_location_x,visit_location_y ,duration 
               FROM visits 
               WHERE username = '$username' 
               AND visit_date_time<=str_to_date('$date_time','%Y-%m-%d%H:%i')
               AND visit_date_time>str_to_date('$date_time2','%Y-%m-%d%H:%i')
               ORDER BY duration ASC;";
                //echo 'SQL', $sql , "<br>";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) { 
                    $srv_data =  array('x'      => $row["visit_location_x"], 
                                   'y'      => $row["visit_location_y"] , 
                                   'date'   => $date , 
                                   'time'   => $time , 
                                   'duration' => $row["duration"]);
                    //echo 'data:', json_encode($srv_data) , '</br>';
                    $srv_options = array(
                            'http' => array(
                            'header'  => "Content-type: application/json\r\n",
                            'method'  => 'POST',
                            'content' => json_encode($srv_data),
                        )
                    );
                    $srv_context  = stream_context_create($srv_options);
                    $srv_result=file_get_contents( $srv_url, false, $srv_context ) ;   
                    //echo '<br>result:',json_decode( $srv_result );
                    //$response = json_decode( $result );
                }
         
    }
       
     
    $sql="INSERT INTO infections (infection_date_time, username) 
    values (str_to_date('$date_time','%Y-%m-%d%H:%i'),'$username')";
    // echo 'SQL:', $sql;
    $result = $conn->query($sql);
    $conn->close();
    ?>

    <div class="column_100">
        <div class="covid19_title">COVID - 19 Contact Tracing</div>
        <div class="column_100">
        <div class="menu" >
                <a href="main.php" style="text-decoration:none;"><div class="side_menu"> Home</div></a>
                <a href="overview.php" style="text-decoration:none;"><div class="side_menu"> Overview</div></a>
                <a href="add_visit.php" style="text-decoration:none;"><div class="side_menu"> Add Visit</div></a>
                <a href="report.php" style="text-decoration:none;"><div class="side_menu" style="background: rgb(132, 151, 176);"> Report</div></a>
                <a href="settings.php" style="text-decoration:none;"><div class="side_menu"> Settings</div></a>
                 &nbsp;
                <a href="logout.php" style="text-decoration:none;"><div class="side_menu"> Logout</div></a>
            </div>
            <div class="content_main"> 
                <div class="column_100"  >
                    <h2> Report an Infection</h2> 
                    <hr>
                </div>
                <div class="menu_name" >
                        <p text-align="justify">
                            Please report the date and time when you were tested positive for COVID 19 
                            </h2> 
                        </p>                        
                </div>
                <div style="width: 800px; float:left; height:250px;; margin:5px">
                        <p align="justify">
                       
                        <form id="form" action='' method='post'> 
                        <div class="row" >
                            <input type="date" placeholder="Date" name="date" required>
                        </div>
                        <div class="row" >
                        <input type="time" placeholder="Time" name="time" required>
                        </div>
                        <div>
                            <button  type="submit"  class="btn">Add</button>
                        
                            <button onclick="clearForm()"  type="button"  class="btn">Cancel</button>
                        </div>
                        
                            <br><br><br><br><br><br>
                        </h2> 
                        </p>
                    </div>
            </div>
        </div>
    </div>

   
    
    </body>
</html>