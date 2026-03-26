<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name     = trim($_POST['name']);
    $mobile   = trim($_POST['mobile']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($name) || empty($mobile) || empty($email) || empty($password)) {
        echo "All fields are required";
        exit;
    }

    // password hash
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO sign_up (name, mobile, email, password)
            VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss",
        $name, $mobile, $email, $hashedPassword
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: login.html");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
