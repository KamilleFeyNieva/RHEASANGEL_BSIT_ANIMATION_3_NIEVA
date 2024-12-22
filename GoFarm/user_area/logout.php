<?php
include_once('../includes/connect.php');
include_once('../functions/common_function.php');
session_start();

// Clear session data
unset($_SESSION['user_id']);
unset($_SESSION['username']);
session_destroy();

// Get the user's IP address (same logic as in your cart reset function)
$get_ip_address = getIPAddress();

// Reset the cart by deleting all items associated with the user's IP address
$empty_cart = "DELETE FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_delete = mysqli_query($con, $empty_cart);

if (!$result_delete) {
    die("Error deleting cart items: " . mysqli_error($con));
}

// Redirect to home page after logout
header("Location: ../index.php");
exit();
?>


<!-- Wag na to galawin -->