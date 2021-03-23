<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href='covid_track.css'>
    </head>

    <body>
        <div class="column_33">
               </br>
        </div>
        <form action='main.php' method='post'> 
            <div class="column_34">
                <div class="row" >
                    <input type="text" placeholder="Name" name="name" required>
                </div>
                <div class="row" >
                    <input type="text" placeholder="Surname" name="surname" >
                <div class="row" >
                    <input type="text" placeholder="Username" name="username" required>
                
                <div class="row">
                    <div class="row">
                 <input placeholder="Password"  type="password" id="password" name="password" pattern=(?!.*[^a-zA-Z0-9]).{7,}
                title="May contain  number or letter and at least 8 " required>

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