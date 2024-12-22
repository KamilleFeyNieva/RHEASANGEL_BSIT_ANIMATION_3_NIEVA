<?php
    include_once('./includes/connect.php');
    include_once('functions/common_function.php');
    session_start();
?>

<!-- Main HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Details</title>

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
        </li>
      </ul>
    
      <!-- Login Register Buttons -->
      <div class="d-flex">
          <a href="./user_area/signup.php" class="btn btn-outline-primary me-2 ms-5" id="login-btn">Register</a>
        </div>

    </div>
  </div>
</nav>

    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <ul class="navbar-nav me-auto">
            <!--btw gumawa siya ng if else sa may welcome guest. if naka log in si user, welcome (username) lalabas tas katabi yung log out. Tapos pag hindi naka log in welcome guest lang tapos katabi yung log in-->
             <!-- name dapat nung user madidisplay sa else ".$_SESSION['username']"  -->
        
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
                <a class='nav-link' href='./user_area/logout.php'> Logout </a>
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

    <!-- table -->
     <div class="container">
        <div class="row">
            <form action="" method="post">
            <table class="table table-bordered text-center">
                
                    <!-- php -->
                     <?php

                     $get_ip_add = getIPAddress();
                     $total_price=0;
                     $cart_query="Select * from `cart_details` where ip_address='$get_ip_add'";
                     $result=mysqli_query($con,$cart_query);
                     $result_count=mysqli_num_rows($result);
                     if($result_count>0){
                        echo "<thead>
                    <tr>
                        <th>Product Title</th>
                        <th>Product Image</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Remove</th>
                        <th colspan='2'>Operations</th>
                    </tr>
                    </thead>
                    <tbody>";
                     
                     while($row=mysqli_fetch_array($result)){
                         $product_id=$row['product_id'];
                         $select_products="Select * from `products` where product_id='$product_id'";
                         $result_products=mysqli_query($con,$select_products);
                         while($row_product_price=mysqli_fetch_array($result_products)){
                             $product_price=array($row_product_price['product_price']);
                             $price_table=$row_product_price['product_price'];
                             $product_name=$row_product_price['product_name'];
                             $product_image1=$row_product_price['product_image1'];
                             $product_values=array_sum($product_price);
                             $total_price+=$product_values;
                 
                     ?>
                    <tr>
                        <td><?php echo $product_name?></td>
                        <td><img src="./admin/product_images/<?php echo $product_image1?>" alt="" class="cart_img"></td>
                        <td><input type="text" name="quantity" class="form-input w-50"></td>
                        <?php
                        $get_ip_add = getIPAddress();
                        if(isset($_POST['update_cart'])){
                            $quantities=intval($_POST['quantity']);
                            $update_cart="update `cart_details` set quantity=$quantities where ip_address='$get_ip_add'";
                            $result_products_quantity=mysqli_query($con,$select_products);
                            $total_price=$total_price*$quantities;
                        }
                        ?>
                        <td>₱<?php echo $price_table?>/-</td>
                        <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                        <td>
                            <!-- <button class="bg-success p-3 py-2  mx-3 border-0 text-light">Update</button> -->
                             <input type="submit" value="Reset Cart" class="bg-success p-3 py-2  mx-3 border-0 text-light" name="update_cart">
                            <!-- <button class="bg-danger p-3 py-2  mx-3 border-0 text-light">Remove</button> -->
                            <input type="submit" value="Remove Cart" class="bg-danger p-3 py-2  mx-3 border-0 text-light" name="remove_cart">
                        </td>
                    </tr>
                    <?php   } }
                 }
                 
                 else{
                    echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                 }?>

                </tbody>
            </table>
            <!-- subtotal -->
             <div class="d-flex mb-5">
                <?php
                $get_ip_add = getIPAddress();
                $cart_query="Select * from `cart_details` where ip_address='$get_ip_add'";
                $result=mysqli_query($con,$cart_query);
                $result_count=mysqli_num_rows($result);
                if($result_count>0){
                    echo "<h4 class='px-3'>Subtotal: <strong class='text-info'>₱ $total_price/-</strong></h4>
                <input type='submit' value='Continue Shopping' class='bg-danger p-3 py-2  mx-3 border-0 text-light' name='continue_shopping'>
                <button class='bg-secondary p-3 py-2 border-0 text-light'><a href='./user_area/checkout.php' class='text-light text-decoration-none'>Checkout</button></a>";
                }else{
                    echo "<input type='submit' value='Continue Shopping' class='bg-danger p-3 py-2  mx-3 border-0 text-light' name='continue_shopping'>";
                }

                if (isset($_POST['continue_shopping'])) {
                  echo "<script>window.open('index.php','_self');</script>";
                }
                ?>
                
             </div>
        </div>
     </div>
     </form>
     <!-- remove items funct -->
      <?php
        function remove_cart_item(){
            global $con;
            if (isset($_POST['remove_cart']) && !empty($_POST['removeitem'])) {
                foreach ($_POST['removeitem'] as $remove_id) {
                    $remove_id = intval($remove_id); // Ensure it's an integer
                    $delete_query = "DELETE FROM `cart_details` WHERE product_id=$remove_id";
                    $run_delete = mysqli_query($con, $delete_query);
                    if ($run_delete) {
                        echo "<script>window.open('cart.php','_self')</script>";
                    }
                }
            }
        }
        echo $remove_item=remove_cart_item();
      ?>

    <!-- Footer paayos din neto thx -->
    <footer class="text-light text-center py-3 mt-auto" id="footer" style="background-color:rgb(119, 185, 128);"> <!-- Softer Green -->
            <p class="mb-0">&copy; 2024 Go!Farm. Designed by <strong>Rhea's Angels</strong>.</p>
            <p class="mb-0">All rights reserved.</p>
        </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>