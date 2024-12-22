<?php
    include('../includes/connect.php');
    session_start();
    
    //access order id
    if(isset($_GET['order_id'])){
        $order_id=$_GET['order_id'];

        $select_data="Select * from `user_orders` where order_id=$order_id";
        $result=mysqli_query($con,$select_data);
        $row_fetch=mysqli_fetch_assoc($result);
        $invoice_number=$row_fetch['invoice_number'];
        $amount_due=$row_fetch['amount_due'];
    }

    if(isset($_POST['confirm_payment'])){
        $invoice_number=$_POST['invoice_number'];
        $amount=$_POST['amount'];
        $payment_mode=$_POST['payment_mode'];

        $insert_query="insert into `user_payments` (order_id, invoice_number, amount, payment_mode)
        values ($order_id, $invoice_number, $amount, '$payment_mode')";

        $result=mysqli_query($con, $insert_query);
        if($result){
            echo "<h3 class='text-center text-light'> Payment Complete</h3>";
            echo "<script>window.open('profile.php?user_orders','_self')</script>";
        }

        $update_orders="update `user_orders` set order_status='Complete' where order_id=$order_id";
        $result_orders=mysqli_query($con,$update_orders);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Choices</title>

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Own CSS -->
    <link rel="stylesheet" href="profile.css">

    <style>

    body{
        background-color:rgb(119, 185, 128);
    }

    </style>

</head>
<body>
    <div class="container my-5">
        <h1 class="text-center text-light">CONFIRM PAYMENT</h1>
        <form action="" method="post">
            <div class="form-outline my-4 text-center">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number?>">
            </div>
            <div class="form-outline my-4 text-center">
                <label for="" class="text-light p-2">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due?>">
            </div>
            <div class="form-outline my-4 text-center">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option value="">Select Payment Method</option>
                    <option value="">Cash on Delivery</option>
                    <option value="">7/11 Shop Payment</option>
                    <option value="">Pay Offline</option>
                    <option value="">Run</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center">
                <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>
</body>
</html>