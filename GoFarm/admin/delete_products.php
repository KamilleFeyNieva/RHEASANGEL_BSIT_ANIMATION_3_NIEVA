<?php
// hi!!
    if(isset($_GET['delete_products'])){
        $delete_id=$_GET['delete_products'];


        $delete_products="Delete from `products` where product_id= $delete_id";
        $result=mysqli_query($con,$delete_products);
        if($result){
            echo "<script alert('Product is been deleted')></script>"; // ako nalang kaya
            echo "<script>window.open('./index.php','_self')</script>";
        }
    }
?>