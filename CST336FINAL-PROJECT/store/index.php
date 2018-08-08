<?php
    session_start();
    
    include '../dbConnection.php';
    
    $conn = getDatabaseConnection("plantdb");
    
    // Reset the search fields when navigating back to the home page
    unset($_SESSION['search-box']);
    unset($_SESSION['order-by']);
    unset($_SESSION['search-by']);
    unset($_SESSION['priceFrom']);
    unset($_SESSION['priceTo']);
    
    function getPlants() {
        global $conn;
      
        $sql = "SELECT * FROM plant";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt ->fetchAll(PDO::FETCH_ASSOC);

        return $records;
    }
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
          
          $plants = getPlants();
        ?>
        
        <br><br><br><br>
        
        <div class="text-center">
            <div id="plantCarousel" class="carousel slide carousel-fade" data-ride="carousel">
              <div class="carousel-inner">
                <?php
                    for ($i = 0; $i < count($plants); $i++) {
                        echo "<div class='carousel-item";
                        echo ($i == 0) ? " active" : "";
                        echo "'>";
                        echo "<img src='../".$plants[$i]['imgLink']."'>";
                        echo "</div>";
                    }
                ?>
              </div>
            </div>
        </div>

        
        <br><br><br><br>
        
        <div class="text-center">
          <div id="intro-text" class="card bg-light d-inline-block p-4">
            Welcome to the Teeny Shop of Horrors. <br>
            We offer a unique selection of deadly, toxic, and carnivorous plants. <br>
            Proceed at your own risk.
          </div>
        </div>
        
        <br><br><br>
        
    <script language="javascript" type="text/javascript" src="inc/functions.js"></script>
    </body>
    
    <?php
    include '../php/footer.php';  //includes the footer
    ?>
    
</html>
