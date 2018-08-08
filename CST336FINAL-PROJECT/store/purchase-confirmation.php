<?php
    session_start();
    
    // Reset the search fields when navigating back to the home page
    unset($_SESSION['search-box']);
    unset($_SESSION['order-by']);
    unset($_SESSION['search-by']);
    unset($_SESSION['priceFrom']);
    unset($_SESSION['priceTo']);
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Teeny Shop of Horrors </title>
        <!-- Custom CSS -->
        <link href="css/styles.css" rel="stylesheet"/>
        <!-- Bootrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy|Nosifer" rel="stylesheet">
        <!-- Ajax library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Bootstrap library -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    </head>
    <body>
      
        <?php
          include 'navbar.php';
        ?>
        <br><br><br><br>
        <div class="text-center">
            Order submitted successfully
            <br><br>
            <h3>Thank you for your purchase!</h3>
            <br><br>
            <a href="index.php"><button class="btn btn-success">Continue Shopping</button></a>
        </div>

    
        <script language="javascript" type="text/javascript" src="inc/functions.js"></script>
        </body>
</html>