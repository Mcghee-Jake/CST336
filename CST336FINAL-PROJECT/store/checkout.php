<?php
    $firstNameError = $lastNameError = $addressError = "";
    $error_msg = "* This is a required field";

    session_start();
    
    include '../dbConnection.php';
    
    $conn = getDatabaseConnection("plantdb");
    
    /* Process the customer form when it is submitted */
    if (isset($_POST['confirm-purchase']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['address'])) {
        
        // Insert customer
        $sql = "INSERT INTO customer (firstName, lastName, address) VALUES (:firstName, :lastName, :address)";
        $namedParameters = array();
        $namedParameters[':firstName'] = $_POST['firstName'];
        $namedParameters[':lastName'] = $_POST['lastName'];
        $namedParameters[':address'] = $_POST['address'];
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        $customer_id = $conn->lastInsertId();
        
    
        // Insert purchase
        $sql = "INSERT INTO purchase (purchaseDate, customer_idcustomer) VALUES (";
        $current_dateTime = "'".date("Y-m-d H:i:s")."'";
        $sql .= $current_dateTime.", ".$customer_id.")";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $purchase_id = $conn->lastInsertId();
        
        
        // Insert line items
        foreach ($_SESSION['cart'] as $plant) {
            $sql = "INSERT INTO lineItem (purchase_idpurchase, plant_idplant, quantity, priceDollar, priceCent) VALUES (";
            $sql .= $purchase_id.", ".$plant['idplant'].", ".$plant['quantity'].", ".$plant['priceDollar'].", ".$plant['priceCent'].")";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }
        
        // Clear the cart since the purchase has been completed
        unset($_SESSION['cart']);
        
        // Go to the purchase confirmation page
        header('Location: purchase-confirmation.php');
    }
    
    function displaySummery() {
        
        echo "<br>";
        echo "<div class='text-center'>";
        
        $total = 0;
        foreach($_SESSION['cart'] as $plant) {
            $subtotal = ($plant['priceDollar']+$plant[priceCent]/100)*$plant['quantity'];
            echo  $plant['plantName']." - $".$plant['priceDollar'].".".$plant['priceCent']." x (".$plant['quantity'].")"." = $".$subtotal."<br>";
            $total += $subtotal;
        }
        
        $taxRate = .065;
        $taxCost = bcdiv(($total * .065), 1, 2);
        $total += $taxCost;
        echo "Tax: $".$taxCost."<br>";
        
        $shippingCost = 5;
        $total += $shippingCost;
        echo "Shipping: $".$shippingCost."<br>";
        
        echo "<br><strong>Total: $".$total."</strong>";
        echo "</div>";
    }
    
        /* Makes sure that the user has entered something in the form */
    function checkIsSet($fieldName) {
        if (isset($_POST[$fieldName]) && empty($_POST[$fieldName])) {
            echo "<span class='error-msg'>* This is a required field</span>";
        } else {
            echo "<span class='invisible'>This is placeholder text, used for formatting</span>";
        }
    }
    
    /* Resets the filled form fields when there is an error */
    function repop($var) {
        if (isset($_POST[$var])) {
            echo $_POST[$var];
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
        ?>

        <br><br>
        <h2 class="text-center">Checkout</h2>
        
        <?php displaySummery() ?>
        
        <div class="checkout-form">
            <form method="post">
                <div class="form-row">
                    <div class="col">
                        <?php checkIsSet('firstName') ?>   
                        <input type="text" class="form-control" placeholder="First Name" name="firstName" value="<?php repop('firstName') ?>"><br>
                    </div>
                    <div class="col">
                        <?php checkIsSet('lastName') ?>
                        <input type="text" class="form-control" placeholder="Last Name" name="lastName" value="<?php repop('lastName') ?>"><br>
                    </div>
                </div>
                
                <?php checkIsSet('address') ?>   
                <input type="text" class="form-control" placeholder="E-mail Adress (e.g. janedoe@csumb.edu)" name="address" value="<?php repop('address') ?>"><br>
                
                <div class="text-center">
                   <input type="submit" name=confirm-purchase class="btn btn-success" value="Confirm Purchase">
                </div>
             
            </form>    
        </div>

    
    <script language="javascript" type="text/javascript" src="inc/functions.js"></script>
    </body>
</html>