<?php
session_start(); // Start the session to access session variables
include_once "connect.php"; // Include your database connection file

// Check if id_bill is set via GET and set it in session if available
if(isset($_GET['id_bill'])) {
    $_SESSION['id_bill'] = $_GET['id_bill'];
} else {
    $_SESSION['id_bill'] = "default_value";
}

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if session variable id_bill is set
    if(isset($_SESSION['id_bill'])) {
        // Retrieve id_bill from session
        $id_bill = $_SESSION['id_bill'];

        // Loop through each item in the cart
        foreach ($_SESSION['cart'] as $item) {
            $id_product = $item['id'];
            $qty = $item['quantity'];
            $price = $item['price'];
            $comment = $item['comment'];
            $status = "Processing";

            $total = $price * $qty; // Initialize total price with product price

            $shotPrice = 20; // Price of a shot
            $toppingPrice = 0; // Initialize topping price
        
            // Calculate additional price for shot and topping based on the comment
            if ($comment == 'Single Shot +20 Bath') {
                $total += $shotPrice * $qty;
            } elseif ($comment == 'Double Shot +40 Bath') {
                $total += ($shotPrice * 2 * $qty);
            } elseif ($comment == 'Triple Shot +60 Bath') {
                $total += ($shotPrice * 3 * $qty);
            } 
            
            // Insert data into order_detail table
            $query = "INSERT INTO order_detail (id_bill, id_product, qty, price, comment, status) 
                      VALUES ('$id_bill', '$id_product', '$qty', '$price', '$comment', '$status')";
            $result = mysqli_query($conn, $query);
                
            if (!$result) {
                // Handle the case where insertion fails
                echo "Error: " . mysqli_error($conn);
            }
        }
           // ไปยังหน้า customer-wait.php
           echo "<script>window.location.href='bill-create.php?id_bill=" . $_SESSION['id_bill'] . "'</script>";
        exit;
    } elseif (!isset($_SESSION['id_bill'])) {
        // Handle the case where id_bill session variable is not set
        echo "Error: id_bill session variable is not set.";
    }
} else {
    // Handle the case where request method is not POST
    echo "Error: This page can only be accessed via POST method.";
}
  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    // Loop through each item in the cart and remove it
    foreach ($_SESSION['cart'] as $key => $value) {
        unset($_SESSION['cart'][$key]);
        }
    }
}
?>
