<?php
    session_start();
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Ottermart Admin</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css"/>
    </head>
    
    <body>
        
        <br><br><br><br><br>
    
        <div class="center">
            <form method="POST" action="loginProcess.php">
            Username: <input type="text" name="username"/><br><br>
            Password: <input type="password" name="password"/><br>
            
            <br>    
            
            <input type="submit" name="submitForm" value="Login!" />
            
            <br><br>
            
            <?php
                if($_SESSION['incorrect']) {
                    echo "<p class = 'lead' id = 'error' style='color:red'>";
                    echo "<strong>Incorrect Username or Password!</strong></p>";
                }
            ?>
            </form>    
        </div>
        
    
    </body>

</html>