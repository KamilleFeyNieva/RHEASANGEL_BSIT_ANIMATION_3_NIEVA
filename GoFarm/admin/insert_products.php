<?php
    include('../includes/connect.php');
    if(isset($_POST['insert_product'])){
        //YUNG UNDERSCORRRREEEEEEE
        $product_name=$_POST['product_name'];
        $description=$_POST['description'];
        $product_keywords=$_POST['product_keywords'];
        $product_category=$_POST['product_category'];
        $product_price=$_POST['product_price'];
        $product_status='true';

        //insert images thing YUNG UNDERSCORE WAG KALIMUTAN
        $product_image1=$_FILES['product_image1']['name'];
        $product_image2=$_FILES['product_image2']['name'];
        $product_image3=$_FILES['product_image3']['name'];
        
        //accessing image tmp names
        $temp_image1=$_FILES['product_image1']['tmp_name'];
        $temp_image2=$_FILES['product_image2']['tmp_name'];
        $temp_image3=$_FILES['product_image3']['tmp_name'];

        //checking conditions
        if($product_name=='' or $description=='' or $product_keywords=='' or $product_category=='' or $product_price=='' or $product_image1=='' or $product_image2=='' or $product_image3==''){
            echo "<script>alert('Please fill all fields')</script>";
            exit();
        } else{
            move_uploaded_file($temp_image1,"./product_images/$product_image1");
            move_uploaded_file($temp_image2,"./product_images/$product_image2");
            move_uploaded_file($temp_image3,"./product_images/$product_image3");

            //query AYUSIN MO YUNG DB NAMES PAREHAS DAPAAAT
            //SEMI COLON
            $insert_products="insert into `products` (product_name, product_description, product_keywords, category_id,	product_image1,	product_image2,	product_image3,	product_price, date, status) 
            values('$product_name','$description','$product_keywords','$product_category','$product_image1','$product_image2','$product_image3','$product_price',NOW(),'$product_status')";

            $result_query=mysqli_query($con, $insert_products);
            if($result_query){
                echo "<script>alert('Product added successfully')</script>";
            }
        }

    }

    //parang may kaaway yung programmer sa mga comments haha
    //isang <form> tag lng 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Insert Products</title>

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Own CSS -->
    <link rel="stylesheet" href="admin.css">

</head>
<body>
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!-- Product Title -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" name = "product_name" id = "product_name" class="form-control" placeholder="Enter product name" autocomplete="off" required="required">
            </div>

        <!-- Product Description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Product Description</label>
                <input type="text" name = "description" id = "description" class="form-control" placeholder="Enter product description" autocomplete="off" required="required">
            </div>

        <!-- Product Keywords -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Product Keywords</label>
                <input type="text" name = "product_keywords" id = "product_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
            </div>

        <!-- Category dropdown static data muna palitan ko mamaya -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-select">
                    <option value="">Select Category</option>
                    <?php
                        $select_query="Select * from `categories`";
                        $result_query=mysqli_query($con, $select_query);

                        while($row=mysqli_fetch_assoc($result_query)){
                            $category_name=$row['category_name'];
                            $category_id=$row['category_id'];
                            echo "<option value='$category_id'>$category_name</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- Images -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product Image 1</label>
                <input type="file" name = "product_image1" id = "product_image1" class="form-control" required="required">
            </div>
            <!-- Images 2 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product Image 2</label>
                <input type="file" name = "product_image2" id = "product_image2" class="form-control" required="required">
            </div>
            <!-- Images 3 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product Image 3</label>
                <input type="file" name = "product_image3" id = "product_image3" class="form-control" required="required">
            </div>
        <!-- Product Price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name = "product_price" id = "product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
            </div>
        <!-- Insert Button -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn-info mb-3 px-3" id = "insert-btn" value="Insert product">
            </div>
        </form>
    </div>
</body>
</html>