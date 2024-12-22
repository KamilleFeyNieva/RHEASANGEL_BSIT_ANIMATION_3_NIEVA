<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Own CSS -->
    <link rel="stylesheet" href="profile.css">

</head>
<body>

<?php 

$username=$_SESSION['username'];
$get_user="Select * from `user_table` where username='$username'";
$result=mysqli_query($con, $get_user);
$row_fetch=mysqli_fetch_assoc($result);
$user_id=$row_fetch['user_id'];

?>

    <h3 class="text-success">ORDERS</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr>
                <th>Serial Number</th>
                <th>Amount Due</th>
                <th>Total Products</th>
                <th>Invoice Number</th>
                <th>Date</th>
                <th>Complete/Incomplete</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php 
            $get_order_details="Select * from `user_orders` where user_id=$user_id";
            $result_orders=mysqli_query($con, $get_order_details);
            $number=1;
            while($row_orders=mysqli_fetch_assoc($result_orders)){
                $order_id=$row_orders['order_id'];
                $amount_due=$row_orders['amount_due'];
                $total_products=$row_orders['total_products'];
                $invoice_number=$row_orders['invoice_number'];
                $order_date=$row_orders['order_date'];
                $order_status=$row_orders['order_status'];
                if($order_status=='pending'){
                    $order_status='Incomplete';
                }else{
                    $order_status='Complete';
                }
                

                echo "<tr>
                        <td>$number</td>
                        <td>$amount_due</td>
                        <td>$total_products</td>
                        <td>$invoice_number</td>
                        <td>$order_date</td>
                        <td>$order_status</td>";
                    ?>

                    <?php 
                    
                    if($order_status=='Complete'){
                        echo "<td>PAID</td>";
                    }else{
                         echo " <td><a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirm</a></td>
                    </tr>";
                    }
                    $number++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>