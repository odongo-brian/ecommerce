<?php

$conn = mysqli_connect("localhost", "root", "", "mystore");

if(!$conn){
    die("Error in connection " .mysqli_error($conn));

    
}

?>
