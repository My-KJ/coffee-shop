<?php
    session_start();
    include 'connect.php';

    $id_bill = $_GET['id_bill'];
    $sql = "START TRANSACTION;
            DELETE FROM order_detail WHERE id_bill = $id_bill;
            DELETE FROM bill WHERE id_bill = $id_bill;
            COMMIT;";
    if ($conn->multi_query($sql) === TRUE) {
        echo "<script>alert('Record deleted successfully');
        window.location.href='admin.php'
        </script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $conn->close();
?>