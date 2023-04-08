<?php
include("../includes/connect.php");
include("../functions/common_function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user registration</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/fontawesome/css/all.min.css">

</head>
<body>
   <div class="container-fluid my-3">
    <h2 class="text-center">New User Registration</h2>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 col-xl-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off"  name="user_username">
                </div>

                <div class="form-outline mb-4">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="email" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required name="user_email">
                </div>

                <div class="form-outline mb-4">
                    <label for="user_image" class="form-label">User image</label>
                    <input type="file" id="user_image" class="form-control"  required name="user_image">
                </div>

                <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required name="user_password">
                </div>

                <div class="form-outline mb-4">
                    <label for="confirm_user_password" class="form-label">Confirm Password</label>
                    <input type="password" id="confirm_user_password" class="form-control" placeholder="Confirm your password" autocomplete="off" required name="confirm_user_password">
                </div>

                <div class="form-outline mb-4">
                    <label for="user_address" class="form-label">Address</label>
                    <input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required name="user_address">
                </div>

                <div class="form-outline mb-4">
                    <label for="user_contact" class="form-label">Contact</label>
                    <input type="text" id="user_contact" class="form-control" placeholder="Enter your contact" autocomplete="off" required name="user_contact">
                </div>
                <div class="text-center">
                    <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register" >
                    <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="user_login.php" class="text-decoration-none text-danger">Login</a></p>
                </div>

            </form>
        </div>
    </div>
   </div> 
</body>
</html>


<!--php code-->
<?php
if(isset($_POST['user_register'])){
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $_user_password = $_POST['user_password'];
    $hash_password = password_hash($_user_password, PASSWORD_DEFAULT);
    $confirm_user_password = $_POST['confirm_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();

    //select query
    $select_query  = "SELECT * FROM user_table WHERE username='$user_username' || user_email='$user_email'"; 
    $result = mysqli_query($conn, $select_query);

    $rows_count = mysqli_num_rows($result);
    if($rows_count > 0){
        echo "<script>alert('username or email already Exists')</script>";

    }
    else if($_user_password!=$confirm_user_password){
        echo "<script>alert('passwords do not match')</script>";
    }
    else{
        //add to the DB
        //insert query
        move_uploaded_file($user_image_tmp,"user_images/$user_image");
        $insert_query = "INSERT INTO user_table(username, user_email, user_password, user_image, user_ip, user_address, user_mobile)VALUES('$user_username','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_contact')";
        $sql_execute = mysqli_query($conn, $insert_query);
        if($sql_execute){
            echo "<script>alert('Added successfully')</script>";
        }
        else{
            die("error ".mysqli_error($conn));
        }
    }
 //selecting cart items
 $select_cart_items = "SELECT * FROM cart_details WHERE ip_address='$user_ip'";
 $result_cart = mysqli_query($conn, $select_cart_items);
 $rows_count = mysqli_num_rows($result_cart); 
 if($rows_count > 0){
    $_SESSION['username'] = $user_username;
    echo "<script>alert('You have items in your cart')</script>";
    echo "<script>window.open('checkout.php','_self')</script>";


 }
 else{
    echo "<script>window.open('../index.php','_self')</script>";

 }
}
?>