<?php
    session_start();
  
    include '../dbConnection.php';
    
    $conn = getDatabaseConnection("plantdb");
  
    // Check to see if the cart is set
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
    }
    
    // Check to see if an item has been added to the cart
    if (isset($_POST['idplant'])) {
      
        // Create an array to hold an item's properties
        $newPlant = array();
        $newPlant['idplant'] = $_POST['idplant'];
        $newPlant['plantName'] = $_POST['plantName'];
        $newPlant['plantDesc'] = $_POST['plantDesc'];
        $newPlant['priceDollar'] = $_POST['priceDollar'];
        $newPlant['priceCent'] = $_POST['priceCent'];
        $newPlant['imgLink'] = $_POST['imgLink'];
        
        // Check to see if other items with this id are in the cart array
        // If so, only update the quantity
        foreach ($_SESSION['cart'] as &$item) {
          if ($newPlant['idplant'] == $item['idplant']) {
              $item['quantity'] += 1;
              $found = true;
          }
        }
        
        // Else add it to the array
        if ($found != true) {
          $newPlant['quantity'] = 1;
          array_push($_SESSION['cart'], $newPlant);
        }
    }
  
    function displaySearchResults() {
      global $conn;
      
      if (isset($_SESSION['search-box'])) {
        $namedParameters = array();
        
        $sql = "SELECT * FROM plant WHERE 1";
        
        if (!empty($_SESSION['search-by'])) {
          if ($_SESSION['search-by'] == 'description') {
            $sql .= " AND plantDesc LIKE :plantDesc";
            $namedParameters[":plantDesc"] = "%".$_SESSION['search-box']."%";
          } else {
            $sql .= " AND plantName LIKE :plantName";
            $namedParameters[":plantName"] = "%".$_SESSION['search-box']."%";
          }
        }
    
        if (!empty($_SESSION['priceFrom'])) {
            $sql .= " AND priceDollar >= :priceFrom";
            $namedParameters[":priceFrom"] = $_SESSION['priceFrom'];
        }
        
        
        if (!empty($_SESSION['priceTo'])) {
            $sql .= " AND priceDollar < :priceTo";
            $namedParameters["priceTo"] = $_SESSION['priceTo'];
        }
        
        
        if (isset($_SESSION['order-by'])) {
            if ($_SESSION['order-by'] == "name DESC") {
                $sql .= " ORDER BY plantName DESC";
            } else if ($_SESSION['order-by'] == "price ASC") {
                $sql .= " ORDER BY priceDollar ASC";
            } else if ($_SESSION['order-by'] == "price DESC") {
                $sql .= " ORDER BY priceDollar DESC";
            } else {
                $sql .= " ORDER BY plantName ASC";
            }
        }
    
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        $records = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<table class='table table-hover'>";
        echo "<thead>
                <tr>
                    <th scope='col'>Image</th>
                    <th scope='col'>Plant Name</th>
                    <th scope='col'>Description</th>
                    <th scope='col'>Price</th>
                    <th scope='col'>Add</th>
                </tr>
              </thead>";
        echo "<tbody>";
        foreach($records as $record) {
            echo "<tr>";
            echo "<td><img src='../".$record['imgLink']."'></td>";
            echo "<td>".$record['plantName']."</td>";
            echo "<td>".$record['plantDesc']."</td>";
            echo "<td>$".$record['priceDollar'].".".$record['priceCent']."</td>";
            
            // Hidden input element containing the plant info
            echo "<form method='post'>";
            echo "<input type='hidden' name='idplant' value='".$record['idplant']."'/>";
            echo "<input type='hidden' name='plantName' value='".$record['plantName']."'/>";
            echo "<input type='hidden' name='plantDesc' value='".$record['plantDesc']."'/>";
            echo "<input type='hidden' name='priceDollar' value='".$record['priceDollar']."'/>";
            echo "<input type='hidden' name='priceCent' value='".$record['priceCent']."'/>";
            echo "<input type='hidden' name='imgLink' value='".$record['imgLink']."'/>";
            
            // Check to see if the most recent POST request has the same itemId
            // If so, display a differnt button
            if ($_POST['idplant'] == $record['idplant']) {
                echo "<td><button class='btn btn-success'>Added</button></td>";
            } else {
                echo "<td><button class='btn btn-success'>Add</button></td>";
            }
          echo "</form>";
          echo "</tr>";
          }
        echo "</tbody>";
        echo "</table>";
    
      } // end of if (isset($_SESSION['search-box']))
      
    } // end of displaySearchResults()

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
          
          displaySearchResults();
        ?>

    
        <script language="javascript" type="text/javascript" src="inc/functions.js"></script>
        </body>
</html>