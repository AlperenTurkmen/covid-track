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
    <meta charset="UTF-8">
    <link rel="stylesheet" href='covid_track.css'>
</head>
<body>
<html>
    <head>
        <link rel="stylesheet" href='covid_track.css'>
    </head>
    <body>
     
    <div class="column_100">
        <div class="covid19_title"><h1>COVID - 19 Contact Tracing</h1></div>
        <div class="column_100">
            <div class="menu" >
                <h2 style=background-color: rgb(100, 285, 202);> <a href="main.php"> Home </a></h2>
                <h2><a href="overview.php"> Overview</a><h2>
                <h2><a href="add_visit.php"> Add Visit</a></h2>
                <h2><a href="report.php"> Report</a></h2>
                <h2><a href="settings.php"> Settings</a></h2>
                <h2> &nbsp;</h2>
                <h2><a href="logout.php"> Logout</a></h2>
            </div>
            <div class="content_main"> 
            <div class="column_100"  >
                    <h2> Overview</h2> 
                    <hr>
            </div>
            <div class="column_100">
                <?php  
                $visit_id=$_POST["visit_id"];
                if (!empty($visit_id)) {
                    $sql=" DELETE FROM visits where id=$visit_id";
                    $result = $conn->query($sql);
                    echo $visit_id;
                }    
               //echo $visit_id;    
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
                        echo '<div class="table-title"> &nbsp; </div>';
                        // output data of each row
                        while ($row = $result->fetch_assoc()) { 
                            echo '<div class="table-item">' . $row["visit_date_time"]. '</div>';
                            echo '<div class="table-item">' . $row["duration"]. '</div>';
                            echo '<div class="table-item">' . $row["visit_location_x"].' </div>';
                            echo '<div class="table-item">' . $row["visit_location_y"].' </div>';
                            $a=htmlspecialchars($_SERVER["PHP_SELF"]);
                            echo '<div class="table-item"> 
                                  <form action='.$a.'  method="post">
                                  <input type="hidden" id="visit_id" name="visit_id" value='.$row["id"].'>
                                  <input type="submit" class="btn" value="X"> 
                                  </form>
                                  </div>';
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
    </div>

   
    
    </body>
</html>