<?php
require_once('connect.php');

if (isset($_POST['submit'])) {
    $username   = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password   = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    $confirm_password = htmlspecialchars($_POST['confirm_password'], ENT_QUOTES, 'UTF-8');
    $name       = $_POST['name'];
    $status     = $_POST['status'];
    $tel        = $_POST['tel'];
    $type       = $_POST['type'];
    $create_at = date("Y-m-d H:i:s");
    $update_at = date("Y-m-d H:i:s");

    $checkUsernameQuery = "SELECT COUNT(*) as count FROM `employee` WHERE `username` = '$username'";
    $checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);
    $usernameExists = mysqli_fetch_assoc($checkUsernameResult)['count'];

     // Check if password is at least 8 characters long
    // Check if password is at least 8 characters long
    if (strlen($password) < 8) {
        echo "<script>alert('Password must be at least 8 characters long.');
        window.location.href = 'user-form-created.php';
        </script>";
        exit;
    }

    // Check if password matches the confirm password
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.');
        window.location.href = 'user-form-created.php';</script>";
        exit;
    }
    }

if ($usernameExists > 0) {
    // Username already exists, show an error message
    echo '<script> 
        alert("Username already exists. Please choose a different username.");
        window.location.href = "user-form-created.php";
        </script>';
        
} else {

   
    $sql = "INSERT INTO `employee` (`username`, `password`, `name`, `tel`, `status`, `type`, `create_at`, `update_at`) 
            VALUES ('$username', '$password', '$name', '$tel', '$status', '$type', '$create_at', '$update_at')";


    if (mysqli_query($conn, $sql)) {
        echo '<script> 
            alert("Data added successfully");
            window.location.href = "user-crud.php";
            </script>';
    } else {
        echo '<script> 
        alert("Error adding data: ' . mysqli_error($conn) . '");
            window.location.href = "user-form-created.php";
            </script>';
    }
    }
 


mysqli_close($conn);
?>