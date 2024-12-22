<?php
    include('../includes/connect.php');
    include('../functions/common_function.php');
    session_start();
?>

<!-- Main HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username']?> </title>

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Own CSS -->
    <link rel="stylesheet" href="profile.css">

    <style>
.profile_img{
    width: 100%;
    margin: auto;
    display: block;
    object-fit: contain;
}
    </style>

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
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item" id="navbar-items">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item" id="navbar-items">
          <a class="nav-link" href="#">Contacts</a>
        </li>
        <li class="nav-item ms-5" id="navbar-items" id="cart-btn">
          <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup>
            <?php
            cart_item(); //cart count thing
            ?>
          </sup></a>
        </li>
        <li class="nav-item" id="navbar-items">
          <a class="nav-link" href="#">Expenses: ₱<?php total_cart_price(); ?></a>
        </li>
      </ul>
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
                    <a class='nav-link' href='profile.php'> Welcome ".$_SESSION['username']." 
                    </li>";
                  }
              
              if (!isset($_SESSION['username'])){
                echo " <li class='nav-item'>
                <a class='nav-link' href='user_login.php'>Login</a>
                </li>";
              }
              else  {
                echo "<li class='nav-item'>
                <a class='nav-link' href='logout.php'>Logout </a>
                </li>";
              }
            ?>
        </ul>
    </nav>
    <div class="bg-light">
    <h3 class="text-center mt-3">USER PROFILE</h3>
    </div>
                
    <!-- Page Content Here -->
    <div class="row">
      <div class="col-md-2 p-0">
        <ul class="navbar-nav text-center" style="height:100vh; background-color:rgb(119, 185, 128)">
          <li class="nav-item" id="navbar-items">
            <a class="nav-link text-light" href="#"><h4>PROFILE</h4></a>
          </li>
          <li class="nav-item my-4" id="navbar-items">
            <img src="../admin/stuff/profile.jpg" alt="profile" class="profile_img">
          </li>
          <li class="nav-item" id="navbar-items">
            <a class="nav-link text-light" href="profile.php"><h5>Pending Orders</h5></a>
          </li>
          <li class="nav-item" id="navbar-items">
            <a class="nav-link text-light" href="profile.php?edit_account"><h5>Edit Account</h5></a>
          </li>
          <li class="nav-item" id="navbar-items">
            <a class="nav-link text-light" href="profile.php?user_orders"><h5>Manage Orders</h5></a>
          </li>
          <li class="nav-item" id="navbar-items">
            <a class="nav-link text-light" href="profile.php?delete_account"><h5>Delete Account</h5></a>
          </li>
        </ul>
      </div>
      <div class="col-md-10" style="display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center; flex-direction: column;">
        <?php 
          
          if (!isset($_GET['edit_account']) && !isset($_GET['user_orders'])) {
            get_user_order_details();
        }
        
        // Handle other conditions
        if (isset($_GET['edit_account'])) {
            include('edit_account.php');
        }
        if (isset($_GET['user_orders'])) {
            include('user_orders.php');
        }
        if (isset($_GET['delete_account'])) {
            include('delete_account.php');
        }
        ?>
      </div>
    </div>





        <!-- Footer with Softer Green Background -->
        <footer class="text-light text-center py-3 mt-auto bg-success" id="footer"> <!-- Softer Green -->
            <p class="mb-0">&copy; 2024 Go!Farm. Designed by <strong>Rhea's Angels</strong>.</p>
            <p class="mb-0">All rights reserved.</p>
        </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
