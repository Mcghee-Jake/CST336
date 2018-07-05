<?php

    function get_creature($alive_lvl, $time, $habitat, $diet, $power) {
      $creatures = array("unicorn" => 0, "forest_elf" => 0, "ghost" => 0, "witch" => 0, "zombie" => 0, "vampire" => 0, "werewolf" => 0);
      
      if (!empty($alive_lvl) && !empty($time) && !empty($habitat) && !empty($diet) && !empty($power)) { // If all fields are entered
        
        // Set score based on form 1
        if ($alive_lvl <= 25) {
          $creatures["ghost"] += 25;
          $createres["zombie"] += 25;
          $creatures["vampire"] += 15;
        } else if ($alive_lvl <= 50) {
          $creatures["zombie"] += 15;
          $creatures["vampire"] += 25;
        } else if ($alive_lvl <= 75) {
          $creatures["witch"] += 25;
          $creatures["werewolf"] += 25;
          $creatures["vampire"] += 15;
          $creatures["forest_elf"] += 15;
        } else if ($alive_lvl < 100) {
          $creatures["unicorn"] += 25;
          $creatures["forest_elf"] += 25;
          $creatures["witch"] += 15;
          $creatures["werewolf"] += 15;
          $creatures["vampire"] += 15;
        } else if ($alive_lvl == 100) {
          $creatures["unicorn"] += 35;
          $creatures["forest_elf"] += 25;
          $creatures["witch"] += 15;
          $creatures["werewolf"] += 15;
          $creatures["vampire"] += 15;
        }
          
        // Set score based on form 2
        switch($time) {
          case "day":
            $creatures["unicorn"] += 25;
            $creatures["forest_elf"] += 25;
            break;
          case "night":
            $creatures["vampire"] += 25;
            $creatures["werewolf"] += 25;
            $creatures["ghost"] += 25;
            $creatures["zombie"] += 15;
            break;
          case "either":
            $creatures["zombie"] += 25;
            $creatures["witch"] += 25;
            break;
        }
        
        // Set score based on form 3
        foreach($habitat as $value) {
          switch ($value){
            case "forest":
              $creatures["forest_elf"] += 25;
              $creatures["unicorn"] += 15;
              $creatures["witch"] += 15;
              $creatures["zombie"] += 15;
              break;
            case "old-houses":
              $creatures["ghost"] += 25;
              $creatures["witch"] += 15;
              $creatures["zombie"] += 15;
              break;
            case "castle":
              $creatures["unicorn"] += 25;
              $creatures["vampire"] += 25;
              $creatures["werewolf"] += 25;
              break;
            case "cemetery":
              $creatures["zombie"] += 25;
              $creatures["vampire"] += 15;
              $creatures["ghost"] += 15;
              break;
          }
        }
        
        // Set score based on form 4
        switch ($diet) {
            case "flesh":
              $creatures["zombie"] += 25;
              $creatures["werewolf"] += 25;
              break;
            case "blood":
              $creatures["vampire"] += 15;
              break;
            case "rat-tails":
              $creatures["witch"] += 25;
              break;
            case "wild-mushrooms":
              $creatures["forest_elf"] += 25;
              $creatures["unicorn"] += 25;
              break;
            case "none":
              $creatures["ghost"] += 25;
              break;
        }
        
        // Set score based on form 5
        switch ($power) {
            case "magic":
              $creatures["unicorn"] += 25;
              $creatures["witch"] += 25;
              break;
            case "nature":
              $creatures["forest_elf"] += 25;
              break;
            case "virus":
              $creatures["zombie"] += 25;
              $creatures["werewolf"] += 25;
              $creatures["vampire"] += 25;
              break;
            case "other":
              $creatures["ghost"] += 25;
              break;
        }
          
        // Get result
        $highest_scores = array_keys($creatures, max($creatures));
        $creature = $highest_scores[array_rand($highest_scores)];
        
        return $creature;
      }
    }
    
    function display_creature($creature) {
      if (isset($creature)) {
        echo '<div id="creature_display">';
        echo '<h1 id="creature-title">' . format_creature_name($creature) . '</h1>';
        echo '<img src="img/' . $creature . '.jpg" />';
        echo '</div><br><br>';
      }
    }
    
    function format_creature_name($creature) {
      $creature = str_replace("_", " ", $creature);
      $creature = ucwords($creature);
      
      return $creature;
    }
    
    function repop($var) {
      if (!empty($var)) {
          echo 'value="' . $var .'"';
      }
    }
    
    function reradio($var, $val) {
      if ($var == $val) {
        echo 'checked="checked"';
      }
    }
    
    function recheck($array, $val) {
      if (in_array($val, $array)) {
        echo 'checked="checked"';
      }
    }
    
    function reselect($var, $val) {
      if ($var == $val) {
        echo 'selected';
      }
    }
?>