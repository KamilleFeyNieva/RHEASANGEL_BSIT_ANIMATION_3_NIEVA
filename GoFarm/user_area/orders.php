<?php  
session_start();
include('../includes/connect.php');
include_once('../functions/common_function.php');

// Get user ID
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

// Total items and price
$get_ip_address = getIPAddress();
$total_price = 0;

$cart_query_price = "Select * from `cart_details` where ip_address='$get_ip_address'";
$result_cart_price = mysqli_query($con, $cart_query_price);

$invoice_number = mt_rand();
$status = 'pending';
$count_products = mysqli_num_rows($result_cart_price);

while ($row_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_price['product_id'];
    $select_product = "Select * from `products` where product_id=$product_id";
    $run_price = mysqli_query($con, $select_product);
    while ($row_product_price = mysqli_fetch_array($run_price)) {
        // Correctly fetch product_price
        $product_price = $row_product_price['product_price'];
        $total_price += $product_price; // Accumulate the price
    }
}

// Quantity in cart
$get_cart = "select * from `cart_details`";
$run_cart = mysqli_query($con, $get_cart);
$get_item_quantity = mysqli_fetch_array($run_cart);
$quantity = $get_item_quantity['quantity'] ?? 0;

if ($quantity == 0) {
    $quantity = 1;
}
$subtotal = $total_price * $quantity;

// Insert order
$insert_order = "Insert into `user_orders` (user_id, amount_due, invoice_number, total_products, order_date, order_status)
                 values ($user_id, $subtotal, $invoice_number, $count_products, NOW(), '$status')";
$result_query = mysqli_query($con, $insert_order);

if ($result_query) {
    echo "<script>alert('Orders confirmed')</script>";
    echo "<script>window.open('profile.php', '_self')</script>";
}

// oredr pending
$insert_pending_order = "Insert into `order_pending` (user_id, invoice_number, product_id, quantity, order_status)
                         values ($user_id, $invoice_number, $product_id, $quantity, '$status')";
$result_pending_orders = mysqli_query($con, $insert_pending_order);


//dd=elte items cart
$empty_cart = "DELETE FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_delete = mysqli_query($con, $empty_cart);

?>