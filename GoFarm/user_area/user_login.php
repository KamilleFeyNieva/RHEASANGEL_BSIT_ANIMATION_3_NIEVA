<?php  
   include('../includes/connect.php');
   include_once('../functions/common_function.php');  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href ="SULI.css">

</head>

<body>
    <div class="container m-4">
        <h3 class="text-center justify-content-center">Login</h3> 
    </div>

    <div class="row d-flex align-items-center justify-content-center">
        
        <div class="col-lg-12 col-xl-6">
            <form action="" method="post">

                <!--Username -->
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" class="form-control" 
                    placeholder="Enter your username" autocomplete="off" 
                    required="required" name="user_username" />
                </div>
                <!-- Password -->
                <div class = "form-outline mb-4">
                    <label for = "user_password" class="form-label">Password</label>
                    <input type= "password" id="user_password" class="form-control"
                     placeholder="Enter your password" autocomplete="off"
                     required="required" name="user_password" />
                </div>
                <!-- Submit Button -->
                <div class = "mt-4 pt-2">
                        <input type= "submit" value="Login" class="bg-info- py-2 px-3 border-success text-light bg-success"
                        name="user_login">
                        <p class="small mt-2 pt-1 mb-0">Don't have an account?
                        <a href="signup.php"> Register</a> </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<!-- here php tama pa ba toh, copy ko lang yung structure ni ateng palitan nalang nung mga variables or names-->
<!--replying...anong video pinapanood mo?43???okii-->
<!-- Nagkachat room haha, alam nyo matatawa dito si sir //replying..hahahahhahahaha-->
<?php
session_start(); //wag alisin
    if (isset($_POST['user_login'])) {
        $user_username = $_POST['user_username'];
        $user_password = $_POST['user_password'];
    
        $select_query = "SELECT * FROM `user_table` WHERE username=?";
        $stmt = mysqli_prepare($con, $select_query);
        mysqli_stmt_bind_param($stmt, 's', $user_username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($user_password, $row['user_password'])) {
                $_SESSION['username'] = $user_username;
    
                $user_ip = getIPAddress();
                $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address=?";
                $cart_stmt = mysqli_prepare($con, $select_query_cart);
                mysqli_stmt_bind_param($cart_stmt, 's', $user_ip);
                mysqli_stmt_execute($cart_stmt);
                $cart_result = mysqli_stmt_get_result($cart_stmt);
    
                if (mysqli_num_rows($cart_result) == 0) {
                    echo "<script>alert('Login Successful');</script>";
                    echo "<script>window.open('../index.php', '_self');</script>";
                } else {
                    echo "<script>alert('Login Successful');</script>";
                    echo "<script>window.open('payment.php', '_self');</script>";
                }
            } else {
                echo "<script>alert('Invalid Username or Password');</script>";
            }
        } else {
            echo "<script>alert('Invalid Username or Password');</script>";
        }
    }
?>