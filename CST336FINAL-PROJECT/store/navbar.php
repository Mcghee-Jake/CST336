<?php
    session_start();
  
    /* Makes sure that text forms stay filled after searching */
    function retext($var) {
        if (isset($_SESSION[$var])) {
            echo $_SESSION[$var];
        }
    }
    
    /* Makes sure that the correct btn is selected after searching */
    function reradio($var, $val) {
      if ($_SESSION[$var] == $val) {
        echo " checked";
      }
    }
    
    /* Makes the default radio buttons checked */
    function defaultRadio($var) {
        if (!isset($_SESSION[$var])) echo " checked";
    }
    
    function displayCartCount() {
        echo count($_SESSION['cart']);
    }
?>

        <!-- Bootstrap Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
          <a class="navbar-brand" href="index.php">
            <span id="teeny-shop">Teeny Shop</span>
            <span id="of"> of</span>
            <span id="horrors"> Horrors</span>
            </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <!-- Search and Filter -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              
              <!-- Search -->
              <li class="nav-item">
                  <form id="search-form" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" name="search-box" type="text" placeholder="Search" aria-label="Search" value=<?php retext('search-box') ?>>
                    <button id="search-btn" class="btn my-2 my-sm-0 navbar-btn" type="submit">Search</button>
                  </form>
              </li>
              
              <!-- Filter -->
              <li class="nav-item dropdown ml-2">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="../img/filter.svg" width="30" height="30" alt="">
                <span id="filter">FILTER</span>
                </a>
                <div class="dropdown-menu">
                  
                  <form id="filter-form">
                    <!-- Order by -->
                    <div class="px-4 py-3 text-center" >
                      <span class="navbar-form-header">Order by</span>
                      <br><br>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="order-by" id="order-by1" value="name ASC" <?php defaultRadio("order-by"); reradio("order-by", "name ASC") ?>>
                        <label class="form-check-label" for="order-by1">Name (Ascending)</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="order-by" id="order-by2" value="name DESC" <?php reradio("order-by", "name DESC") ?>>
                        <label class="form-check-label" for="order-by2">Name (Descending)</label>
                      </div>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="order-by" id="order-by3" value="price ASC" <?php reradio("order-by", "price ASC") ?>>
                        <label class="form-check-label" for="order-by3">Price (Ascending)</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="order-by" id="order-by4" value="price DESC" <?php reradio("order-by", "price DESC") ?>>
                        <label class="form-check-label" for="order-by4">Price (Descending)</label>
                      </div>  
                    </div>
                    
                    <div class="dropdown-divider"></div>
                    
                    <!-- Search by -->
                    <div class="px-4 py-3  text-center">
                      <span class="navbar-form-header">Search by</span>
                      <br><br>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="search-by" id="search-by1" value="name" <?php defaultRadio("search-by"); reradio("search-by", "name") ?>>
                        <label class="form-check-label" for="search-by1">Name</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="search-by" id="search-by2" value="description" <?php reradio("search-by", "description") ?>>
                        <label class="form-check-label" for="search-by2">Description</label>
                      </div>
                    </div>
                    
                    <div class="dropdown-divider"></div>
                    
                    <!-- Price Range -->
                    <div class="px-4 py-3  text-center">
                      <span class="navbar-form-header">Price</span>
                      <br><br>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">From:</span>
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" name="priceFrom" class="form-control" value=<?php retext('priceFrom')?>>
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                      </div>
                      <div class="input-group mb-3" >
                          <div class="input-group-prepend" >
                              <span class="input-group-text">To: </span>
                              <span class="input-group-text">$</span>
                          </div>
                          <input type="text" name="priceTo" class="form-control" value=<?php retext('priceTo')?>>
                          <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                          </div>
                      </div>
                    </div>
                    
                  </form>
                  
                </div>
              </li>
            </ul>
            
            <!-- Cart Icon -->
            <a href='cart.php' class='cart ml-auto'>
              <img src='../img/shopping-cart.svg'>
              Cart: <?php displayCartCount() ?>
            </a>
            
            <!-- Admin Button -->
            <form class="form-inline ml-5">
                <a href="../admin/login.php"><button class="btn navbar-btn" type="button">Admin</button></a>
            </form>
            
          </div>
        </nav>
        
        