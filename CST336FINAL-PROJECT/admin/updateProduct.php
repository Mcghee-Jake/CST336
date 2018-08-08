<?php 
     include 'dbConnection.php';
     
    if(isset($_GET['idplant'])) {
        $plant = getProductInfo();
    }
    
       function getProductInfo() {
        
        $conn = getDatabaseConnection();
        
        $sql = "SELECT * 
                FROM plant
                WHERE idplant=".$_GET['idplant'];
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $record;
    }
    

    if (isset($_GET['updateProduct'])) {
        
        if($_GET['imgLink']==null){
           $_GET['imgLink']="img/noImg.jpg";
        }
        if ($_GET['plantName']==null){
              $message = "No name provided";
              echo "<script type='text/javascript'>alert('$message');</script>";
          }if(is_numeric($_GET['priceDollar'])==false ||is_numeric($_GET['priceCent']==false)){
              $message = "Please enter numeric values for prices";
              echo "<script type='text/javascript'>alert('$message');</script>";
          }
          else{
         
        $conn = getDatabaseConnection();
        
        $sql = "UPDATE plant
                SET plantName = :plantName,
                    plantDesc = :productDescription,
                    priceDollar = :priceDollar,
                    priceCent = :priceCent,
                    imgLink = :imgLink
               WHERE idplant = :idplant";
                
        $np = array();
        
        $np[":idplant"] = $_GET['idplant'];
        $np[":plantName"] = $_GET['plantName'];
        $np[":productDescription"] = $_GET['description'];
        $np[":priceDollar"] = $_GET['priceDollar'];
        $np[":priceCent"] = $_GET['priceCent'];
        
        $np[":imgLink"] = $_GET['imgLink'];

        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
                
        header('Location:admin.php');
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Update Product </title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

                <h1> Update Product</h1>
                <form method="get" onsubmit="return confirmUpdate()">
                    <input type="hidden" name="idplant" value="<?=$plant['idplant']?>"/>
                    <strong> Product name </strong>
                    <input type="text" class="form-control" value="<?=$plant['plantName']?>" name="plantName"><br>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="5" id="description" name="description"><?=$plant['plantDesc']?></textarea>
                    </div>
                    <strong>Price Dollar</strong><input type="text" class="form-control" name="priceDollar" value="<?=$plant['priceDollar']?>" ><br>
                    <strong>Price Cent</strong><input type="text" class="form-control" name="priceCent" value="<?=$plant['priceCent']?>" ><br>
                   
                    <strong>Set Image Url</strong><input type="text" name = "imgLink" class="form-control" value="<?=$plant['imgLink']?>"><br>
                    <input type="submit"  name="updateProduct"  class="btn btn-primary" value="Update Product">
                    <a href="admin.php" class="btn btn-warning pull-right" >Cancel</a>

                </form>
            </div>
        </div>
         <script>
                function confirmUpdate() {
                    return confirm('Confirm Update');
                }
        </script>

    </body>
</html>