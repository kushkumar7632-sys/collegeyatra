<?php

include "connect.php";

$mobile = $_POST['mobile'];
$user_otp = $_POST['otp'];

$sql = "SELECT * FROM otp_verification WHERE mobile='$mobile' ORDER BY id DESC LIMIT 1 ";

$result = $conn -> query($sql);
$row = $result -> fetch_assoc();

if ($row ['otp'] == $user_otp){
    header("Location: login.html");
    exit;
}
else {
        echo "Error: " . mysqli_error($conn);
    }




?>