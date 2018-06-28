<?php

    $backgroundImage = "img/sea.jpg";
    
    if (isset($_GET['keyword']) && !empty($_GET['keyword']) || isset($_GET['category']) && !empty($_GET['category'])) {
        include 'api/pixabayAPI.php';
        (isset($_GET['category']) && !empty($_GET['category'])) ? $searchterm = $_GET['category'] : $searchterm = $_GET['keyword'];
        if (isset($_GET['layout']) && !empty($_GET['layout'])) {
            $imageURLs = getImageURLs($searchterm, $_GET['layout']);
        } else {
            $imageURLs = getImageURLs($searchterm);
        }
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
?>

<!DOCTYPE html>
<html>
        <title>Image Carousel</title>
        <meta charset='utf-8'>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <style>
            @import url("css/styles.css");
            body {
                background-image: url('<?=$backgroundImage ?>');
            }
        </style>
        <body>
            <br/><br/>
            
            <form>
                <input type="text" name="keyword" placeholder="Keyword" id="">
                
                <div id="layout-div">
                    <input type="radio" name="layout" value="horizontal" id="layout_h" />
                    <label for="layout_h"> Horizontal </label>
                    <br/>
                    <input type="radio" name="layout" value="vertical" id="layout_v" />
                    <label for="layout_v"> Vertical </label>
                </div>
                
                <br/>
                
                <select name="category">
                    <option value =""> - Select One - </option>
                    <option> Cat </option>
                    <option> Monkey </option>
                    <option> Wolf </option>
                    <option> Otter </option>
                </select><br /><br />
                
                <input type="submit" value="Search" />
            </form>
            
            <br/><br/>
            
            <?php
                if (!isset($imageURLs)) {
                    echo "<h2> Type a keyword to display a slideshow <br/> with random images from Pixabay.com </h2>";
                } else {
            ?>
            
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators Here -->
                <ol class="carousel-indicators">
                    <?php
                        for ($i = 0; $i < 7; $i++) {
                            echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                            echo ($i == 0) ? "class='active'" : "";
                            echo "></li>";
                        }
                    ?>
                </ol>
                
                <!-- Wrapper for Images -->
                <div class="carousel-inner" role="listbox">
                    <?php
                        for ($i = 0; $i < 7; $i++) {
                                do {
                                    $randomIndex = rand(0, count($imageURLs));
                                } while (!isset($imageURLs[$randomIndex]));
                                
                                echo '<div ';
                                echo 'class="carousel-item';
                                echo ($i == 0) ? " active" : "";
                                echo '">';
                                echo '<img src="' . $imageURLs[$randomIndex] . '">';
                                echo '</div>';
                                unset($imageURLs[$randomIndex]);
                        }
                    ?>
                </div>
                
                <!-- Controls Here -->
                <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            
            <?php
                }
            ?>
            

            <br/><br/>
            
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        </body>
</html>