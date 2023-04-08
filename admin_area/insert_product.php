<?php
include("../includes/connect.php");
if(isset($_POST['product_btn'])){
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keyword = $_POST['product_keyword'];
    $product_categories = $_POST['product_categories'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';
    //accessing images

    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    //accessing image tmp name (tmp->temporary)
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    //checking empty conditions
    if($product_title == '' || $product_description == '' || $product_keyword == '' || $product_categories == '' || $product_brands == '' || $product_price == '' || $product_image1 == '' || $product_image2 == '' || $product_image3 == ''){
        echo "<script>alert('Please fill all the available fields')</script>";
        exit();
        //header("location: admin_area\index.php");
    }
    
    else{
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");
        //insert query
        $insert_products = "INSERT INTO `products`(product_title,product_description,product_keywords,category_id,brand_id,product_image1,product_image2,product_image3,product_price,date, status) VALUES('$product_title', '$product_description', '$product_keyword', '$product_categories', '$product_brands', '$product_image1', '$product_image2', '$product_image3', '$product_price', NOW(), '$product_status' ) ";
        $result_query = mysqli_query($conn, $insert_products);
        if($result_query){
            echo "<script>alert('successfully Inserted the products')</script>";
        }
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert products Admin Dashboard</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/fontawesome/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!--form-->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">
                    product title
                </label>
                <input type="text" class="form-control" id="product_title" name="product_title" placeholder="Enter product title" autocomplete="off" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_description" class="form-label">
                    product description
                </label>
                <input type="text" class="form-control" id="product_description" name="product_description" placeholder="Enter product description" autocomplete="off" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">
                    product keyword
                </label>
                <input type="text" class="form-control" id="product_keyword" name="product_keyword" placeholder="Enter product keyword" autocomplete="off" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_categories"  class="form-select">

                    

                    <option value="">Select a Category</option>
                    <?php
                    $select_query = "SELECT * FROM categories";
                    $results = mysqli_query($conn, $select_query);
                    while($row = mysqli_fetch_assoc($results)){
                        $category_id = $row['category_id'];
            
                        $category_title = $row['category_title'];
                        ?>
                        <option value='<?php echo $category_id; ?>'><?php echo $category_title; ?> </option>
                        <?php
                    }
                    ?>
                    
                </select>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brands"  class="form-select">
                    <option value="">Select a Brand</option>
                    <?php
                    $select_query = "SELECT * FROM brands";
                    $results = mysqli_query($conn, $select_query);
                    while($row = mysqli_fetch_assoc($results)){
                        $brand_id = $row['brand-id'];
            
                        $brand_title = $row['brand_title'];
                        ?>
                        <option value='<?php echo $brand_id; ?>'><?php echo $brand_title; ?> </option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">
                    product image1 <br>
                </label>
                <input type="file" class="form-control" id="product_image1" name="product_image1" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">
                    product image2 <br>
                </label>
                <input type="file" class="form-control" id="product_image1" name="product_image2" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">
                    product image3 <br>
                </label>
                <input type="file" class="form-control" id="product_image1" name="product_image3" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">
                    product price
                </label>
                <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter product price" autocomplete="off" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                
                <input type="submit" class="btn btn-primary mb-3 px-3" id="product_btn" name="product_btn" value="Insert Product" >
            </div>

        </form>
    </div>


    <script src="../bootstrap/js/bootstrap.min.css"></script>
</body>
</html>