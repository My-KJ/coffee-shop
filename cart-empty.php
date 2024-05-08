<?php
session_start();
require_once('connect.php');

// ตรวจสอบว่ามีการล็อกอินแล้วหรือไม่
if (!isset($_SESSION['username'])) {
    // หากยังไม่ได้ล็อกอิน ให้ redirect ไปยังหน้า index.php
    echo "<script>
    alert('Please! login');
    window.location.href='index.php';
    </script>";
    exit(); // จบการทำงานของสคริปต์ที่นี่
}

// ตรวจสอบว่ามีการล็อกอินแล้วหรือไม่ และผู้ใช้เป็น admin และไม่ได้ลาออก
if (!isset($_SESSION['username']) || $_SESSION['type'] !== 'admin' || $_SESSION['status'] === 'Resign') {
    // หากยังไม่ได้ล็อกอินหรือไม่ใช่ admin หรือเป็น " ให้แสดงแจ้งเตือนและ redirect ไปยังหน้า index.php
    echo "<script>
    alert('Sorry! : You have resigned / You have been fired.');
    window.location.href='index.php';
    </script>";
    exit(); // จบการทำงานของสคริปต์ที่นี่
}

 // Check if id_bill is set via GET and set it in session if available
 if(isset($_GET['id_bill'])) {
    $_SESSION['id_bill'] = $_GET['id_bill'];
} else {
    $id_bill = "default_value";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart is Empty</title>
    <link rel="stylesheet" href="css/cart-emp.css">
</head>
<body>
    <div class="container">
        <h1>Your Cart is Empty</h1>
        <p>Looks like you haven't added any items to your cart yet.</p>
        <a href="product.php?id_bill=<?php echo $_SESSION['id_bill']; ?>" class="btn-continue">Continue Shopping</a>
    </div>
</body>
</html>
