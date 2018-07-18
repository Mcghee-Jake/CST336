<?php
    include 'dbConnection.php';
    
    session_start();
    
    $conn = getDatabaseConnection("ottermart");
    
    function getCategories() {
        global $conn;
        $sql = "SELECT catId, catName FROM om_category ORDER BY catName";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo "<option ";
            echo ($record["catId"] == $catId)? "selected" : "";
            echo " value='".$record['catId']."'>".$record['catName']." </option>";
        }
    }
    
    function getProductInfo() {
        global $conn;
        $sql = "SELECT * FROM om_product WHERE productId = ".$_GET['productId'];
        $statement = $conn->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $record;
    }
    
    if (isset($_GET['productId'])) {
        $product = getProductInfo();
    }
    
    if (isset($_GET['updateProduct'])) {
        
        $sql = "UPDATE om_product
                SET productName = :productName,
                    productDescription = :productDescription,
                    productImage = :productImage,
                    price = :price,
                    catId = :catId
                WHERE productId = :productId";
        
        $namedParameters = array();
        $namedParameters[':productName'] = $_GET['productName'];
        $namedParameters[':productDescription'] = $_GET['description'];
        $namedParameters[':productImage'] = $_GET['productImage'];
        $namedParameters[':price'] = $_GET['price'];
        $namedParameters[':catId'] = $_GET['catId'];
        $namedParameters[':productId'] = $_GET['productId'];
        
        $statement = $conn->prepare($sql);
        $statement->execute($namedParameters);
        
        header("Location: admin.php");
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ottermart Admin</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>
        
        <form class="shrink">
            <input type="hidden" name="productId" value="<?=$product['productId']?>"/>
            <strong>Product name</strong> <input type="text" class="form-control" value="<?=$product['productName']?>" name="productName"><br>
            <strong>Description</strong> <textarea name="description" class="form-control" cols=50 rows=4><?=$product['productDescription']?></textarea><br>
            <strong>Price</strong> <input type="text" class="form-control" name="price" value="<?=$product['price']?>"><br>
            <strong>Category</strong> <select name="catId" class="form-control">
                <option value="">Select One</option>
                <?php getCategories($product['catId']); ?>
            </select><br>
            <strong>Set Image Url</strong> <input type="text" name="productImage" class="form-control" value="<?=$product['productImage']?>"> <br>
            <input type="submit" name=updateProduct class="btn btn-primary" value="Update Product">
            </select>
        </form>
    
    </body>
</html>