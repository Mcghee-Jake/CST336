<?php

    include 'dbConnection.php';
    
    // For debugging 
    // if(isset($_GET['deleteProduct'])){
    //     echo "id=".$_GET['idplant'];
    // }else {
    //     echo "plant did not set";
    // }
    
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM plant WHERE idplant = ".$_GET['idplant'];
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    header("Location:admin.php");

?>