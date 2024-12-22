
<!-- delete command -->
<?php
// Check if the 'delete_order' parameter is set
if (isset($_GET['delete_order'])) {
    // Get the order ID from the URL
    $delete_id = $_GET['delete_order'];

    // SQL query to delete the order
    $delete_order = "DELETE FROM `user_orders` WHERE `order_id` = $delete_id";

    // Execute the query
    $result = mysqli_query($con, $delete_order);

    // Check if the query executed successfully
    if ($result) {
        // Alert the user and reload the page
        echo "<script>alert('Order has been deleted');</script>";
        echo "<script>window.open('./index.php', '_self');</script>";
    } else {
        // Handle the error if the deletion fails
        echo "<script>alert('Failed to delete the order');</script>";
    }
}
?>
