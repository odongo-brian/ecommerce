<?php
include("../includes/connect.php");

if(isset($_POST['insert_cart'])){
    $category_title = $_POST['cart_title'];
    //checking if category already Exists in the DB
    $select_query = "SELECT * FROM categories WHERE category_title = '$category_title'";
    $result_select = mysqli_query($conn, $select_query);
    $rows = mysqli_num_rows($result_select);
    if($rows > 0){
        echo "<script>alert('Category Already Exists')</script>";
    }
    else{

    
        $insert_query = "INSERT INTO categories VALUES('', '$category_title')" ;
        $result = mysqli_query($conn, $insert_query);
        if($result){
            echo "<script>alert('Category has been inserted successfully')</script>";
        }
        else{
            echo(mysqli_error($conn));
        }
    }
}
?>
<h3 class="text-center">Insert Categories</h3>
<form action="" method="post" class="mb-2">
    <div class="input-group mb-2 w-90">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cart_title" placeholder="Insert categories">
    </div>

    <div class="input-group mb-2 w-10 m-auto" >
        
       <!-- <input type="submit" class="form-control bg-info" name="insert_cart" value="Insert categories">-->
        <button type="submit" class="bg-info p-2 my-3 border-0" name="insert_cart">Insert categories</button>
    </div>
</form>