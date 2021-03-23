<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href='covid_track.css'>
    </head>
    <body>
    <?php   
    $date=$_POST['date'];
    $time=$_POST['time'];
    $date_time=$date . $time;
     
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
    $sql="INSERT INTO infections (infection_date_time, username) values (str_to_date('$date_time','%Y-%m-%d%H:%i'),'Biri')";
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
                    <h2> Report an Infection</h2> 
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
                            <button  type="submit"  class="cancelbtn">Add</button>
                        
                            <button onclick="clearForm()"  type="button"  class="cancelbtn">Cancel</button>
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