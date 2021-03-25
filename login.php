<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("Location: index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $err  = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    if (empty($err)) {
        if(empty(trim($_POST["password"]))){
            $err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }
    }
    if (empty($err)) {
            $param_username = $username;
            $stmt = $conn->prepare('SELECT  name, password FROM users WHERE username = ?' );
            $stmt->bind_param('s', $param_username); 

            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $name =$row["name"];
                $hashed_password=$row["password"];
                //echo '<br> hashed_password',$hashed_password;
                //echo "<br> Name: ". $row["username"]. " " . $row["surname"] . "<br>";
                if(password_verify ($password, $hashed_password) ){
                                session_start();
                                $_SESSION["loggedin"] = true;
                                $_SESSION["name"] = $name;
                                $_SESSION["username"] = $username;  
                                header("Location: index.php");
                } else {
                        // Username doesn't exist, display a generic error message
                        $err = "Invalid username or password.";
                } 
            } else {
                // Username doesn't exist, display a generic error message
                $err = "Invalid username or password.";     
            }            
    }
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title> COVID-CT: Login</title>
    <meta charset="UTF-8"> 
    <script src="map.js"></script>
    <link rel="stylesheet" href='covid_track.css'>
    <script>
    function clearForm(){
        document.getElementById("form").reset(); 
    };
    </script>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div class="covid19_title">COVID - 19 Contact Tracing</div>
<div class="grid-container">
    <div class="grid-title">
    </div>
    <div class="grid-item">&nbsp; </div>
    <div class="grid-item">
    <div class="login-container">
            <div class="login-psw"> 
                <input type="text" placeholder="username" name="username" class="form-control">
            </div>
            <div class="login-psw"> 
                <input type="password" name="password" placeholder="Password" class="form-control">
            </div>            
            <div class="login-item">  
                <input type="submit" class="btn" value="Login"> 
            </div>
            <div class="login-item">  &nbsp;</div>
            <div class="login-item">  
                 <input class="btn" type="reset" value="Cancel">  
            </div>            
            <div class="login-register"> 
                 <a href="register.php"> 
                        <button  type="button"  class="btn">Register</button>
                </a>
            </div>  
             <?php 
                    if(!empty($err)){
                            echo ' <div class="login-err" > '. $err.' </div> ';
                    }           
            ?>          
    </div> 
  </div>
  <div class="grid-item">&nbsp;</div>
</div> 
</form>
   

</body>
</html>