<?php
if (isset($_GET['logOut'])) {
    session_start();
    session_destroy();
    header('Location:login.php');
} else {

    session_start();
    include 'dbConnection.php';

     if(isset($_GET['submitProduct'])) {
          if($_GET['imgLink']==null) {
                $_GET['imgLink'] = "img/noImg.jpg";
          }
          if ($_GET['plantName']==null){
              $message = "No name provided";
              echo "<script type='text/javascript'>alert('$message');</script>";
          }if(is_numeric($_GET['priceDollar'])==false ||is_numeric($_GET['priceCent']==false)){
              $message = "Please enter numeric values for prices";
              echo "<script type='text/javascript'>alert('$message');</script>";
          }
          else{
         
        $plantName = $_GET['plantName'];
        $plantDesc = $_GET['plantDesc'];
        $priceDollar = $_GET['priceDollar'];
        $priceCent = $_GET['priceCent'];
        $imgLink = $_GET['imgLink'];
        
        $sql = "INSERT INTO plant
                (plantName, plantDesc, priceDollar, priceCent, imgLink)
                VALUES (:plantName, :plantDesc,:priceDollar,:priceCent,:imgLink)";
                
                $nameParameters = array();
                $nameParameters[':plantName'] = $plantName;
                $nameParameters[':plantDesc'] = $plantDesc;
                $nameParameters[':priceDollar'] = $priceDollar;
                $nameParameters[':priceCent'] = $priceCent;
                $nameParameters[':imgLink'] = $imgLink;

                $conn = getDatabaseConnection();
                $stmt = $conn->prepare($sql);
                $stmt->execute($nameParameters);
                $_SESSION['prodAdded']=$_GET['plantName'];;
                header('Location:admin.php');
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Add a product </title>
        
        

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <link rel="stylesheet" href="styles/main.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy|Nosifer" rel="stylesheet">

    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand">
                <span id="teeny-shop">Teeny Shop</span>
                <span id="of"> of</span>
                <span id="horrors"> Horrors</span>
            </a>
        </nav>

        <div class='container'>
            <div class='well'>

                <h1> Add a product</h1>
                <form >
                    <strong> Product name </strong> <input type="text" class="form-control" name="plantName"><br>
                    <div class="form-group">
                        <label for="plantDesc">Plant Description</label>
                        <textarea class="form-control" rows="5" id="plantDesc" name="plantDesc"></textarea>
                    </div>
                    <strong>Price Dollar</strong><input type="text" class="form-control" name="priceDollar"><br>
                    <strong>Price Cent</strong><input type="text" class="form-control" name="priceCent"><br>
                    <strong>Set Image Url</strong><input type = "text" name = "imgLink" class="form-control"><br>
                    <input type="submit" name="submitProduct"  class="btn btn-primary" value="Add Product">
                    <a href="admin.php" class="btn btn-warning pull-right" >Cancel</a>
                </form>
            </div>
        </div>
    </body>
</html>