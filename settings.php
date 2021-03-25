<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    } 
    require_once "config.php";
 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $window=$_POST["window"];
    
        if (!empty($window)) {       
            setcookie("window", $window, time() + (86400 * 30), '/');   
        }        

        $distance=$_POST["distance"];
        if (!empty($distance)) {           
            setcookie("distance", $distance, time() + (86400 * 30), '/');   
        } 
        header("Location: settings.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> COVID-CT: Settings</title>
        <link rel="stylesheet" href='covid_track.css'>
    </head>
    <body>
 
    <div class="column_100">
        <div class="covid19_title">COVID - 19 Contact Tracing</div>
        <div class="column_100">
        <div class="menu" >
                <a href="index.php" style="text-decoration:none;"><div class="side_menu"> Home</div></a>
                <a href="overview.php" style="text-decoration:none;"><div class="side_menu"> Overview</div></a>
                <a href="add_visit.php" style="text-decoration:none;"><div class="side_menu"> Add Visit</div></a>
                <a href="report.php" style="text-decoration:none;"><div class="side_menu"> Report</div></a>
                <a href="settings.php" style="text-decoration:none;"><div class="side_menu" style="background: rgb(132, 151, 176);"> Settings</div></a>
                &nbsp;<br><br><br>
                <a href="logout.php" style="text-decoration:none;"><div class="side_menu"> Logout</div></a>
            </div>
            <div class="content_main"> 
                <div class="column_100"  >
                    <h2> Settings</h2> 
                    <hr>
                </div>
                <?php 
                      $cookie_name="window";
                      if(isset($_COOKIE[$cookie_name])) {
                          $window_value=$_COOKIE[$cookie_name];
                          //echo 'Window:',$window_value;
                     }
                     $cookie_name="distance";
                      if(isset($_COOKIE[$cookie_name])) {
                          $distance=$_COOKIE[$cookie_name];
                          //echo 'distance:',$distance;
                     }
                ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                
                <div class="row" >
                    <label for="window" >window</label>
                    <select style="width: 53%;height:40px;" name="window" id="window">
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
                    <input style="width: 52%;height:40px;" id="distance" type="text" name="distance" 
                     <?php 
                        echo " value = '".$distance."'" ;     
                     ?>
                    required >
                    <!--TODO distance must be between 1-500.-->
                </div>
                <div>
                    <button style="width: 60%;height:40px;" type="submit"  class="btn" > Report</button>  
                    <input style="width: 60%;height:40px;" class="btn" type="reset" value="Cancel">        
                     
                </div>
                </form>
            </div>
        </div>
    </div>

   
    
    </body>
</html>