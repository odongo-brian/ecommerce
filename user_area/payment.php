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
    <title>payment page</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/fontawesome/css/all.min.css">
</head> 
<style>
    .payment_img{
        width:90%;
        margin: auto;
        display: block;
    }
</style>
<body>
    <!--php code to access user id-->
    <?php
        $user_ip = getIPAddress();
        $get_user = "SELECT * FROM user_table WHERE user_ip='$user_ip'";
        $result = mysqli_query($conn, $get_user);
        $run_query = mysqli_fetch_array($result);
        $user_id = $run_query['user_id'];

    ?>
    <div class="container">
        <h2 class="text-center text-info">Payment options</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col-md-6">
                <a href="https://www.paypal.com"><img src="../images/upi.jpg"  target="_blank" alt="upi image" class="payment_img"></a>
            </div>

            <div class="col-md-6">
                <a href="order.php?user_id=<?php echo $user_id ?>"><h2 class = "text-center">Pay Offline</h2></a>
            </div>
        </div>
    </div>
</body>
</html>