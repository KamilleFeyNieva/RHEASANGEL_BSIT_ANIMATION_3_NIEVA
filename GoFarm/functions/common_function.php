<?php
// include('./includes/connect.php');
//eto nanaman tayo common functions, umayos kang page ka
//makatakot galawin 'tong page haha 
//ginawa niyang comment yung include sa part-39 / 10:21 minutes dun sa vid  if u want to check the reason why. ps: di muna ako maga galaw dito ;)
//parang may gustong pasabugin si ate tutorial dito ah www
//MEN DAPAT KINOMMENT MO NA YUN KANINA HAHAHHAA YUN YUNG NAGA CAUSE NG ERROR ILANG ORAS NA AKO DITO replying ayy sorry ahahahaha
//jusko anyaree sa nga comments hahaha

//getting products
function getproducts(){
    global $con;
    //condition to check isset or not
    if(!isset($_GET['category'])){

        $select_query="Select * from `products` order by rand() limit 0,9";
                    $result_query=mysqli_query($con,$select_query);

                    // echo $row['product_name'];
                    while($row=mysqli_fetch_assoc($result_query)){
                        $product_id=$row['product_id'];
                        $product_name=$row['product_name'];
                        $product_description=$row['product_description'];
                        $product_image1=$row['product_image1'];
                        $category_id=$row['category_id'];
                        $product_price=$row['product_price'];

                        echo "<div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./admin/product_images/$product_image1' class='card-img-top' alt='$product_name'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>$product_name</h5>
                                            <p class='card-text'>$product_description</p>
                                            <p class='card-text'>₱$product_price/-</p>
                                            <a href='index.php?add_to_cart=$product_id' class='btn btn-success'>Add to Cart</a>
                                            <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                                        </div>
                                    </div>
                                </div>";
                    }
            
    }
}

//unique categories

function get_unique_categories(){
    global $con;

    if (isset($_GET['category'])) {
        $category_id = intval($_GET['category']); // Sanitize input
        $select_query = "SELECT * FROM `products` WHERE category_id = $category_id";
        $result_query = mysqli_query($con, $select_query) or die(mysqli_error($con));

        if (mysqli_num_rows($result_query) == 0) {
            echo "<p class='text-center'>No products found in this category.</p>";
        } else {
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_name = $row['product_name'];
                $product_id = $row['product_id'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];

                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin/product_images/$product_image1' class='card-img-top' alt='$product_name'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_name</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>₱$product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-success'>Add to Cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                            </div>
                        </div>
                    </div>";
            }
        }
    }
}


//getting categories

function getcategories(){
    global $con;
    $select_categories = "SELECT * FROM `categories`";
    $result_categories = mysqli_query($con, $select_categories) or die(mysqli_error($con));

    while ($row_data = mysqli_fetch_assoc($result_categories)) {
        $category_name = $row_data['category_name'];
        $category_id = $row_data['category_id'];
        echo "<li class='nav-item'> 
                <a href='index.php?category=$category_id' class='nav-link text-light'>$category_name</a>
              </li>";
    }
}

//search products
function search_product(){
        global $con;
        if(isset($_GET['search_data_product'])){
            $search_data_value=$_GET['search_data'];
            $search_query="Select * from `products` where product_keywords like '%$search_data_value%'";
                        $result_query=mysqli_query($con,$search_query);
                        if (mysqli_num_rows($result_query) == 0) {
                            echo "<p class='text-center'>No results match.</p>";
                        }
                        // echo $row['product_name'];
                        while($row=mysqli_fetch_assoc($result_query)){
                            $product_id=$row['product_id'];
                            $product_name=$row['product_name'];
                            $product_description=$row['product_description'];
                            $product_image1=$row['product_image1'];
                            $category_id=$row['category_id'];
                            $product_price=$row['product_price'];
    
                            echo "<div class='col-md-4 mb-2'>
                                    <div class='card'>
                                        <img src='./admin/product_images/$product_image1' class='card-img-top' alt='$product_name'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>$product_name</h5>
                                                <p class='card-text'>$product_description</p>
                                                <p class='card-text'>₱$product_price/-</p>
                                                <a href='index.php?add_to_cart=$product_id' class='btn btn-success'>Add to Cart</a>
                                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                                            </div>
                                        </div>
                                    </div>";
                        }
            }
                
}

//details func
function view_details(){
        global $con;
        //condition to check isset or not
        if(isset($_GET['product_id'])){
        if(!isset($_GET['category'])){
            $product_id=$_GET['product_id'];
    
            $select_query="Select * from `products` where product_id=$product_id";
                        $result_query=mysqli_query($con,$select_query);
    
                        // echo $row['product_name'];
                        while($row=mysqli_fetch_assoc($result_query)){
                            $product_id=$row['product_id'];
                            $product_name=$row['product_name'];
                            $product_description=$row['product_description'];
                            $product_image1=$row['product_image1'];
                            $product_image2=$row['product_image2'];
                            $product_image3=$row['product_image3'];
                            $category_id=$row['category_id'];
                            $product_price=$row['product_price'];
    
                            echo "<div class='col-md-4 mb-2'>
                                    <div class='card'>
                                        <img src='./admin/product_images/$product_image1' class='card-img-top' alt='$product_name'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>$product_name</h5>
                                                <p class='card-text'>$product_description</p>
                                                <p class='card-text'>₱$product_price/-</p>
                                                <a href='index.php?add_to_cart=$product_id' class='btn btn-success'>Add to Cart</a>
                                                <a href='index.php' class='btn btn-secondary'>Home</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class='col-md-8'>
                                        <!-- related stuff -->
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                    <h4 class='text-center text-info mb-5'>Related Products</h4>
                                                 </div>
                                             <div class='col-md-6'>
                                                <img src='./admin/product_images/$product_image2' class='card-img-top' alt='$product_name'>
                                             </div>
                                             <div class='col-md-6'>
                                                <img src='./admin/product_images/$product_image3' class='card-img-top' alt='$product_name'>
                                            </div>
                                         </div>
                                    </div>";
                        }
                
        }
    }
}

//ip add getto
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;  

// cart
function cart(){
    if(isset($_GET['add_to_cart'])){
        global $con;
        $get_ip_add = getIPAddress();
        $get_product_id=$_GET['add_to_cart'];
        $select_query="Select * from `cart_details` where ip_address='$get_ip_add' and product_id=$get_product_id";
        $result_query=mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows>0) {
            echo "<script>alert('This item is already inside the cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else{
            $insert_query="insert into `cart_details` (product_id,ip_address,quantity) values('$get_product_id','$get_ip_add',0)";
            $result_query=mysqli_query($con,$insert_query);
            echo "<script>alert('Item added to cart.')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
}

//cart item numbers
function cart_item(){
    if(isset($_GET['add_to_cart'])){
        global $con;
        $get_ip_add = getIPAddress();
        $select_query="Select * from `cart_details` where ip_address='$get_ip_add'";
        $result_query=mysqli_query($con,$select_query);
        $count_cart_items=mysqli_num_rows($result_query);

        } else{
            global $con;
            $get_ip_add = getIPAddress();
            $select_query="Select * from `cart_details` where ip_address='$get_ip_add'";
            $result_query=mysqli_query($con,$select_query);
            $count_cart_items=mysqli_num_rows($result_query);
        }

        echo $count_cart_items;
    }

    //total price
    function total_cart_price(){
        global $con;
        $get_ip_add = getIPAddress();
        $total_price=0;
        $cart_query="Select * from `cart_details` where ip_address='$get_ip_add'";
        $result=mysqli_query($con,$cart_query);
        while($row=mysqli_fetch_array($result)){
            $product_id=$row['product_id'];
            $select_products="Select * from `products` where product_id='$product_id'";
            $result_products=mysqli_query($con,$select_products);
            while($row_product_price=mysqli_fetch_array($result_products)){
                $product_price=array($row_product_price['product_price']);
                $product_values=array_sum($product_price);
                $total_price+=$product_values;
        }
    }
    echo $total_price;
}

//user oder details
function get_user_order_details(){
    global $con;
    $username=$_SESSION['username'];
    $get_details="Select * from `user_table` where username='$username'";
    $result_query=mysqli_query($con, $get_details);
    while($row_query=mysqli_fetch_array($result_query)){
        $user_id=$row_query['user_id'];
        if(!isset($_GET['edit_account'])){
            if(!isset($_GET['my_orders'])){
                if(!isset($_GET['delete_account'])){
                    $get_orders="Select * from `user_orders` where user_id=$user_id and order_status='pending'";
                    $result_orders_query=mysqli_query($con, $get_orders);
                    $row_count=mysqli_num_rows($result_orders_query);
                    if($row_count>0){
                        echo "<h3 class='text-center'>You have <span class='text-danger'> $row_count </span> pending orders.</h3>
                        <p class='text-center m-4'><a href='profile.php?user_orders' style='display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; font-size: 16px; text-align: center;'> Order Details </a></p>";
                    }else{
                        echo "<h3 class='text-center'>You have no pending orders.</h3>";
                    }
                }
            }
        }
    }
}
?>