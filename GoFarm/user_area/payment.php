<?php  
include('../includes/connect.php');
include_once('../functions/common_function.php');

// Get user ID securely
if (isset($_SESSION['user_id'])) {
    $user_id = intval($_SESSION['user_id']); // Sanitize session variable
} else {
    // Fallback for guest users based on IP address
    $user_ip = getIPAddress();
    $get_user = "SELECT * FROM `user_table` WHERE user_ip='$user_ip'";
    $result = mysqli_query($con, $get_user);

    if ($result && mysqli_num_rows($result) > 0) {
        $run_query = mysqli_fetch_array($result);
        $user_id = intval($run_query['user_id']);
    } else {
        $user_id = null;
    }
}

// Redirect to login if user ID is not found
if (!$user_id) {
    echo "<script>alert('User not logged in. Please log in to continue.');</script>";
    echo "<script>window.open('login.php', '_self');</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
          crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../homepage.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center my-4">Payment Methods</h2>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-3">
                <a href="#" target="_blank" class="btn btn-primary btn-lg">Pay Online</a>
            </div>
            <div class="col-md-6 text-center mb-3">
                <a href="orders.php?user_id=<?php echo $user_id; ?>" class="btn btn-success btn-lg">Cash on Delivery</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
