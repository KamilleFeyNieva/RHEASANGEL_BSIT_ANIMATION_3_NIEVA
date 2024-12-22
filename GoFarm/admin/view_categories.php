<h3 class="text-center text-success">All Categories</h3>
    
<table class="table table-boardered mt-5">
        <thead class="bg-info">
            <tr class="text-center"> 
                <th>Category ID</th>
                <th>Category Name</th>
                <th>Edit</th>    
                <th>Delete</th>
            </tr>
        </thead>
        
        <tbody class="bg-secondary text-light"> 
            <?php
                $select_cat="Select * from`categories`"; //BACKTICK BACKTICK `  ` YAN, SERYOSO YAN SALARIN NG KALAHATI NG MGA ERROR
                $result=mysqli_query($con,$select_cat);
                $number=0;
                while($row=mysqli_fetch_assoc($result)){
                    $category_id=$row['category_id']; //pag nasa loob ng ['okay lang na ito gamit'] basta pag table `table_name`
                    $category_name=$row['category_name'];// sabi na papalitan yung variables diko lang ma figure out kagabi ay umaga pala hahaha
                    $number++;
                
            ?>
                <tr class="text-center">
                    <td><?php echo $number;?></td>
                    <td><?php echo $category_name;?></td>
                    <td><a href='index.php?edit_categories=<?php echo $category_id?>' class="text-light">
                    <i class="fa-solid fa-pen-to-square"></i></td>
                    <td><a href='index.php?delete_categories=<?php echo $category_id?>' class="text-light"><i class="fa-solid fa-trash"></i></td>
                </tr>
            <?php
            
        } ?>

        </tbody>
</table>

