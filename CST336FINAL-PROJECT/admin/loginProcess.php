<?php
    
    session_start();

    include 'dbConnection.php';
    
    $conn = getDatabaseConnection();
    
    $userName = $_POST['username'];
    $password = sha1($_POST['password']);
    
    //avoid single quotes to prevent injection 
    $sql = "SELECT *
            FROM admin
            WHERE username = :username
            AND   password = :password";
            
    $np = array();
    $np[":username"] = $userName;
    $np[":password"] = $password;
            
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);//expecting one single record "fetch vs fetchAll"
    
    if (empty($record)) {
        $_SESSION['incorrect'] = true;
        header("Location:home.php");
    } else {
        $_SESSION['incorrect'] = false;
        $_SESSION['adminName'] = $record['username'] ;
        header("Location:admin.php");
    }
    

?>