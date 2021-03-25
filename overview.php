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
    <title> COVID-CT: Visits Overview</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href='covid_track.css'>
    <script src="ajaxremove.js"></script>
</head>
<body>
    
     
    <div class="column_100">
        <div class="covid19_title">COVID - 19 Contact Tracing</div>
        <div class="column_100">
        <div class="menu" >
                <a href="index.php" style="text-decoration:none;"><div class="side_menu"> Home</div></a>
                <a href="overview.php" style="text-decoration:none;"><div class="side_menu" style="background: rgb(132, 151, 176);"> Overview</div></a>
                <a href="add_visit.php" style="text-decoration:none;"><div class="side_menu"> Add Visit</div></a>
                <a href="report.php" style="text-decoration:none;"><div class="side_menu"> Report</div></a>
                <a href="settings.php" style="text-decoration:none;"><div class="side_menu"> Settings</div></a>
                &nbsp;<br><br><br>
                <a href="logout.php" style="text-decoration:none;"><div class="side_menu"> Logout</div></a>
            </div>
            <div class="content_main"> 
            <div class="column_100"  >
                    <h2> Overview</h2> 
                    <hr>
            </div>
            <div class="column_100">
                <?php  
                
                $username=$_SESSION["username"] ;
                //echo $username;
                $sql="SELECT id,visit_date_time , visit_location_x,visit_location_y ,duration 
                FROM visits where username = '$username' order by duration asc limit 15;";
                //echo 'SQL', $sql , "<br>";
                $result = $conn->query($sql);
                //echo 'result=' , $result->num_rows ,  "<br>";
                if ($result->num_rows > 0) {
                        echo '<div class="table-container">';
                        echo '<div class="table-title">Date Time </div>';
                        echo '<div class="table-title">Duration</div>';
                        echo '<div class="table-title">X</div>';
                        echo '<div class="table-title">Y</div>';
                        echo '<div class="table-title"> &nbsp;<p id="txtHint" name="txtHint" > </div>';
                        
                        // output data of each row
                        while ($row = $result->fetch_assoc()) { 
                            echo '<div class="table-item">' . $row["visit_date_time"]. '</div>';
                            echo '<div class="table-item">' . $row["duration"]. '</div>';
                            echo '<div class="table-item">' . $row["visit_location_x"].' </div>';
                            echo '<div class="table-item">' . $row["visit_location_y"].' </div>';
                           
                            $a=htmlspecialchars($_SERVER["PHP_SELF"]);
                            echo '<div class="table-item"> 
                                     <img src="cross.png" id="cross" name="cross" 
                                     style="display: block;  width:30px; height:30px;" onclick="removeRecord('.$row["id"].')" /> 
                                  </div>';
                        }
                        echo '</div>'; 
                } else {
                        echo "Visit records not found.";
                    }              
                $conn->close();
                ?> 
            </div>    
            </div>
        </div>
    </div>

   
    
    </body>
</html>