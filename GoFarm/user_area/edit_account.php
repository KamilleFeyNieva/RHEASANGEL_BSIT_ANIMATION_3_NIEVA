<?php

if (isset($_GET['edit_account'])) {
    // Start session to get the current user
    $user_session_name = $_SESSION['username'];
    
    // Fetch user details
    $select_query = "SELECT * FROM `user_table` WHERE username = '$user_session_name'";
    $result_query = mysqli_query($con, $select_query);
    
    if ($result_query && mysqli_num_rows($result_query) > 0) {
        $row_fetch = mysqli_fetch_assoc($result_query);
        $user_id = $row_fetch['user_id'];
        $username = $row_fetch['username'];
        $user_email = $row_fetch['user_email'];
        $user_address = $row_fetch['user_address'];
        $user_mobile = $row_fetch['user_mobile'];
    } else {
        // Handle case where user data is not found
        die("User not found.");
    }

    // Update user details
    if (isset($_POST['user_update'])) {
        $update_id = $user_id; // Ensure $update_id is always set correctly
        $username = $_POST['user_username'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];
        $user_mobile = $_POST['user_mobile'];

        // Construct the SQL query to update
        $update_data = "UPDATE `user_table` 
                        SET username = '$username', 
                            user_email = '$user_email', 
                            user_address = '$user_address', 
                            user_mobile = '$user_mobile' 
                        WHERE user_id = $update_id";
        
        // Execute the query
        $result_query_update = mysqli_query($con, $update_data);
        if ($result_query_update) {
            echo "<script>alert('Data updated successfully');</script>";
            echo "<script>window.open('logout.php', '_self');</script>";
        } else {
            echo "<script>alert('Failed to update data');</script>";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>

     <!-- Bootstrap CSS-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Own CSS -->
    <link rel="stylesheet" href="profile.css">
    
</head>
<body>
<h3 class="mb-4">EDIT ACCOUNT</h3>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-outline mb-4">
                    <input type="text" class="form-control" value="<?php echo $username?>" name="user_username" placeholder="Enter your username">
                </div>
                <div class="form-outline mb-4">
                    <input type="email" class="form-control" value="<?php echo $user_email?>" name="user_email" placeholder="Enter your email">
                </div>
                <div class="form-outline mb-4">
                    <input type="text" class="form-control" value="<?php echo $user_address?>" name="user_address" placeholder="Enter your address">
                </div>
                <div class="form-outline mb-4">
                    <input type="text" class="form-control" value="<?php echo $user_mobile?>" name="user_mobile" placeholder="Enter your mobile number">
                </div>
                <input type="submit" value="Update" class="bg-info py-2 px-3 border-0 text-white" name="user_update">
            </form>
        </div>
    </div>
</div>

</body>
</html>