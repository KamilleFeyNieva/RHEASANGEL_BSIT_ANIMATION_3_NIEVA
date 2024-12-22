<?php
    include_once('../includes/connect.php');
    include_once('../functions/common_function.php');
    session_start(); // Ensure session continuity

    // Check if user is logged in
    if (!isset($_SESSION['username'])) {
        // Redirect guest to login page before accessing checkout
        header('Location: user_login.php');
        exit();
    }
?>

<!-- Main HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Own CSS -->
    <link rel="stylesheet" href="../homepage.css">
</head>
<body>
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-1" id="navbar-container">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand fw-bold fs-6 p-0" id="logo" href="#">Go!Farm</a>
            
            <!-- Toggler Button -->
            <button class="navbar-toggler p-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-1 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active px-2" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-2" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-2" href="#">Contacts</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <ul class="navbar-nav me-auto">
        <?php
        // Display welcome message based on login state
        if (!isset($_SESSION['username'])) {
            echo "<li class='nav-item'><a class='nav-link text-light' href='#'>Welcome, Guest!</a></li>";
            echo "<li class='nav-item'><a class='nav-link' href='user_login.php'>Login</a></li>";
        } else {
            echo "<li class='nav-item'><a class='nav-link' href='profile.php'>Welcome, " . htmlspecialchars($_SESSION['username']) . "</a></li>";
            echo "<li class='nav-item'><a class='nav-link' href='logout.php'>Logout</a></li>";
        }
        ?>
    </ul>
</nav>

<div class="bg-light">
    <h3 class="text-center mt-3">PRODUCTS</h3>
    <p class="text-center">Fresh produce instantly available!</p>
</div>

<div class="row">
    <?php
    // Include payment page if user is logged in
    include('payment.php');
    ?>
</div>

<!-- Footer -->
<footer class="text-light text-center py-3 mt-auto" id="footer" style="background-color:rgb(119, 185, 128);">
    <p class="mb-0">&copy; 2024 Go!Farm. Designed by <strong>Rhea's Angels</strong>.</p>
    <p class="mb-0">All rights reserved.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
