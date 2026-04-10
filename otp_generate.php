<?php

include "connect.php";

$otp = rand(1000,9999);
$mobile = $_POST['mobile'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST["password"];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO otp_verification (mobile, otp, name, email, password) VALUES ('$mobile','$otp','$name','$email','$hashedPassword')";

$conn -> query($sql);

header("Location: otp.html");

?>