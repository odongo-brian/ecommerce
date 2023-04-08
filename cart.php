<?php
include("includes/connect.php");
include("functions/common_function.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Details</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/fontawesome/css/all.min.css">

    <style>
        .cart_img{
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
    </style>
</head>
<body>
    <!--navbar-->
    <div class="container-fluid p-0">
        <!--first-child-->
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid ">
                <!--<a class="navbar-brand" href="#">Olibe Shop</a>-->
                <img src="images/admin.jpg" class="logo" alt="">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="user_area/user_registration.php">Register</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_items();?></sup></a>
                        
                     </ul>
                    
                </div>
            </div>
        </nav>

        <!--calling cart function-->
        <?php
        cart();
        ?>

        <!--second child-->
        <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
            <ul class="navbar-nav me-auto">
            <?php
            //if not yet logged in , display the login button
            if(!isset($_SESSION['username'])){
                echo '<li class="nav-item">
                <a class="nav-link" href="user_login.php">Login</a>
            </li>';
            }
            else{
                ?>
                <li class="nav-item">
                 <a class="nav-link" href="#">Welcome <?php echo $_SESSION['username']; ?></a>
                </li>

                <?php
                //user already logged in, display the logout btn
                echo '<li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>';
            }
            ?>
            </ul>
        </nav>

        <!--third child-->
        <div class="bg-light">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communications is at the heart of e-commerce and community</p>
        </div>

        <!--fourth child-->
        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered text-center">
                        
                        <tbody>
                            <!--display dynamic data-->
                            <?php
                            global $conn;
                            $get_ip_add = getIPAddress();
                            $total = 0;
                            $cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
                            $result = mysqli_query($conn, $cart_query);
                            $result_count = mysqli_num_rows($result);
                            if($result_count>0){
                                echo '<thead>
                                <tr>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Quantity</th>
                                    <th>Total price</th>
                                    <th>Remove</th>
                                    <th colspan="2">Operations</th>
                                </tr>
                            </thead>';
                            
                            while($row = mysqli_fetch_array($result)){
                                $product_id = $row['product_id'];
                                $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
                                $result_products = mysqli_query($conn, $select_products);
                                while($row_product_price=mysqli_fetch_array($result_products)){
                                    $product_price = array($row_product_price['product_price']);
                                    $price_table = $row_product_price['product_price'];
                                    $product_title = $row_product_price['product_title'];
                                    $product_image1 = $row_product_price['product_image1'];
                                    $product_values = array_sum($product_price);
                                    $total += $product_values;

                            ?>


                            <tr>
                                <td><?php echo $product_title ?></td>
                                <td><img src="./admin_area/product_images/<?php echo $product_image1 ?>" alt="" class="cart_img"></td>
                                <td><input type="text" class="form-input w-50" name="qty"></td>
                                 <?php
                                    $get_ip_add = getIPAddress();
                                    if(isset($_POST['update_cart'])){
                                        $quantities = $_POST['qty'];
                                        $update_cart = "UPDATE cart_details SET quantity=$quantities WHERE ip_address='$get_ip_add'";
                                        $result_products_quantity = mysqli_query($conn, $update_cart);
                                        $total = $total*$quantities;
                                    }
                                 ?>
                                <td><?php echo "Ksh ". $price_table; ?></td>
                                <td><input type="checkbox" name="removeitem[]" id=""value="<?php echo $product_id ?>" ></td>
                                <td class= "d-flex">
                                    <input type="submit" value="Update" class="bg-info px-3 py-2  mx-3  border-0" name="update_cart">
                                    <input type="submit" value="Remove" class="bg-info px-3 py-2  mx-3  border-0" name="remove_cart">
                                </td>
                            </tr>
                            <?php
                            }
                        }
                    }
                    else{
                        echo "<h2 class='text-center text-danger'>Cart is Empty!</h2>";
                    }
                            ?>
                        </tbody>
                    </table>

                    <!--subtotal-->
                    <div class="d-flex mb-5">
                    <?php
                        $get_ip_add = getIPAddress();
                        //$total = 0;
                        $cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
                        $result = mysqli_query($conn, $cart_query);
                        $result_count = mysqli_num_rows($result);?>
                        <!--<h4 class="px-3">Subtotal: <strong class="text-info"><?php //echo $total ?></strong></h4>-->
                        <?php
                        if($result_count>0){
                            echo '<h4 class="px-3">Subtotal: <strong class="text-info">'. $total.  '</strong></h4>
                            <button class="bg-info px-3 py-2 border-0 text-dark me-5"><a href="index.php" class="text-decoration-none text-light" >Continue Shopping</a></button>
                            <button class="bg-secondary px-3 py-2 border-0 text-light"><a href="user_area/checkout.php" class="text-decoration-none text-light" >Checkout</a></button>
                            ';
                        }
                        else{
                            //echo '<a href="index.php"><button class="bg-info px-3 py-2  mx-3  border-0">Continue shopping</button></a>';
                            //echo '<a href="index.php" class="btn btn-link btn-info">try</a>';
                            //echo '<button><a href="index.php" class="bg-info px-3 py-2 mx-3">Contine</a></button>';
                            echo '<a href="index.php" class="bg-info px-3 py-2 mx-3 text-decoration-none text-dark border-0">Continue shopping</a>';
                             
                            
                        }

                    ?>
                    
                    </div>
            </div>
        </div>
    </form>

    <!--functon to remove items-->
    <?php
        function remove_cart_item(){
            global $conn;
            if(isset($_POST['remove_cart'])){
                foreach($_POST['removeitem'] as $remove_id){
                    echo $remove_id;
                    $delete_query = "DELETE FROM cart_details WHERE product_id=$remove_id";
                    $run_delete = mysqli_query($conn, $delete_query);
                    if($run_delete){
                        echo "<script>window.open('cart.php','_self')</script>";
                    }
                }
            }
        }
        echo $remove_item = remove_cart_item();
    ?>

        <!--last child-->
        <?php
            include("includes/footer.php");
        ?>

    </div>

    <!--bootstrap js link-->
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>