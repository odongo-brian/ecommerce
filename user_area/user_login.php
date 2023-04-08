<?php
include("../includes/connect.php");
include("../functions/common_function.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/fontawesome/css/all.min.css">

    <style>
        body{
            overflow-x:hidden;
        }
    </style>
</head>
<body>
   <div class="container-fluid my-3">
    <h2 class="text-center"> User Login</h2>
    <div class="row d-flex align-items-center justify-content-center mt-5">
        <div class="col-lg-12 col-xl-6">
            <form action="" method="post">
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required name="user_username">
                </div>
                <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required name="user_password">
                </div>
                <div class="text-center">
                    <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login" >
                    <p  class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="user_registration.php" class="text-decoration-none text-danger">Register</a></p>
                </div>

            </form>
        </div>
    </div>
   </div> 
</body>
</html>

<?php
if(isset($_POST['user_login'])){
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    //creating the username session
    $_SESSION['username'] = $user_username;
    $select_query = "SELECT * FROM user_table WHERE username='$user_username'";
    $result = mysqli_query($conn, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    $user_ip = getIPAddress();
    //cart item
    $select_query_cart = "SELECT * FROM cart_details WHERE ip_address='$user_ip'";
    $select_cart = mysqli_query($conn, $select_query_cart);
    $row_count_cart = mysqli_num_rows($select_cart);



    if($row_count > 0){
        if(password_verify($user_password,$row_data['user_password'] )){
            //echo "<script>alert('Login successful')</script>";
            //user present-> $row_count==1 and no item in the cart-> $row_count_cart==0
            if($row_count == 1 AND $row_count_cart == 0){
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            }
            else{
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('payment.php','_self')</script>";
            }
        }
        else{
            echo "<script>alert('Invalid credentials')</script>";

        }
    }
    else{
        echo "<script>alert('Invalid credentials')</script>";
    }
}
?>