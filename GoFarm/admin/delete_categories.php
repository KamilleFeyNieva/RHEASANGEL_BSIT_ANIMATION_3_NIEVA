<?php

    if(isset($_GET['delete_categories'])){
        $delete_categories=$_GET['delete_categories'];
        //echo $delete_categories;

            $delete_query= "Delete from `categories` where 
            category_id= $delete_categories"; //backsticks etoh pala yun ehehehe
            $result=mysqli_query($con,$delete_query);
            if($result){
                echo "<script>alert('Category is been deleted')></script>"; // diko sure meoww
                echo "<script>window.open('./index.php?view_categories','self')</script>";
            }

    }

?>