<?php
session_start();
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email == "" || $password == "") {
        die("Email and Password required");
    }

    // email search
    $sql = "SELECT id, name, password FROM sign_up WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        // password verify
        if (password_verify($password, $row['password'])) {

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name']    = $row['name'];

            header("Location: index.html");
            exit;

        } else {
            echo "❌ Wrong password";
        }

    } else {
        echo "❌ Email not registered";
    }
}
?>
