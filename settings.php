<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    } 
    require_once "config.php";
 
    $window=$_POST["window"];
 
    if (!empty($window)) {       
        setcookie("window", $window, time() + (86400 * 30), '/');   
    }        

    $distance=$_POST["distance"];
    if (!empty($distance)) {           
        setcookie("distance", $distance, time() + (86400 * 30), '/');   
    } 

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href='covid_track.css'>
    </head>
    <body>
 
    <div class="column_100">
        <div class="covid19_title"><b><h1>COVID - 19 Contact Tracing</h1></b></div>
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
                    <h2> Settings</h2> 
                </div>
                <?php 
                      $cookie_name="window";
                      if(isset($_COOKIE[$cookie_name])) {
                          $window_value=$_COOKIE[$cookie_name];
                          echo 'Window:',$window_value;
                     }
                     $cookie_name="distance";
                      if(isset($_COOKIE[$cookie_name])) {
                          $distance=$_COOKIE[$cookie_name];
                          echo 'distance:',$distance;
                     }
                ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                
                <div class="row" >
                    <label for="window" >window</label>
                    <select name="window" id="window">
                    <option   
                    <?php 
                        if ($window_value=="1") {
                            echo 'selected' ;   
                        }
                    ?>
                    value="1">One week</option>
                    <option 
                    <?php 
                        if ($window_value=="2") {
                            echo 'selected' ;   
                        }
                    ?>
                    value="2">Two weeks</option>
                    <option 
                    <?php 
                        if ($window_value=="3") {
                            echo 'selected' ;   
                        }
                    ?>
                    value="3">Three weeks</option>
                    <option 
                    <?php 
                        if ($window_value=="4") {
                            echo 'selected' ;   
                        }
                    ?>
                     value="4">Four weeks</option>
                    </select>      
                </div>
                <div class="row">
                    <label for "distance">distance</label>
                    <input id="distance" type="text" name="distance" 
                     <?php 
                        echo " value = '".$distance."'" ;     
                     ?>
                    required >
                    <!--TODO distance must be between 1-500.-->
                </div>
                <div>
                    <button  type="submit"  class="btn" > Report</button>  

                    <button onclick="clearForm()"  type="button"  class="btn">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>

   
    
    </body>
</html>