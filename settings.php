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
                <h2><a href="main.php"> Home </a></h2>
                <h2><a href="overview.php"> Overview<h2>
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