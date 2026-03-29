<?php
include("../config/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $employeeId = $_POST['employeeId'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    $sql = "INSERT INTO users (full_name,employeeId, email, phone_no, password, user_type) 
            VALUES ('$full_name', '$employeeId', '$email', '$phone_no', '$password', '$user_type')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Registration successful. You can now log in.');
        window.location.href='../index.php';   
        </script>";
    }
    else {
        echo "<script>
        alert('Error: " . mysqli_error($conn) . "');
        window.location.href='registration.php';
        </script>";
    }
}
?>