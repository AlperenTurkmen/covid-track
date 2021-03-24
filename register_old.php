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
        echo  $err;
    }
    
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href='covid_track.css'>   
</head>

<body>
    <div class="column_33">
                &nbsp;
    </div>
    <!--form action='main.php' method='post'--> 
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="column_34">
                <div class="row" >
                <label>Name</label>    
                    <input type="text" placeholder="Name" name="name" required>
                </div>
                <div class="row" >
                    <label>Surname</label>
                    <input type="text" placeholder="Surname" name="surname" >
                </div>
                <div class="row" >
                    <label>Username</label>
                    <input type="text" placeholder="Username" name="username" 
                            class="form-control
                             <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" 
                             value="<?php echo $username; ?>">                              
                </div>
                <div class="row">
                     <label>Password</label>
                    <!--input placeholder="Password"  type="password" id="password" name="password" pattern=(?!.*[^a-zA-Z0-9]).{7,}
                            title="May contain  number or letter and at least 8 " required-->
                    <input type="password" name="password"  pattern=(?!.*[^a-zA-Z0-9]).{7,}  class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">  
                </div>
            </div>

            <div class="row">
                </br>
            </div>

            <div class="row">
                    <button class="button_100" type="submit"  class="cancelbtn">Register</button>
            </div>
            
            </div>
        </form>
        <div class="column_33">
            
        </div>
    </body>
</html>