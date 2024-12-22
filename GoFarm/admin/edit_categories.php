<?php
    //connectted na siya sa index php, na connect na din yung view categ
    //bune, mas marami pa comments kaysa sa code eme hahahaha
    if(isset($_GET['edit_categories'])){
        $edit_categories=$_GET['edit_categories'];
      
        //  echo $edit_category; balikan kita kung anu ka man categ, kilala na kita categ yieee
      $get_categories="Select * from `categories` where category_id='$edit_categories'"; //psst backtick replying tama ba yung sa edit categ? // yung sa tuts kasi id nakalagay huhu
      $result=mysqli_query($con,$get_categories); //pabalik hahaha // hala pumula HAHAHAHAHAHAHAHAH
      $row=mysqli_fetch_assoc($result); // line 10 daw
      $category_name=$row['category_name']; // meoww ano prob rhea? // ewan// iyaq // ano id?
      // echo $category_name; // wag capslock uyy hahaha, okay naaaaaaa traydor ginawang comment uli sa tuts

    }
    if(isset($_POST['edit_cat'])){
        $cat_name=$_POST['category_name']; // making sure na yung categ is name istead of title, pisti ka lira lutang pa more
        $update_query="update `categories` set category_name= '$cat_name' where 
         category_id='$edit_categories'";  //backtick // ay okackes po rheanim huhu // ay ayan thank you rhea hHHAHAHHAHA
         
         $result_cat=mysqli_query($con,$update_query);

         if($result_cat){
            echo "<script alert(Category is been successfully updated)></script>"; // diko sure meoww
            echo "<script>window.open('./index.php?view_categories','self')</script>";
         }

    }

?>
<div class="container mt-3">
    
    <h1 class="text-center">Edit Category</h1>
    <form action="" method="post"class="text-center"> 

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="category_name" class="form label">Category Title</label>
            <input type="text" name="category_name" id="category_name" class="form-control" 
            required="required"> 
        
        </div>

        <input type="submit" value="Update" class="btn btn-info px-3 mb-3"
        name="edit_cat"> 
    </form>
</div>