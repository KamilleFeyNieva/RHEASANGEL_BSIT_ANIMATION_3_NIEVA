<?php
    include('./includes/connect.php');
    include('functions/common_function.php');
    session_start();
?>

<!-- Main HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Own CSS -->
    <link rel="stylesheet" href="homepage.css">

    <!-- WAG KA NA MAG CAPITAL SA MGA ID -->

</head>
<body>
    <!-- Navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar-container">
            <div class="container-fluid">
                <a class="navbar-brand" id="logo" href="#">Go!Farm</a> 
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item" id="navbar-items">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item" id="navbar-items">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item" id="navbar-items">
          <a class="nav-link" href="#">Contacts</a>
        </li>
        <li class="nav-item ms-5" id="navbar-items" id="cart-btn">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup>
            <?php
            cart_item(); //cart count thing
            ?>
          </sup></a>
        </li>
        <li class="nav-item" id="navbar-items">
          <a class="nav-link" href="#">Expenses: ₱<?php total_cart_price(); ?></a>
        </li>
      </ul>

      <!-- SearchBar -->
      <form class="d-flex" action="search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
      </form>

    <?php
    if (isset($_SESSION['username'])){
      echo "<div class='d-flex'>
      <a href='./user_area/profile.php' class='btn btn-outline-primary me-2 ms-5' id='login-btn'>My Account</a>
     </div>";
    }else{
      echo "<div class='d-flex'>
          <a href='./user_area/signup.php' class='btn btn-outline-primary me-2 ms-5' id='login-btn'>Register</a>
        </div>";
    }
    
    ?>

    </div>
  </div>
</nav>

    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <ul class="navbar-nav me-auto">
            <!--btw gumawa siya ng if else sa may welcome guest. if naka log in si user, welcome (username) lalabas tas katabi yung log out. Tapos pag hindi naka log in welcome guest lang tapos katabi yung log in-->
             <!-- name dapat nung user madidisplay sa else ".$_SESSION['username']"  // part 47-->
        
            <?php
                  if (!isset($_SESSION['username'])){
                    echo " <li class='nav-item'>
                <a class='nav-link text-light' href='#'> Welcome, Guest!</a>
                    </li>";
                  }
                  else  {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='./user_area/profile.php'> Welcome ".$_SESSION['username']." 
                    </li>";
                  }
              
              if (!isset($_SESSION['username'])){
                echo " <li class='nav-item'>
                <a class='nav-link' href='./user_area/user_login.php'>Login</a>
                </li>";
              }
              else  {
                echo "<li class='nav-item'>
                <a class='nav-link' href='./user_area/logout.php'>Logout </a>
                </li>";
              }
            ?>
        </ul>
    </nav>

    <!-- cart call -->
     <?php
        cart();
     ?>

    <div class="bg-light">
        <h3 class="text-center mt-3">PRODUCTS</h3>
        <p class="text-center">Fresh produce instantly available!</p>
    </div>

    <div class="row">
        <!-- Sidenav -->
        <div class="col-md-3 bg-success p-0">
            <!-- Category SideNav -->
             <ul class="navbar-nav me-auto text-center" >
                <li class="nav-item text-white p-3" id="sidenav-bg">
                    <a href="#" class="nav-link text-light"><h4 class="categories">Categories</h4></a>

                <?php
                    getcategories();
                ?>
             </ul>
        </div>
        <div class="col-md-9">
            <!-- Products/Main -->
            <div class="row">
            <!-- Product Display php -->
                <?php
                    getproducts();
                    get_unique_categories();
                    // $ip = getIPAddress();  
                    // echo 'User Real IP Address - '.$ip; 
                ?>
            </div>
    </div>

    <footer class="text-light text-center py-3 mt-auto" id="footer" style="background-color:rgb(119, 185, 128);"> <!-- Softer Green -->
            <p class="mb-0">&copy; 2024 Go!Farm. Designed by <strong>Rhea's Angels</strong>.</p>
            <p class="mb-0">All rights reserved.</p>
        </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>