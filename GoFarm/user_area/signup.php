<?php  
  include('../includes/connect.php');
  include('../functions/common_function.php');       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="SULI.css">
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">Sign Up</h2>
    </div>

    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 col-xl-6">
            <form action="" method="post" enctype="multipart/form-data">
            <!--Username-->
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username" />
                </div>
            <!--Email-->
                <div class="form-outline mb-4">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="text" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" name="user_email" />
                </div>
            <!--Address-->
                <div class="form-outline mb-4">
                    <label for="user_address" class="form-label">Address</label>
                    <input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" name="user_address" />
                </div>
            <!--Password-->
                <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password" />
                </div>
            <!--Confirm Password-->
                <div class="form-outline mb-4">
                    <label for="user_confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" id="user_confirm_password" class="form-control" placeholder="Confirm your password" autocomplete="off" required="required" name="user_confirm_password" />
                </div>
            <!--Contact-->
                <div class="form-outline mb-4">
                    <label for="user_contact" class="form-label">Contact</label>
                    <input type="text" id="user_contact" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required="required" name="user_contact" />
                </div>

            <!--Sign Up Button-->
            <div class="mt-4 pt-2">
                <input type="submit" value="Signup" class="bg-success text-light py-2 px-3 border-success" name="user_signup">
                <p class="small pt-1 mt-2 mb-0">Already have an account ? <a href="user_login.php"> Login</a></p>
            </div>
            </form>

        </div>
    </div>

</body>
</html>

<!--php code-->
<!--Dear Bubbles, this is part 39-->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['user_signup'])) {
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_password = $_POST['user_password'];
    $user_confirm_password = $_POST['user_confirm_password'];
    $user_contact = $_POST['user_contact'];
    $user_ip = getIPAddress();

    if ($user_password !== $user_confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
        exit();
    }

    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    $select_query = "SELECT * FROM `user_table` WHERE username=? OR user_email=?";
    $stmt = mysqli_prepare($con, $select_query);
    mysqli_stmt_bind_param($stmt, 'ss', $user_username, $user_email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username or Email already exists');</script>";
    } else {
        $insert_query = "INSERT INTO `user_table` (username, user_email, user_password, user_ip, user_address, user_mobile) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $insert_query);
        mysqli_stmt_bind_param($stmt, 'ssssss', $user_username, $user_email, $hashed_password, $user_ip, $user_address, $user_contact);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Registration Successful');</script>";
            echo "<script>window.open('../index.php', '_self');</script>";
        } else {
            echo "<script>alert('Error during registration');</script>";
        }
    }
}

// Cart logic
$user_ip = getIPAddress(); // Ensure $user_ip is defined for cart logic
$select_cart_items = "SELECT * FROM `cart_details` WHERE ip_address=?";
$stmt_cart = mysqli_prepare($con, $select_cart_items);
mysqli_stmt_bind_param($stmt_cart, 's', $user_ip);
mysqli_stmt_execute($stmt_cart);
$result_cart = mysqli_stmt_get_result($stmt_cart);
$rows_count = mysqli_num_rows($result_cart);

if (isset($_POST['user_signup'])) {
    if ($rows_count > 0) {
        $_SESSION['username'] = $user_username;
        echo "<script>alert('You have items in your cart');</script>";
        echo "<script>window.open('checkout.php');</script>";
    } else {
        echo "<script>window.open('../index.php');</script>";
    }
}

?>