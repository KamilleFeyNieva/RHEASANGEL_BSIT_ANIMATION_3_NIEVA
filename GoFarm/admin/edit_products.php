<!--part 65-66-->
<?php

include_once('../includes/connect.php');

if (isset($_GET['edit_products'])) {
    // Sanitize and validate the input to prevent SQL injection
    $edit_id = intval($_GET['edit_products']); // Convert to an integer for safety

    // Fetch product data
    $get_data = "SELECT * FROM `products` WHERE product_id=$edit_id";
    $result = mysqli_query($con, $get_data);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result); // Fetch the row data
        $product_name = $row['product_name'];
        $product_description = $row['product_description'];
        $product_keywords = $row['product_keywords'];
        $category_id = $row['category_id'];
        $product_image1 = $row['product_image1'];
        $product_image2 = $row['product_image2'];
        $product_image3 = $row['product_image3'];
        $product_price = $row['product_price'];

        // Fetching category name
        $select_category = "SELECT * FROM `categories` WHERE category_id=$category_id";
        $result_category = mysqli_query($con, $select_category);

        if ($result_category && mysqli_num_rows($result_category) > 0) {
            $row_category = mysqli_fetch_assoc($result_category);
            $category_name = $row_category['category_name'];
        } else {
            $category_name = "Unknown Category"; // Default fallback
        }
    } else {
        echo "No product found with ID: $edit_id";
        exit; // Stop further execution if no product is found
    }
}
?>


<!-- Main HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Own CSS -->
    <link rel="stylesheet" href="profile.css">
</head>
<body style= "background: rgb(184, 255, 184)">
    <div class="container mt-5">
        <h1 class="text-center">Edit Product</h1>
        <form action="" methods="post" enctype="multipart/form-data">
        <!-- prod name -->    
        <div class="form-outlinex w-50 m-auto mb-4">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" id="product_name" value="<?php echo $product_name ?>" name="product_name" class="form-control"
                required="required">
        </div>
        <!-- prod desc -->
        <div class="form-outlinex w-50 m-auto mb-4">
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" id="product_description" value="<?php echo $product_description?>" name="product_description" class="form-control"
            required="required">
        </div>
        <!-- prod keywords -->
        <div class="form-outlinex w-50 m-auto mb-4">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" id="product_keywords" value="<?php echo $product_keywords ?>" name="product_keywords" class="form-control"
            required="required">
        </div>
        <!-- prod category -->
        <div class="form-outlinex w-50 m-auto mb-4">
            <label for="category_id" class="form-label">Product Category</label>  
            <select name="product-category" class="form-select">
                <option value="<?php echo $category_name ?>"><?php echo $category_name ?></option> 

                <?php 
                $select_category_all="Select * from `categories`";
                $result_category_all=mysqli_query($con,$select_category_all);
                while ($row_category_all=mysqli_fetch_assoc($result_category_all)){
                $category_name=$row_category_all['category_name'];
                $category_id=$row_category_all['category_id'];
                echo " <option value='$category_id'>$category_name</option>";
                }
                ?>
                </select>   
        </div>
        <!-- prod image -->    
        <div class="form-outlinex w-50 m-auto mb-4">
           <label for="product_image1" class="form-label">Product Image</label>
            <div class="d-flex"> <!-- container's idon'tknow -->
                 <input type="file" id="product_image1" value="<?php echo $product_image1 ?>" name="product_image1"
                 class="form-control w-90 m-auto"  required="required">
                <img src="admin./product_image/<?php echo $product_image1 ?>" alt="" class="product_image"> <!-- I'm seeing things, replying lol-->
           </div> 
        </div>
        <!-- price -->
        <div class="form-outlinex w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" id="product_price"  value="<?php echo $product_price ?>" name="product_price" class="form-control"
            required="required">
        </div>
        <!-- Submit Button/Update Product -->
        <div class="w-50 m-auto">
            <input type="submit" name="edit_product" value="Update Product"
            class="btn btn-info px-3 mb-3 bg-success">
        </div>
         </form>
    </div>

</body>
</html> 


<!--editing prods part 67-->
<?php 
if(isset($_POST['edit_product'])){
    $product_name=$_POST['product_name'];
    $product_description=$_POST['product_description'];
    $product_keywords=$_POST['product_keywords'];
    $category_id=$_POST['category_id'];
    $product_image1=$_FILES['product_image1'];
    $product_price=$_POST['product_price'];

    $product_image1=$_FILES['product_image1']['name'];

    $tempt_image1=$_FILES['product_image1']['tmp_name'];


    if ($product_name=='' or $product_description=='' or $product_keywords=='' or  $category_id=='' or $product_image1=='' or
    $product_price==''){
        echo "<script>alert('Please fill all the fields to continue')</script>";
    }else{
        move_uploaded_file($tempt_image1,"../admin/product_images/$product_image1");

        //queryy to updatee productss
        $update_product="update `products` set product_name=' $product_name',product_description= '$product_description',
        product_keywords=' $product_keywords',category_id='$category_id',product_image1=' $product_image1',
        product_price=' $product_price',date=NOW() where product_id=$edit_id";
        $result_update=mysqli_query($con,$update_product);
        if($result_update){
            echo "<script>alert('Product updated successfully')</script>";
            echo "<script>window.open('./view_products.php','_self')</script>";
        }
    }
}

?>