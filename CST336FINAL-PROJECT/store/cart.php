<?php
    session_start();
    
    // If 'itemId' quantity has been sent, search for this item and update the quantity
    if (isset($_POST['updateId'])) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['idplant'] == $_POST['updateId']) {
                $item['quantity'] = $_POST['update'];
            }
        }
    }
    
    // If 'removeId' has been sent, search the cart for that itemId and unset it
    if (isset($_POST['removeId'])) {
        foreach ($_SESSION['cart'] as $itemKey => $item) {
            if ($item['idplant'] == $_POST['removeId']) {
                unset($_SESSION['cart'][$itemKey]);
            }
        }
    }
    
    function displayCart() {
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            
            echo "<table class='table table-hover'>";
            echo "<thead>
                    <tr>
                        <th scope='col'>Image</th>
                        <th scope='col'>Plant Name</th>
                        <th scope='col'>Description</th>
                        <th scope='col'>Unit Price</th>
                        <th scope='col'>Quantity</th>
                        <th scope='col'>Sub Total</th>
                        <th scope='col'> </th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            foreach ($_SESSION['cart'] as $plant) {
                
                // Display item as table row
                echo "<tr>";
                echo "<td><img src='../".$plant['imgLink']."'></td>";
                echo "<td>".$plant['plantName']."</td>";
                echo "<td>".$plant['plantDesc']."</td>";
                echo "<td>$".$plant['priceDollar'].".".$plant['priceCent']."</td>";
                
                // Update form for this item
                echo "<form method='post'>";
                echo "<input type='hidden' name='updateId' value='".$plant['idplant']."'/>";
                echo "<td><input type='text' name='update' class='form-control quantity-entry' value='".$plant['quantity']."'/></td>";
                echo "<td>$".($plant['priceDollar']+$plant[priceCent]/100)*$plant['quantity']."</td>";
                echo "<td><button class='btn btn-warning'>Update</button>";
                echo "</form>";
                echo "<br><br>";
                
                // Hidden input element containing the item name
                echo "<form method='post'>";
                echo "<input type='hidden' name='removeId' value='".$plant['idplant']."'>";
                echo "<button class='btn btn-warning'>Remove</button></td>";
                echo "</form>";
                
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<br><br><br><br><br><br>";
            echo "<div class='text-center'><h4>Your cart is empty</h4></div>";    
        }
        
    } // end displayCart()
    
    function displayCartTotal() {
        if (!empty($_SESSION['cart'])) {
            $total = 0;
        
            foreach($_SESSION['cart'] as $plant) {
                $total += ($plant['priceDollar']+$plant[priceCent]/100)*$plant['quantity'];
            }
            
            echo "<div class='text-center font-weight-bold'>";
            echo "<h4>Total: $".$total."</h4>";
            echo "<a href='checkout.php'>";
            echo "<button class='btn btn-success mt-2'><h2>Checkout</h2></button>";
            echo "</a></div>";
        }
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
          
          displayCart();
          displayCartTotal();
         
        ?>

    
    <script language="javascript" type="text/javascript" src="inc/functions.js"></script>
    </body>
</html>