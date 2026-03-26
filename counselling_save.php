<?php
session_start();
include "connect.php";

if (!isset($_SESSION['user_id'])) {
    die("Login required");
}

$user_id = $_SESSION['user_id'];

$student = $_POST['student_name'];
$mother  = $_POST['mother_name'];
$father  = $_POST['father_name'];
$dob     = $_POST['dob'];
$address = $_POST['address'];
$pincode = $_POST['pincode'];

$marks10 = $_FILES['marks10']['name'];
$marks12 = $_FILES['marks12']['name'];

move_uploaded_file($_FILES['marks10']['tmp_name'], "uploads/".$marks10);
move_uploaded_file($_FILES['marks12']['tmp_name'], "uploads/".$marks12);

$sql = "INSERT INTO counselling_form
(user_id, student_name, mother_name, father_name, dob, address, pincode, marks10, marks12)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param(
    $stmt,
    "issssssss",
    $user_id,
    $student,
    $mother,
    $father,
    $dob,
    $address,
    $pincode,
    $marks10,
    $marks12
);

if (mysqli_stmt_execute($stmt)) {
    echo "✅ Counselling form submitted successfully";
} else {
    echo "❌ Error: " . mysqli_error($conn);
}
