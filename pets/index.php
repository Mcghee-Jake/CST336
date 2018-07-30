<?php

    function getPetImages() {
        include 'dbConnection.php';
        $conn = getDatabaseConnection("pets");
        
        $sql = "SELECT pictureURL
                FROM pets";
                
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $record;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> CSUMB: Pet Shelter </title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>   
        <style>
            body {
                text-align: center;
            }
        </style>
   
    </head>
    <body>
    
    <?php
        include 'inc/header.php'
    ?>
        
    
        
        <!-- Add Bootstrap Carousel -->
        <div class="carousel slide" data-ride="carousel">
            <?php
                $images = getPetImages();
                
                for ($i = 0; $i < count($images); $i++) {
                    echo "<div class='carousel-item";
                    echo ($i == 0) ? " active" : "";
                    echo "'>";
                    echo "<img src='img/".$images[$i]['pictureURL']."'/>";
                    echo "</div>";
                }
            ?>
        </div>
        
        <br><br>
        
        <a class="btn btn-outline-primary" href="pets.php" role="button">Adopt Now! </a>
        
        <br><br>
        <hr>
        
    <?php
        include 'inc/footer.php';
    ?>
        
    </body>
</html>