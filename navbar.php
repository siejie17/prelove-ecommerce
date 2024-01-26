<!DOCTYPE html>
<link rel="stylesheet" href="style.css">
<?php
  include("conn.php");

  function getProfilePicture() {
    $customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : null;

    if ($customer_id) {
      global $conn;

      // User is logged in, retrieve the profile picture from the database
      $sql = "SELECT customer_profilePic FROM customer WHERE customer_id = $customer_id";
      $result = mysqli_query($conn, $sql);

      if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          return 'data:image/png;base64, ' . base64_encode($row['customer_profilePic']);
      }
    }

    return '<i class="fa fa-user-circle-o" aria-hidden="true" style="font-size:30px;"></i>';
  }

  function getCartNum($conn, $customer_id) {
    $cartNumsql = "SELECT COUNT(*) AS cart_num FROM cart WHERE customer_id = $customer_id";
    $cartNumResult = mysqli_query($conn, $cartNumsql);

    if ($cartNumResult && mysqli_num_rows($cartNumResult)) {
      $row = mysqli_fetch_assoc($cartNumResult);
      return $row['cart_num'];
    }
    return 0;
  }

  if(isset($_SESSION['customer_id'])) {
    $countRow = getCartNum($conn, $_SESSION['customer_id']);
  }
  
  $userProfilePicture = getProfilePicture();
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <header id="nav-menu" aria-label="navigation bar">
  <div class="container">
    <div class="nav-start">
      <a class="logo" href="index.php">
        <img src="assets/images/logo.png" width="128" height="35" alt="Inc Logo"/>
      </a>
      <nav class="menu">
        <ul class="menu-bar">
          <li><a class="nav-links" id="navbar-link" href="index.php">Home</a></li>
          <li>
            <button
              class="nav-links dropdown-btn"
              data-dropdown="dropdown1"
              aria-haspopup="true"
              aria-expanded="false"
              aria-label="browse"
            >
              Men
              <i class="bx bx-chevron-down" aria-hidden="true"></i>
            </button>
            <div id="dropdown1" class="dropdown">
              <ul role="menu">
                <li class="dropdown-title"> <span class="dropdown-link-title">Categories</span> </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="product_listing.php?type=1&category=1&text=<?php echo urlencode("Men's Top"); ?>">
                    <img src="./assets/icons/men-top.png" width="17" height="22"/>
                    Men's Top
                  </a>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="product_listing.php?type=1&category=2&text=<?php echo urlencode("Men's Bottom"); ?>">
                    <img src="./assets/icons/men-bottom.png" width="17" height="22"/>
                    Men's bottom
                  </a>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="product_listing.php?type=1&category=8&text=<?php echo urlencode("Men's Shoes"); ?>">
                    <img src="./assets/icons/men-shoes.png" width="17" height="22"/>
                    Men's shoes
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <button
              class="nav-links dropdown-btn"
              data-dropdown="dropdown2"
              aria-haspopup="true"
              aria-expanded="false"
              aria-label="discover"
            >
              Ladies
              <i class="bx bx-chevron-down" aria-hidden="true"></i>
            </button>
            <div id="dropdown2" class="dropdown">
              <ul role="menu">
                <li>
                  <span class="dropdown-link-title">Categories</span>
                </li>
                <li role="menuitem" class="menuItem">
                  <a class="dropdown-link" href="product_listing.php?type=2&category=1&text=<?php echo urlencode("Ladies' Top"); ?>">
                    <img src="./assets/icons/ladies-top.png" width="17" height="22"/>
                    Ladies' Top
                  </a>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="product_listing.php?type=2&category=2&text=<?php echo urlencode("Ladies' Bottom"); ?>">
                    <img src="./assets/icons/ladies-bottom.png" width="17" height="22"/>
                    Ladies' Bottom
                  </a>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="product_listing.php?type=2&category=3&text=<?php echo urlencode("Ladies' Sportwear"); ?>">
                    <img src="./assets/icons/ladies-sportwear.png" width="17" height="22"/>
                    Ladies' Sportwear
                  </a>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="product_listing.php?type=2&category=4&text=<?php echo urlencode("Dress"); ?>">
                    <img src="./assets/icons/ladies-dress.png" width="17" height="22"/>
                    Dress
                  </a>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="product_listing.php?type=2&category=5&text=<?php echo urlencode("Ladies' Blazer"); ?>">
                    <img src="./assets/icons/ladies-blazer.png" width="17" height="22"/>
                    Ladies' Blazer
                  </a>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="product_listing.php?type=2&category=6&text=<?php echo urlencode("Ladies' Jacket"); ?>">
                    <img src="./assets/icons/ladies-jacket.png" width="17" height="22"/>
                    Ladies' Jacket
                  </a>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="product_listing.php?type=2&category=7&text=<?php echo urlencode("Ladies' Hoodie"); ?>">
                    <img src="./assets/icons/ladies-hoodie.png" width="17" height="22"/>
                    Ladies' Hoodie
                  </a>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="product_listing.php?type=2&category=8&text=<?php echo urlencode("Ladies' Shoes"); ?>">
                    <img src="./assets/icons/ladies-shoes.png" width="17" height="22"/>
                    Ladies' Shoes
                  </a>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="product_listing.php?type=2&category=9&text=<?php echo urlencode("Ladies' Bag"); ?>">
                    <img src="./assets/icons/ladies-bag.png" width="17" height="22"/>
                    Ladies' Bag
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <button
              class="nav-links dropdown-btn"
              data-dropdown="dropdown3"
              aria-haspopup="true"
              aria-expanded="false"
              aria-label="browse"
            >
              Others
              <i class="bx bx-chevron-down" aria-hidden="true"></i>
            </button>
            <div id="dropdown3" class="dropdown">
              <ul role="menu">
                <li class="dropdown-title"> <span class="dropdown-link-title">Categories</span> </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="product_listing.php?type=3&category=10&text=<?php echo urlencode("Electronics"); ?>">
                    <img src="./assets/icons/electronics.png" width="17" height="22"/>
                    Electronics
                  </a>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="product_listing.php?type=3&category=11&text=<?php echo urlencode("Button Badge"); ?>">
                    <img src="./assets/icons/button-badge.png" width="17" height="22"/>
                    Button Badge
                  </a>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="product_listing.php?type=3&category=12&text=<?php echo urlencode("Authorized Album"); ?>">
                    <img src="./assets/icons/album.png" width="17" height="22"/>
                    Authorized Album
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li><a class="nav-links" id="navbar-link" href="requests.php">Requests</a></li>
          <li><a class="nav-links" id="navbar-link" href="contact-us.php">Contact</a></li>
          <li><a class="nav-links" id="navbar-link" href="testimonials.php">Testimonials</a></li>
          <li><a class="nav-links" id="navbar-link" href="faqs.php">FAQs</a></li>
        </ul>
      </nav>
    </div>
    <div class="nav-end">
      <div class="sright-container">
        <form class="search" role="search" action="search.php" method="GET">
          <input type="search" name="search" placeholder="Search" />
          <i class="bx bx-search" aria-hidden="true"></i>
        </form>
        <?php
          if(isset($_SESSION['customer_id'])) { ?>
            <div class="dropdown-container">
            <button
              class="nav-links dropdown-btn"
              data-dropdown="dropdown4"
              aria-haspopup="true"
              aria-expanded="false"
              aria-label="discover"
            >
              <img
                src="<?php echo $userProfilePicture; ?>"
                width="30"
                height="30"
                alt="user image"
              />
              </button>
              <div id="dropdown4" class="dropdown">
              <ul role="menu">
                <li role="menuitem">
                  <a class="dropdown-link" href="my-profile.php">
                    My Account
                  </a>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="my-order.php">
                    My Order
                  </a>
                </li>
                <li role="menuitem">
                  <form action="logout.php">
                    <button type="submit" style="background-color: red; border-radius: 5px; width: 200px; height: 25px; color: white;">Logout</submit>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        <?php 
        } else {
        ?> 
          <a href="login.php" id="navbar-link">
            <?php echo $userProfilePicture; ?>
          </a>
        <?php  
        }
        ?>
        <a href="<?php
          if (isset($_SESSION["customer_id"])) {
              echo "cart.php";
          } else {
              echo "login.php";
          }
        ?>" class="cart-overall">
        <i class="fa fa-shopping-cart" id="navbar-link"></i>
        <?php
          if (isset($_SESSION["customer_id"])) {
              echo '<span id="cartCount">' . $countRow . '</span>';
          }
        ?>
      </a>
      </div>

      <button
        id="hamburger"
        aria-label="hamburger"
        aria-haspopup="true"
        aria-expanded="false"
      >
        <i class="bx bx-menu" aria-hidden="true"></i>
      </button>
    </div>
  </div>
</header>