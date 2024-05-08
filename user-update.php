<?php 
require_once('connect.php');

if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $status = $_POST['status'];
    $tel = $_POST['tel'];
    $type = $_POST['type'];
    $update_at = date("Y-m-d H:i:s");

    // Check if password is provided and matches the confirm password
    if (!empty($_POST['password'])) {
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
        $confirm_password = htmlspecialchars($_POST['confirm_password'], ENT_QUOTES, 'UTF-8');

        if ($password !== $confirm_password) {
            echo "<script>alert('Passwords do not match.');
            window.location.href = 'user-form-update.php';</script>";
            exit;
        }

        $password_sql = "password = '$password',";
    } else {
        // If password is not provided, exclude it from the update statement
        $password_sql = "";
    }

    // Proceed with the update
    $sql = "UPDATE employee SET 
        username = '$username',
        $password_sql
        name = '$name',
        status = '$status', 
        tel = '$tel',                
        type = '$type', 
        update_at = '$update_at'
        WHERE id_emp = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo '<script> 
            alert("Data updated successfully");
            window.location.href = "user-crud.php";
            </script>';
    } else {
        echo '<script> 
            alert("Error updating data: ' . mysqli_error($conn) . '");
            window.location.href = "user-form-update.php";
            </script>';
    }
}
?>
