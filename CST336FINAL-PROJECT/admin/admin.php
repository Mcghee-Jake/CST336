<?php
session_start();

if (!isset($_SESSION['adminName'])) {
    header("Location:login.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="styles/main.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy|Nosifer" rel="stylesheet">
        <title>Admin Main Page</title>
    </head>

    <body > 

        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" >
                <span id="teeny-shop">Teeny Shop</span>
                <span id="of"> of</span>
                <span id="horrors"> Horrors</span>
            </a>
        </nav>

        <div class='container'>
            <div class="dropdown">
                <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" >REPORTS
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li data-toggle="modal" data-target="#myModal"><a href="#" id="avg">AVG  PRICE</a></li>
                    <li data-toggle="modal" data-target="#myModal"><a href="#" id ="max">MAX  PRICE</a></li>
                    <li data-toggle="modal" data-target="#myModal"><a href="#" id ="sum">SUM PRICES</a></li>
                </ul>
            </div>


            <div  class="text-center">
                <h1> Admin Main Page</h1>
            </div>


            <div>

                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content" style="background-color:gray;">
                            <div class="modal-body"> 
                                <div class='text-center' id="dialog-modal">
                                    <div id="displaysum"></div>
                                    <div id="displayavg"></div>
                                    <div id="displaymax"></div>
                                    <br>
                                </div> 
                            </div>
                        </div>
                    </div>

                </div>

                <?php

                function displayAllProducts() {
                    include "dbConnection.php";
                    $conn = getDatabaseConnection();

                    $sql = "SELECT * FROM plant ORDER BY idplant";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    return $records;
                }

                $records = displayAllProducts();


                echo "<div class='container' >";

                echo "<div class='span2' >
                    <form action='addProduct.php'>
                        <button type='submit' class='btn btn-success' id='beginning' name='addProduct' value='Add Product'>Add Product</button>
                        <input type='submit' style='float:right;' class='btn btn-warning' id='beginning' name='logOut' value='  Log Out  '/>
                    </form>
                 </div>";

                echo "<table class='table table-hover'>";

                echo
                "<thead>
                <tr>
                   <th scope = 'col'>Image</th>
                   <th scope = 'col'>Plant Name</th>
                   <th scope = 'col'>Description</th>
                   <th scope = 'col'>Price</th>
                   <th scope = 'col'>Update</th>
                   <th scope = 'col'>Remove</th>
                </tr>
              </thead>";


                echo "<tbody>";

                foreach ($records as $record) {
                    echo"<div id='$counter'>";
                    echo "<tr>";
                    $img = "../" . $record['imgLink'];
                    if ($record['imgLink'] == null) {
                        $img = "img/noImg.jpg";
                    }

                    echo "<td><a target='_blank' href=" . $img . "><img src=" . $img . " alt='No Image' class='imagePlant'></td>";
                    echo "<td>" . $record['plantName'] . "</td>";
                    echo "<td>" . $record['plantDesc'] . "</td>";
                    echo "<td>" . "$" . $record['priceDollar'] . "." . $record['priceCent'] . "</td>";
                    echo "<td><a class='btn btn-primary' href='updateProduct.php?idplant=" . $record['idplant'] . "'>Update</a></td>";

                    echo '<form action="deleteProduct.php" method="get" onsubmit="return confirmDelete()">';

                    echo "<input type='hidden' name='idplant' value='" . $record['idplant'] . "'>";
                    echo "<td><input type='submit' class='btn btn-danger' name='deleteProduct' value='Remove' id='dlt'></td>";
                    echo "</form>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
                ?>

                <script>
                    function confirmDelete() {
                        return confirm("Are you sure you want to delete the product?");
                    }
                </script>


                <?php
                if ($_SESSION['prodAdded'] != '') {
                    $_SESSION['prodAdded'] .= ": Has been succesfully added";
                }
                ?>
                <p id="last" style="padding-left: 30px; color:magenta;">
                    <?= $_SESSION['prodAdded']; ?>
                </p>

            </div>
        </div>    

        <script>
            var json;

            $(document).ready(function () {
                $.ajax({
                    url: "aggregateFunc.php",
                    success: function (data) {
                        json = JSON.parse(data);

                        displayResult(json);

                        console.log(json);

                        $("#displaysum").html(json.sum);
                        $("#displayavg").html(json.avg);
                        $("#displaymax").html(json.max);

                        $("#displaymax").hide();
                        $("#displayavg").hide();
                        $("#displaysum").hide();
                    }
                });

            });

            function displayResult(json) {

                $("ul li a").click(function () {
                    var liValue = $(this).attr('id');
                    $.each(json, function (index, value) {
                        if (index === liValue) {
                            //  alert("the selected value: " + value);
                            $("#display" + index).html("The '" + index + "' of all prices is " + value);
                            $("#display" + index).show();
                            $("#display" + index).css({'color': 'white',
                                'font-size':'20px',
                                'width': '40%',
                                'margin': 'auto'});
                        } else {
                            $("#display" + index).hide();
                        }

                        $("#clear").click(function () {
                            $("#display" + index).hide();
                        });
                    });
                });
            }

        </script>

    </body>

    <?php
    if ($_SESSION['prodAdded'] != '') {
        echo"<script>
        var height = 0;
        $('div').each(function (i, value) {
            height += parseInt($(this).height());
        });

        height += '';

        $('div').animate({scrollTop: height});
    </script>";
    }

    $_SESSION['prodAdded'] = '';

    include '../php/footer.php';  //includes the footer
    ?>

</html>

