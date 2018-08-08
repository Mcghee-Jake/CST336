<?php
    session_start();
    
    // Sets the session variables from user input
    $_SESSION['search-box'] = $_POST['search-box'];
    $_SESSION['order-by'] = $_POST['order-by'];
    $_SESSION['search-by'] = $_POST['search-by'];
    $_SESSION['priceFrom'] = $_POST['priceFrom'];
    $_SESSION['priceTo'] = $_POST['priceTo'];
?>