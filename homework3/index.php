<?php
include 'functions.php';

$alive_lvl = $time = $diet = $power = "";
$habitat = array();
$alive_lvl_error = $time_error = $habitat_error = $diet_error = $power_error = "";
$error_msg = "* This is a required field *";


// Get values from form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST["alive_lvl"])) {
    $alive_lvl_error = $error_msg;
  } else {
    $alive_lvl = $_POST["alive_lvl"];
  }
  
  if (empty($_POST["time"])) {
    $time_error = $error_msg;
  } else {
    $time = $_POST["time"];
  }
  
  if (empty($_POST["habitat"])) {
    $habitat_error = $error_msg;
  } else {
    foreach($_POST["habitat"] as $value) {
        array_push($habitat, $value);
    }
  }
  
  if (empty($_POST["diet"])) {
    $diet_error = $error_msg;
  } else {
    $diet = $_POST["diet"];
  }
  
  if (empty($_POST["power"])) {
    $power_error = $error_msg . "<br>";
  } else {
    $power = $_POST["power"];
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
  <title> Mythical Creature Quiz </title>
  <link href="css/styles.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css?family=Eagle+Lake|UnifrakturCook:700" rel="stylesheet">
  </head>
  
  <body>
    
    <div id="title">
      <h1> Which Mythical Creature Are You? </h1>
    </div><br>
    
  
    <form id="form1" method="post">
      <br>
      <p> On a scale of 1 to 100, how alive are you feeling today </p><br>
      <input type="number" name="alive_lvl" min="0" max="100" <?php repop($alive_lvl) ?>><br><br>
      <span class="error"><?php echo $alive_lvl_error; ?></span>
      
      <hr>
      
      <p> When are you most likely to be seen? </p><br>
      <label for="day"> Day </label>
      <input type="radio" name="time" id="day" value="day" <?php reradio($time, "day") ?>><br>
      <label for="night"> Night </label>
      <input type="radio" name="time" id="night" value="night" <?php reradio($time, "night") ?>><br>
      <label for="either"> Either </label>
      <input type="radio" name="time" id="either" value="either" <?php reradio($time, "either") ?>><br><br>
      <span class="error"><?php echo $time_error; ?></span>
      
      <hr>
      
      <p> Where are you likely to be found? (Select all that apply) </p><br>
      <label for="forest"> Forest </label>
      <input type="checkbox" name="habitat[]" id="forest" value="forest" <?php recheck($habitat, "forest") ?>><br>
      <label for="old-houses"> Old Houses </label>
      <input type="checkbox" name="habitat[]" id="old-houses" value="old-houses" <?php recheck($habitat, "old-houses") ?>><br>
      <label for="castle"> Castle </label>
      <input type="checkbox" name="habitat[]" id="castle" value="castle" <?php recheck($habitat, "castle") ?>><br>
      <label for="cemetery"> Cemetery </label>
      <input type="checkbox" name="habitat[]" id="cemetery" value="cemetery" <?php recheck($habitat, "cemetery") ?>><br><br>
      <span class="error"><?php echo $habitat_error; ?></span>
      
      <hr>
      
      <p> Which sounds the most appetizing to you? </p><br>
      <select name="diet">
        <option value=""> </option>
        <option value="flesh" <?php reselect($diet, "flesh") ?>> Flesh </option>
        <option value="blood" <?php reselect($diet, "blood") ?>> Blood </option>
        <option value="rat-tails" <?php reselect($diet, "rat-tails") ?>> Rat Tails </option>
        <option value="wild-mushrooms" <?php reselect($diet, "wild-mushrooms") ?>> Wild Mushrooms </option>
        <option value="none" <?php reselect($diet, "none") ?>> None of these sound very appetizing </option>
      </select><br><br>
      <span class="error"><?php echo $diet_error; ?></span>
      
      <hr>
      
      <p> Where do you draw your power from? </p><br>
      <select name="power">
        <option value=""> </option>
        <option value="magic" <?php reselect($power, "magic") ?>> Magic </option>
        <option value="nature" <?php reselect($power, "nature") ?>> Nature </option>
        <option value="virus" <?php reselect($power, "virus") ?>> Virus/Disease </option>
        <option value="other" <?php reselect($power, "other") ?>> Other </option>
      </select><br><br>
      <span class="error"><?php echo $power_error; ?></span>
      
      <br>
      
    </form>
    
    <br><br>
    
    <button type="submit" form="form1" value="Submit"> Submit </button>
    
    <br><br>
    
    <?php
      $creature = get_creature($alive_lvl, $time, $habitat, $diet, $power);
      display_creature($creature);
    ?>
    
  
  </body>
  
</html>