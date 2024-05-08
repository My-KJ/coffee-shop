<?php 
    
    require_once('connect.php');
    if (isset($_GET['id'])) {
        $sql = "DELETE FROM employee WHERE id_emp = '".mysqli_real_escape_string($conn, $_GET['id'])."' ";
        if (mysqli_query($conn, $sql)) {
            echo '<script> alert("Delete Complete.")</script>';
            header('Refresh:0; url= user-crud.php');
        } else {
            echo '<script> alert("Delete Failed.")</script>';
            header('Refresh:0; url= user-crud.php');
        }
    }
    mysqli_close($conn);
    
?>