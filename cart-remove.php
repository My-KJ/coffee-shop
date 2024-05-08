<?php
session_start();

 // Check if id_bill is set via GET and set it in session if available
 if(isset($_GET['id_bill'])) {
    // บันทึก ID ลงใน Session
    $_SESSION['id_bill'] = $_GET['id_bill'];
    
}
// ตรวจสอบว่ามีค่า productId และ productPrice ส่งมาจาก URL หรือไม่
if(isset($_GET['id']) && isset($_GET['price'])) {
    $productId = $_GET['id'];
    $productPrice = $_GET['price'];

    // ตรวจสอบว่ามีข้อมูลในตะกร้าหรือไม่
    if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        // หา index ของสินค้าในตะกร้า
        foreach($_SESSION['cart'] as $index => $item) {
            if($item['id'] == $productId && $item['price'] == $productPrice) {
                // ถ้า quantity เหลือ 1 ให้ลบสินค้าออกจากตะกร้า
                if($item['quantity'] == 1) {
                    unset($_SESSION['cart'][$index]);
                } else {
                    // หาก quantity มากกว่า 1 ให้ลด quantity ลงทีละหนึ่ง
                    $_SESSION['cart'][$index]['quantity']--;
                }
                break;
            }
        }
    }

    // ลิ้งค์กลับไปยังหน้า cart.php
    
    header("Location: cart.php" . $_SESSION['$id_bill']);
    exit;
} else {
    // ถ้าไม่มีค่า productId หรือ productPrice ส่งมาจาก URL
    // ให้ลิ้งก์กลับไปยังหน้า cart.php
    header("Location: cart.php" . $_SESSION['$id_bill']);
    exit;
}
?>
