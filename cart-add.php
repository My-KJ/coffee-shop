<?php
session_start();

// เชื่อมต่อกับฐานข้อมูล
include 'connect.php';

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
    $_SESSION['id_bill'] = "default_value";
}

// ตรวจสอบว่ามีการส่งค่า ID และจำนวนสินค้าผ่าน POST หรือไม่
if(isset($_POST['id']) && isset($_POST['quantity']) && isset($_POST['price']) && isset($_POST['comment'])) {
    // ดึงข้อมูลสินค้าจากฐานข้อมูลโดยใช้ ID ที่ส่งมา
    $id = $_POST['id'];
    $price = $_POST['price'];
    $sql = "SELECT * FROM products WHERE id_product = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // ตรวจสอบว่ามีตะกร้าสินค้าอยู่หรือไม่ หากไม่มีให้สร้างตะกร้าใหม่
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // เพิ่มสินค้าลงในตะกร้า
        $item = array(
            'id' => $row['id_product'],
            'name' => $row['name'],
            'price' => $price,
            'quantity' => $_POST['quantity'],
            'comment' => $_POST['comment'],
            'image' => $row['image']
        );
        $_SESSION['cart_count'] = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] + $_POST['quantity'] : $_POST['quantity'];
        // เพิ่มสินค้าในรายการหรืออัปเดตจำนวนหากมีสินค้าอยู่แล้ว
        $found = false;
        foreach ($_SESSION['cart'] as &$cartItem) {
            if ($cartItem['id'] == $item['id'] && $cartItem['price'] == $item['price'] && $cartItem['comment'] == $item['comment']) {
                $cartItem['quantity'] += $item['quantity'];
                $found = true;
                break;
            }
        }
        if (!$found) {
            $_SESSION['cart'][] = $item;
        }

        // Redirect ไปยังหน้าสินค้าที่มีอยู่
        echo '<script>window.location.href = "product.php?id_bill=' . $_SESSION['id_bill'] . '&id=' . $id . '";</script>';
        exit();
    } else {
        echo "Product not found!";
    }
} else {
    echo mysqli_error($conn);
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
$conn->close();
?>
