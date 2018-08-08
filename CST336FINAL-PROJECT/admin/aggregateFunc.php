<?php
    include 'dbConnection.php';
    
    $conn = getDatabaseConnection();
    
    function sum() {
        global $conn;
        $sql = "select round((sum(priceDollar)+(sum(priceCent)/100)),2) as sum,
                round((AVG(priceDollar)+((priceCent)/100)),2) as avg,
                round(max(priceDollar+((priceCent)/100)),2) as max     
                from plant ";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo json_encode($record);
    }
    
   
    echo sum();
   
?>

