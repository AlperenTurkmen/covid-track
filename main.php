<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="map.js"></script>
    <meta charset="UTF-8">
    <link rel="stylesheet" href='covid_track.css'>
</head>
<body>
    
     
     <div class="column_100">
        <div class="covid19_title">COVID - 19 Contact Tracing</div>
        <div class="column_100">
        <div class="menu" >
                <a href="main.php" style="text-decoration:none;"><div class="side_menu" style="background: rgb(132, 151, 176);"> Home </div></a>
                <a href="overview.php" style="text-decoration:none;"><div class="side_menu"> Overview</div></a>
                <a href="add_visit.php" style="text-decoration:none;"><div class="side_menu"> Add Visit</div></a>
                <a href="report.php" style="text-decoration:none;"><div class="side_menu"> Report</div></a>
                <a href="settings.php" style="text-decoration:none;"><div class="side_menu"> Settings</div></a>
                 &nbsp;
                <a href="logout.php" style="text-decoration:none;"><div class="side_menu"> Logout</div></a>
            </div>
            <div class="content_main"> 
                <div class="column_100"  >
                    <h2> Status</h2> 
                    <hr>
                </div>
                <div >
                    <div style="font-family: 'Times New Roman', Times, serif; font-size: 20px; width: 200px; float:left; height:250px; margin:5px">
                        <p align="justify">
                            Hi <?php echo $_SESSION["name"] ?>
                            you might have had a connection to an infected person at the location shown in red.'
                            <br><br><br><br><br><br>
                            Click on the marker to see details about the infection.</h2> 
                        </p>
                    </div>
                    <div id="map" style=" border-style: dashed; width: 400px; float:right; height:400px; background:gray; margin:0px ">
                         
                        <?php
                            $url = 'http://ml-lab-7b3a1aae-e63e-46ec-90c4-4e430b434198.ukwest.cloudapp.azure.com:60999/ctracker/infections.php?ts=1'.$ip;
                            $srv_response =file_get_contents($url);
                            //echo '$srv_response :', $srv_response ;
                            $srv_data = json_decode($srv_response, true);
                            foreach ($srv_data AS $d){
                                $x_loc = $d["x"];  
                                $y_loc = $d["y"];  
                                //calculate the positon will take time. just used static values from used values.
                                $ratio=9.5; 
                                $x_loc =  ($x_loc/$ratio) + 700;
                                $y_loc =  ($y_loc/$ratio) + 400;//
                                echo '<img src="marker_red.png" id="red_marker" name="red_marker" 
                                style="display: block; position: absolute;left: '.$x_loc.'px; top: '.$y_loc.'px; width:30px; height:30px;" />';
                                //echo 'x,y:',$x_loc , $y_loc;
                            }
 
                        ?>  
                        <img style="max-width:100%;max-height:100%; float:right;" src='exeter.jpg'>
                        
                        
                    </div>        
                </div>
                
            </div>
        </div>
    </div>

   
    
    </body>
</html>