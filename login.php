<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("Location: main.php");
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
       
            // Prepare a select statement
            $param_username = $username;
            $sql = "SELECT  name, password FROM users WHERE username = '$param_username'";
            //echo $sql;
            $result = $conn->query($sql);

            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $name =$row["name"];
                $hashed_password=$row["password"];
                //echo '<br> hashed_password',$hashed_password;

                //echo "<br> Name: ". $row["username"]. " " . $row["surname"] . "<br>";
                if(password_verify ($password, $hashed_password) ){
                    // echo 'OK';
                                session_start();
                                $_SESSION["loggedin"] = true;
                                $_SESSION["name"] = $name;
                                $_SESSION["username"] = $username;  
                                header("Location: main.php");
   
                } else {
                        // Username doesn't exist, display a generic error message
                        $err = "NOT OK Invalid username or password.";
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
    <meta charset="UTF-8"> 
    <script src="map.js"></script>
</head>
<body>
     <?php 
        if(!empty($err)){
            echo '<div class="alert">' . $err . '</div>';
        }        
        ?>

    <div class="column_33">
            &nbsp;
        </div>
        <div class="column_34">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="row" >
                <label>Username</label>
                <input type="text" placeholder="username" name="username" class="form-control">
            </div>
            <div class="row">
                 <label>Password</label>
                <input type="password" name="password" placeholder="Password" class="form-control">         
            </div>
            <div class="row">
                &nbsp;
            </div>

            <div class="row">
                <div class="column_50">
                    <!--button class="column_50" type="button"  class="half_btn">Login</button-->
                    <input type="submit" class="btn" value="Login">
                </div>
               
                <div class="column_50">
                    <button onclick="clearForm()" class="button_100" type="button" >Cancel</button>
                </div>
            </div>
            </form>
            <div class="row">
            <a href="register.php"> 
                <button class="button_100" type="button"  class="regbtn">Register</button>
            </a>
            </div>
           &nbsp;
        </div>
        <div class="column_33">
            &nbsp;
        </div>
       
 
</body>
</html>