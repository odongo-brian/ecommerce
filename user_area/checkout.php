<?php
include("../includes/connect.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/fontawesome/css/all.min.css">
</head>
<body>
    <!--navbar-->
    <div class="container-fluid p-0">
        <!--first-child-->
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid ">
                <!--<a class="navbar-brand" href="#">Olibe Shop</a>-->
                <img src="../images/admin.jpg" class="logo" alt="">
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
                        <a class="nav-link" href="#">Register</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                        </li>
 
                     </ul>
                    <form action="search_product.php" class="d-flex" role="search" method="get">
                        <input class="form-control me-2" type="search"  placeholder="Search" name="search_data" aria-label="Search">
                        <input type="submit" value="search" name="search_data_product" class="btn btn-outline-light">
                    </form>
                </div>
            </div>
        </nav>
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
        <div class="row px-2">
            <div class="col-md-12">
                <!--products-->
                <div class="row">
                    
                    <?php
                        if(!isset($_SESSION['username'])){
                            //if not logged in, redirect to login section
                            include('../user_area/user_login.php');
                        }
                        else{
                            //if user is logged in, redirect to payment options
                            include('payment.php');
                        }
                    ?>
                    <!--row end-->
                </div>
            </div>   
            
        </div>




        <!--last child-->
        <?php
            include("../includes/footer.php");
        ?>
     
    </div>

    <!--bootstrap js link-->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>