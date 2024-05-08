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

// ตรวจสอบว่ามีข้อมูลในตะกร้าหรือไม่
if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Your Cart</title>  
</head>
<body>
    
    <main>
        <div class="container">
            <h1>Your Cart</h1>

            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>                     
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   $totalPrice = 0;

                   foreach($_SESSION['cart'] as $item) {
                       $productId = $item['id'];
                       $productName = $item['name'];
                       $productPrice = $item['price'];
                       $quantity = $item['quantity'];
                       $comment = $item['comment'];
                       $productImage = $item['image'];

                        // คำนวณราคาทั้งหมดโดยการคูณราคาสินค้าด้วยจำนวนสินค้า
                        $total = $productPrice* $quantity;

                   
                       $shotPrice = 20; // ราคาของ shot ที่ต้องการเพิ่ม
                        $toppingPrice = 0;
                        if ($comment == 'Single Shot +20 Bath') {
                            $total += $shotPrice;
                        } elseif ($comment == 'Double Shot +40 Bath') {
                            $total += ($shotPrice * 2);
                        } elseif ($comment == 'Triple Shot +60 Bath') {
                            $total += ($shotPrice * 3);
                        } elseif ($comment == 'Bubble +5 Bath') {
                            $toppingPrice += 5; // เพิ่มราคา Bubble
                        } elseif ($comment == 'Milk Pudding +10 Bath') {
                            $toppingPrice += 10; // เพิ่มราคา Milk Pudding
                        } elseif ($comment == 'Wip Cheese +20 Bath') {
                            $toppingPrice += 20; // เพิ่มราคา Whip Cheese
                        }

                        // เพิ่มราคา Toping เข้าไปในราคาของสินค้า
                        $total += $toppingPrice;

                        // เพิ่มยอดรวมของสินค้าที่คำนวณได้ลงในยอดรวมทั้งหมด
                        $totalPrice += $total;  
                    ?>
                    <tr>
                        <td style="text-align: center;">
                            <img src="<?= $productImage ?>" alt="Product Image" style="width: 60px; height: auto;">
                        </td>
                        <td style="text-align: center;"><?= $productName ?> | <?= $comment ?></td>
                        <td><?= $productPrice ?> Bath</td>
                        <td style="text-align: center;"> <?= $quantity ?> </td> 
                        
                        <td>
                            <!-- ให้ลิงค์ไปยังไฟล์ cart-remove.php เพื่อลบสินค้านี้ -->
                            <a href="cart-remove.php?id=<?= $productId ?>&price=<?= $productPrice ?>">Remove</a>
                        </td>
                    </tr>
                    <?php 
                    } 
                    ?>
                </tbody>
            </table>

            <!-- แสดงราคารวมของสินค้าทั้งหมด -->
            <p>Total Price: <?= $totalPrice ?> Bath</p>
            
            <form action="checkout.php?id_bill=<?php echo $_SESSION['id_bill'];?>" method="post">
            <button type="submit" class="check-out">Check Bill.</button>
            </form>
                                
            <button onclick="location.href='product.php?id_bill=<?php echo $_SESSION['id_bill']; ?>'" class="previous">Continue Shopping</button>
                    
        </div>
    </main>
<?php

    // ตรวจสอบว่ามีการกดปุ่ม Check Bill หรือไม่
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // ไปยังหน้า customer-wait.php
        header("Location: customer-wait.php?id_bill=" . $_SESSION['id_bill']);
        exit;
    }

} else {

    // ถ้าตะกร้าว่าง
    header("Location: cart-empty.php?id_bill=" . $_SESSION['id_bill']);
    exit; // สิ้นสุดการทำงานของสคริปต์หลังจากใช้ header() เพื่อให้โค้ดที่เหลือไม่ทำงานต่อ
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
