<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href='covid_track.css'>
    </head>

    <body>
        <div class="column_33">
            &nbsp;
        </div>
        <div class="column_34">
        <form action='main.php' method='post'> 
            <div class="row" >
                <input type="text" placeholder="Username" name="username" required>
            </div>

            <div class="row">
                 <input placeholder="Password"  type="password" id="pspasswordw" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                title="Password cannot be NULL  !!!" required>
            </div>
            <div class="row">
                &nbsp;
            </div>
            <div class="row">
                <div class="column_50">
                    <button class="column_50" type="submit" class="half_btn">Login</button>
                    
                </div>
                </form>
                <div class="column_50">
                    <button class="button_50" type="button"  class="half_btn">Cancel</button>
                </div>
            </div>

            <div class="row">
                <a href="register_page.php" target="_self">
                    <button class="button_100" type="button"  class="cancelbtn">Register</button>
                </a>   
            </div>
            &nbsp;
        </div>
        <script src="check.js"></script>
    </body>
</html>