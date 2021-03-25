<?php
require_once "config.php";
$username = $name = $surname = $password = $err = "";
//if this page called with form submit with post method lets try create user 
if($_SERVER["REQUEST_METHOD"] == "POST"){    
    if(empty(trim($_POST["name"]))){
        $err = "Please enter a name.";
    } else {
        $name=trim($_POST['name']);
    };

    if (empty($err)) {
        if(empty(trim($_POST["username"]))){
            $err = "Please enter a username.";
        } else{
            $param_username = trim($_POST["username"]);
            $sql = "SELECT username FROM users WHERE username = '$param_username'";
            //echo $sql;
            $result = $conn->query($sql);
            //echo 'result=' , $result->num_rows ,  "<br>";
            //echo "record count: ",$result->num_rows,  "<br>";
            if($result->num_rows >= 1){
                     $err = "This username is already taken.";     
            } else{
                    $username = trim($_POST["username"]);
            }       
        }
    }

    if (empty($err)) {
        if(empty(trim($_POST["password"]))){
            $err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 8){
            $err = "Password must have atleast 8 characters.";
        } else{
            $password = trim($_POST["password"]);
        }
    }
    // Check input errors before inserting in database
    if(empty($err) ){
        $surname=trim($_POST['surname']);
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
     
        $sql="INSERT INTO users (name,surname,username,password) 
                values ('$name','$surname','$username','$param_password');";
        //echo 'SQL ', $sql, "<br>";
        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully";
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["name"] = $name;
            $_SESSION["username"] = $username;  
            header("Location: main.php");
          } else {
            echo "Something went wrong when registering. Please try again later.";    
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
     } else {
        //echo  $err;
    }
    
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <script src="map.js"></script>
    <link rel="stylesheet" href='covid_track.css'>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div class="grid-container">
    
    <div class="grid-title">
    <div class="covid19_title">COVID - 19 Contact Tracing</div>
    </div>
    <div class="grid-item">&nbsp; </div>
    <div class="grid-item">

        <div class="login-container">
             <div class="login-psw"> 
                  <input style="width: 100%;height:40px;" type="text" placeholder="Name" name="name" required>
             </div>
             <div class="login-psw"> 
                 <input style="width: 100%;height:40px;" type="text" placeholder="Surname" name="surname" >
             </div>
             <div class="login-psw"> 
                    <input style="width: 100%;height:40px;" type="text" placeholder="Username" name="username" 
                            class="
                             <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" 
                             value="<?php echo $username; ?>">                  
             </div>
             <div class="login-psw"> 
                     <input style="width: 100%;height:40px;" type="password" placeholder="Password" name="password"  pattern=(?!.*[^a-zA-Z0-9]).{7,}  class="<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">  
               
             </div>
 
            <div class="login-psw">  
                <input style="width: 100%;height:40px;" type="submit" class="btn" value="Register"> 
            </div>
              
             <?php 
                    if(!empty($err)){
                            echo ' <div class="login-err" > '. $err.' </div> ';
                    }           
            ?>
                      
        </form>
    </div> 
  </div>
  <div class="grid-item">&nbsp;</div>
</div> 
</form>
 
    </body>
</html>