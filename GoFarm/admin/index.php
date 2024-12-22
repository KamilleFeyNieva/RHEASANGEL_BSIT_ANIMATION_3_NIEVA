<?php  
  include('../includes/connect.php');
  include('../functions/common_function.php');       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dash</title>

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Own CSS -->
    <link rel="stylesheet" href="admin.css">

</head>
<body>
    <!-- Navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" id="logo" href="#">Go!Farm</a>
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Welcome Guest</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <div class="bg-light">
            <h3 class="text-center p-2">Store Management</h3>
        </div>

        <!-- Buttons thing buttons dito pede papaCSS --> 
         <div class="row">
            <div class="col-md-12 bg-success p-1 d-flex align-items-center">
                <div class="px-5 pt-3">
                    <a href="#"><img src="./stuff/profile.jpg" alt="profile pic" class="admin-img"></a>
                    <p class="text-light text-center">Admin Name</p>
                </div>
                <div class="button text-center">
                    <button><a href="index.php?insert_products" class="nav-link text-light">Add Products</a></button>
                    <button><a href="index.php?view_products" class="nav-link text-light ">View Products</a></button>
                    <button><a href="index.php?add_category" class="nav-link text-light ">Add Categories</a></button>
                    <button><a href="index.php?view_categories" class="nav-link text-light ">View Categories</a></button>
                    <button><a href="index.php?list_orders" class="nav-link text-light ">Orders</a></button>
                    <button><a href="#" class="nav-link text-light ">Payments</a></button>
                    <button><a href="#" class="nav-link text-light ">Users</a></button>
                    <button><a href="#" class="nav-link text-light ">Log Out</a></button>
                </div>
            </div>
         </div>
    </div>

    <!-- Add category thing, pls wag kalimutan -->
    <div class="container my-3">
        <?php
        if(isset($_GET['add_category'])){
            include('insert_categories.php');
        }
        if(isset($_GET['view_products'])){
            include('view_products.php');
        }
        if(isset($_GET['edit_products'])){
            include('edit_products.php');
        }
        if(isset($_GET['view_categories'])){
            include('view_categories.php');
        } 
        
        if(isset($_GET['edit_categories'])){
            include('edit_categories.php');
        }
        if(isset($_GET['delete_categories'])){
            include('delete_categories.php');
        }
        if(isset($_GET['delete_products'])){
            include('delete_products.php');

        }if(isset($_GET['insert_products'])){
        include('insert_products.php');
    }
        if(isset($_GET['list_orders'])){
        include('list_orders.php');
    }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>