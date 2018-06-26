<?php

    function play() {
        $all_kittens = array("bagel", "banana", "beans", "burrito", "kiwi", "leche", "meatball", "milkshake", "noodle", "pepperoni", "pickle", "waffle");
        
        $kitten_basket = get_kitten_basket($all_kittens);
        display_kittens($kitten_basket);
       
        $letter_count = count_letters($kitten_basket);
        display_letter_count($letter_count);
        
        display_refresh_btn();
    }
    
    function get_kitten_basket($all_kittens) {
        shuffle($all_kittens);
        $basket_size = rand(3,6);
        return $kitten_basket = array_slice($all_kittens, 0, $basket_size);
    }
    
    function display_kittens($kitten_basket) {
        echo "<div id=kitten_container>";
        for ($i = 0; $i < count($kitten_basket); $i++) {
            echo "<div class=portrait>";
            echo "<img src='img/" . $kitten_basket[$i] . ".jpg' />";  
            echo "<h3>" . ucfirst($kitten_basket[$i]) . "</h3>";
            echo "</div>";
        }
        echo "</div>";
    }
    
    function count_letters($kitten_basket) {
        $letter_count = array();
        for ($i = 0; $i < count($kitten_basket); $i++) {
            $name = $kitten_basket[$i];
            for ($j = 0; $j < strlen($name); $j++) {
                $letter = $name[$j];
                if (array_key_exists($letter, $letter_count)) {
                    $letter_count[$letter] += 1;
                } else {
                    $letter_count[$letter] = 1;
                }
            }
        }
        ksort($letter_count);
        return $letter_count;
    }
    
    function display_letter_count($letter_count) {
        echo "<br/><br/><div id=letter_counts_container><div id=letter_counts>";
        $i = 0;
        foreach($letter_count as $letter => $count) {
            echo strtoupper($letter) . " = " . $count;
            if (++$i != count($letter_count)) {
                echo "&nbsp;&nbsp;&nbsp;";
            }
        }
        echo "</div></div>";
    }
    
    function display_refresh_btn() {
        echo "<br/><br/><form><input type='submit' value='Refresh'/></form>";
    }

    
?>