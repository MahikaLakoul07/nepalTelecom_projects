<?php
    include ("../config/connection.php");
    if(isset($_POST['submit']))
    {
    $username = $_POST['UserName']; //this will be the full_name
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE full_name='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    //Fetching rows
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    //Counting rows
    $count = mysqli_num_rows($result); 
    
    if($count == 1) 
    {
        session_start();
        $_SESSION['user_type'] = $row['user_type'];
        $_SESSION['username'] = $row['full_name'];
        $_SESSION['userId'] = $row['userId'];
        
        header("Location: ../welcome.php");
    } 
    else 
    {
        echo "<script>
        alert('Login failed. Invalid username or password.');
        window.location.href='../index.php';
        </script>";
    }
}
?>