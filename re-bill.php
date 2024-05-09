<?php
// Include database connection
require_once('connect.php');
session_start();

// Check if ID is provided
if(isset($_GET['id'])) {
    // Sanitize ID
    $order_detail_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Prepare SQL query to update status
    $sql = "UPDATE order_detail SET status = 'Re-bill' WHERE id = '$order_detail_id'";

    // Execute query
    if(mysqli_query($conn, $sql)) {
        // Success! Redirect back to previous page or any other page as needed
        echo '<script>alert("Restart Bill!"); window.location.href = "order-details.php";</script>';
        exit();
    } else {
        // Error occurred while updating status
        echo "Error updating status: " . mysqli_error($conn);
    }
} else {
    // ID not provided
    echo "ID not provided.";
}
?>
