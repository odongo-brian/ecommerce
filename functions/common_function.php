<?php

//getting products
function getProducts(){
    global $conn;
    //condition to check if category and brand isset or not
    if(!isset($_GET['categoryid'])){
        if(!isset($_GET['brandid'])){
            //if they are not set(brandid and categoryid), display all data
            
        
            $select_query = "SELECT * FROM products ORDER BY rand() LIMIT 0,9";
            $result = mysqli_query($conn, $select_query);
            while($row = mysqli_fetch_assoc($result)){
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];                        
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                echo "<div class='col-md-4 mb-2'>
                    <div class='card' style='width: 18rem;'>
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <p class='card-text'>Ksh $product_price</p>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                            <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                        </div>
                    </div>
                </div>";
            }
        }
    }
}

//getting all products
function get_all_products(){
    global $conn;
    //condition to check if category and brand isset or not
    if(!isset($_GET['categoryid'])){
        if(!isset($_GET['brandid'])){
            //if they are not set(brandid and categoryid), display all data
            
        
            $select_query = "SELECT * FROM products ORDER BY rand()";
            $result = mysqli_query($conn, $select_query);
            while($row = mysqli_fetch_assoc($result)){
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];                        
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                echo "<div class='col-md-4 mb-2'>
                    <div class='card' style='width: 18rem;'>
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <p class='card-text'>Ksh $product_price</p>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                            <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                        </div>
                    </div>
                </div>";
            }
        }
    }
}

//getting unique categories
function getUniqueCategories(){
    global $conn;
    //condition to check if category and brand isset or not
    if(isset($_GET['categoryid'])){
        
            //if they are not set(brandid and categoryid), display all data
            $category_id = $_GET['categoryid'];
        
            $select_query = "SELECT * FROM products WHERE category_id = $category_id";
            $result = mysqli_query($conn, $select_query);
            $num_rows = mysqli_num_rows($result);
            if($num_rows == 0){
                echo "<h2 class = 'text-center text-danger '>No stock for this category</h2>";
            }
            while($row = mysqli_fetch_assoc($result)){
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];                        
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                echo "<div class='col-md-4 mb-2'>
                    <div class='card' style='width: 18rem;'>
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <p class='card-text'>Ksh $product_price</p>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                            <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                        </div>
                    </div>
                </div>";
            }
        
    }
}

//getting unique brands
function getUniqueBrands(){
    global $conn;
    //condition to check if category and brand isset or not
    if(isset($_GET['brandid'])){
        
            
            $brand_id = $_GET['brandid'];
        
            $select_query = "SELECT * FROM products WHERE brand_id = $brand_id";
            $result = mysqli_query($conn, $select_query);
            $num_rows = mysqli_num_rows($result);
            if($num_rows == 0){
                echo "<h2 class = 'text-center text-danger '>This Brand is not available for service</h2>";
            }
            while($row = mysqli_fetch_assoc($result)){
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];                        
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                echo "<div class='col-md-4 mb-2'>
                    <div class='card' style='width: 18rem;'>
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <p class='card-text'>Ksh $product_price</p>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                            <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                        </div>
                    </div>
                </div>";
            }
        
    }
}


//displaying brands in sidenav
function getBrands(){
    global $conn;
    $select_brands = "SELECT * FROM brands";
                        $brands_query = mysqli_query($conn, $select_brands);
                        while($row = mysqli_fetch_assoc($brands_query)){
                            $brand_title = $row['brand_title'];
                            $brand_id = $row['brand-id'];
                           
                            ?>
                            <li class="nav-item">
                               <a href="index.php?brandid=<?php echo $brand_id; ?>" class="nav-link text-center"> <?php echo $row['brand_title'] ?></a> 
                                
                            </li>
                           

                            <?php 
                        }
}

//displaying categories in sidenav
function getCategories(){
    global $conn;
    $select_categories = "SELECT * FROM categories";
                        $categories_query = mysqli_query($conn, $select_categories);
                        while($rows = mysqli_fetch_assoc($categories_query)){
                            $category_title = $rows['category_title'];
                            $category_id = $rows['category_id'];
                            
                            ?>
                                <li class="nav-item">
                                    <a href='index.php?categoryid=<?php echo $category_id; ?>' class="nav-link text-center "> <?php echo$rows['category_title']; ?></a>
                                    
                                </li>
                            <?php
                            
                        }
}

//searching products function
function search_product(){
    global $conn;
    if(isset($_GET['search_data_product'])){
        $search_data_value = $_GET['search_data'];
            $search_query = "SELECT * FROM products WHERE product_keywords LIKE '%$search_data_value%'";
            $result = mysqli_query($conn, $search_query);
            $num_rows = mysqli_num_rows($result);
            if($num_rows == 0){
                echo "<h2 class = 'text-center text-danger '>No results match. No products found on this category!</h2>";
            }
            while($row = mysqli_fetch_assoc($result)){
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];                        
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                echo "<div class='col-md-4 mb-2'>
                    <div class='card' style='width: 18rem;'>
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <p class='card-text'>Ksh $product_price</p>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                            <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                         </div>
                    </div>
                </div>";
            }
    }    
    
}

//view details function
function view_details(){
    global $conn;
    //condition to check if category and brand isset or not
    if(isset($_GET['product_id'])){
        if(!isset($_GET['categoryid'])){
            if(!isset($_GET['brandid'])){

                //if they are not set(brandid and categoryid), display all data
                
                $product_id = $_GET['product_id'];
                $select_query = "SELECT * FROM products WHERE product_id = $product_id";
                $result = mysqli_query($conn, $select_query);
                while($row = mysqli_fetch_assoc($result)){
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];                        
                    $product_image1 = $row['product_image1'];
                    $product_image2 = $row['product_image2'];
                    $product_image3 = $row['product_image3'];
                    $product_price = $row['product_price'];
                    $category_id = $row['category_id'];
                    $brand_id = $row['brand_id'];
                    echo "<div class='col-md-4'>
                    <!--card-->
                    <div class='card' style='width: 18rem;'>
                        <img src='images/admin.jpg' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <p class='card-text'>Ksh $product_price</p>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
                            <a href='index.php' class='btn btn-secondary'>Go Home</a>
                        </div>
                    </div>
                </div>
                <div class='col-md-8'>
                        <div class='row'>
                            <div class='col-md-12'>
                                <h4 class='text-center text-info mb-5'>Related Products</h4>
                            </div>

                            <div class='col-md-6'>
                                <img src='admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title'>
                            </div>

                            <div class='col-md-6'>
                                <img src='admin_area/product_images/$product_image3' class='card-img-top' alt='$product_title'> 
                            </div>

                        </div>
                    </div>
                ";
                }
            }
        }
    }    
}

//getting the ip address function
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
//$ip = getIPAddress();  
//echo 'User Real IP Address - '.$ip;  


//cart function
function cart(){
    if(isset($_GET['add_to_cart'])){
        global $conn;
        $get_ip_add = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];

        $select_query = "SELECT * FROM cart_details WHERE ip_address = '$get_ip_add' AND product_id  = $get_product_id";
        $result = mysqli_query($conn, $select_query);
        
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            echo "<script>alert('Item already present in cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
        else{
            //$insert_query = "INSERT INTO cart_details(product_id,ip_address,quantity)VALUES('','$get_ip_add',0)";
            $insert_query = "INSERT INTO `cart_details`(`product_id`, `ip_address`, `quantity`) VALUES ('$get_product_id','$get_ip_add',0)";
            $result = mysqli_query($conn, $insert_query);
            if($result){
                echo "<script>alert('Item is added successfully')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }
            else{
                echo "Error during adding item ".mysqli_error($conn);
            }
        }
    }
}


//function to get number of items inside cart
function cart_items(){
    if(isset($_GET['add_to_cart'])){
        global $conn;
        $get_ip_add = getIPAddress();
        $select_query = "SELECT * FROM cart_details WHERE ip_address = '$get_ip_add'";
        $result = mysqli_query($conn, $select_query); 
        
        $count_cart_items = mysqli_num_rows($result);
    }
    else{
        global $conn;
        $get_ip_add = getIPAddress();
        $select_query = "SELECT * FROM cart_details WHERE ip_address = '$get_ip_add'";
        $result = mysqli_query($conn, $select_query); 
        
        $count_cart_items = mysqli_num_rows($result);
        
    }
    echo $count_cart_items;
} 

//total price function
function total_cart_price(){
    global $conn;
    $get_ip_add = getIPAddress();
    $total = 0;
    $cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
    $result = mysqli_query($conn, $cart_query);
    while($row = mysqli_fetch_array($result)){
        $product_id = $row['product_id'];
        $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
        $result_products = mysqli_query($conn, $select_products);
        while($row_product_price=mysqli_fetch_array($result_products)){
            $product_price = array($row_product_price['product_price']);
            $product_values = array_sum($product_price);
            $total += $product_values;
        }
    }
    echo $total;
}

?>