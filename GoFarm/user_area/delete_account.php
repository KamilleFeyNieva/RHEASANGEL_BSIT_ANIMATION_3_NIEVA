<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Own CSS -->
    <link rel="stylesheet" href="profile.css">

    <style>
    input[name="delete"]:hover {
        background-color: red;
        color: white;
    }
</style>

</head>
<body>
    <h3 class="text-danger mb-4">DELETE ACCOUNT</h3>
     <form action="" method="post" class="mt-5">
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-100 m-auto" name="delete" value="Delete Account">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-100 m-auto" name="dont_delete" value="Don't Delete Account">
        </div>
    </form>
</body>
</html>

<?php 
 // Ensure session is started

// Check if 'username' is set in the session before using it
if (isset($_SESSION['username'])) {
    $username_session = $_SESSION['username'];

    if (isset($_POST['delete'])) {
        // Prepared statement to avoid SQL injection
        $delete_query = "DELETE FROM `user_table` WHERE username = ?";
        
        if ($stmt = mysqli_prepare($con, $delete_query)) {
            mysqli_stmt_bind_param($stmt, "s", $username_session);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                session_destroy();  // Destroy the session after deletion
                echo "<script>alert('Account deleted successfully')</script>";
                echo "<script>window.open('../index.php', '_self')</script>"; // Redirect after deletion
            } else {
                echo "<script>alert('Error deleting account')</script>";
            }
        } else {
            echo "<script>alert('Failed to prepare query')</script>";
        }
    }

    if (isset($_POST['dont_delete'])) {
        echo "<script>alert('Thank you for staying')</script>";
        echo "<script>window.open('profile.php', '_self')</script>"; // Stay on the profile page
    }
} else {
    // Redirect if the username session variable is not set
    echo "<script>window.open('../index.php', '_self')</script>";
}
?>