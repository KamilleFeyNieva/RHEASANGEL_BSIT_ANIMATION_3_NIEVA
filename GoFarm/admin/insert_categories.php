<?php

include('../includes/connect.php'); //$con initialization
if(isset($_POST['add_cat'])){
  $category_title=$_POST['cat_title'];

  //pang search ng db
  $select_query="select * from `categories` where category_name = '$category_title'"; //BACKTICKS DAMN IT
  $result_select=mysqli_query($con,$select_query);
  $number=mysqli_num_rows($result_select);

  //check kung nandyan na value something sa db
  if($number>0){
    echo "<script>alert('This category already exists')</script>";
  } else{

    //BACKTICKS NGA KASE EH `pang table column names` hindi 'pang string literals'
  $insert_query="insert into `categories` (category_name) values ('$category_title')"; // SAME NAME AS MYSQL DATABASE
  $result=mysqli_query($con,$insert_query);

    if($result){
      echo "<script>alert('Category added successfully') </script>";
    }
  }
}

?>

<h2 class="text-center">Add Categories</h2>

<form action="" method="post"   class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-info" id="addon-wrapping"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" name="cat_title" placeholder="Add Categories" aria-label="Categories" aria-describedby="addon-wrapping">
</div>
<div class="input-group w-10 mb-2 m-auto">
  <input type="submit" class="bg-info border-0 p-2 my-3" name="add_cat" value="Add Categories">
</div>
</form>