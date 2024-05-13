<?php
require_once('connect.php');

// เริ่มต้นเซสชัน
session_start();

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
// Check if id_bill is set via GET and set it in session if available
if(isset($_GET['id_bill'])) {
    $_SESSION['id_bill'] = $_GET['id_bill'];
} else {
    $_SESSION['id_bill'] = "default_value";
} 
 $id_bill = $_SESSION['id_bill'];

// ตรวจสอบว่ามีการส่งค่าไอดีบิลผ่าน URL หรือไม่
if (!isset($_GET['id_bill']) || empty($_GET['id_bill'])) {
    // หากไม่มีให้แสดงข้อความและ redirect ไปยังหน้าที่แสดงรายการบิล
    echo "<script>
    alert('Invalid request! Please select a bill.');
    window.location.href='admin_page.php';
    </script>";
    exit(); // จบการทำงานของสคริปต์ที่นี่
}

// ดึงข้อมูลบิลจากฐานข้อมูลโดยใช้ไอดีบิลที่ระบุ
$bill_id = $_GET['id_bill'];
$query = "SELECT * FROM bill WHERE id_bill = $bill_id";
$result = mysqli_query($conn, $query);

// ตรวจสอบว่ามีบิลที่ตรงกับไอดีที่ระบุหรือไม่
if (mysqli_num_rows($result) == 0) {
    // หากไม่มีให้แสดงข้อความและ redirect ไปยังหน้าที่แสดงรายการบิล
    echo "<script>
    alert('Bill not found! " . mysqli_error($conn) . "');
    window.location.href='admin.php';
    </script>";
    exit(); // จบการทำงานของสคริปต์ที่นี่
}

// ดึงข้อมูลบิลและรายละเอียดการสั่งซื้อที่เกี่ยวข้องจากฐานข้อมูล
$bill_data = mysqli_fetch_assoc($result);
$employeeId =  $_SESSION['username'];
$query = "SELECT bill.*, products.name AS product_name, 
order_detail.qty, order_detail.price, 
(order_detail.qty * order_detail.price) AS total_price, 
t_able.name AS table_name, 
order_detail.status AS status_or, 
order_detail.comment
FROM bill
INNER JOIN order_detail ON bill.id_bill = order_detail.id_bill
INNER JOIN products ON order_detail.id_product = products.id_product
INNER JOIN t_able ON bill.id_table = t_able.id_table
WHERE bill.id_bill =  $bill_id";
$detail_result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="css/bill.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="invoice-container">
    
        <div class="header">
            <h1>Invoice : Coffee Shop</h1>
            <p>Invoice Number: <?php echo $bill_data['id_bill']; ?></p>
            <p>Date and Time: <?php echo date('Y-m-d H:i:s'); ?></p>
        </div>
        <div class="customer-info">
            <h2>Bill Information</h2>
            <p>Name Employee: <?php echo $employeeId ?></p>
            <p>Tel : 0980939604 (เบอร์ร้าน)</p>
            <!-- Add other customer information here if needed -->
        </div>
        <div class="order-details">
            <h2>Order Details</h2>
            <table>
                <thead>
                    <tr>
                        <th style="text-align: center;">Product</th>
                        <th style="text-align: center;">Quantity</th>
                        <th style="text-align: right;">Unit Price</th>
                        <th style="text-align: right;">Option</th>
                        <th style="text-align: right;">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total_price = 0; // Initialize total price

                    while ($row = mysqli_fetch_assoc($detail_result)):
                        $product_price = $row['price'];
                        $quantity = $row['qty'];
                        $comment = $row['comment'];
                       
                        $total = $product_price * $quantity; // Initialize total price with product price
                    
                        $shotPrice = 20; // Price of a shot
                        $toppingPrice = 0; // Initialize topping price
                    
                        // Calculate additional price for shot and topping based on the comment
                        if ($comment == 'Single Shot +20 Bath') {
                            $total += $shotPrice * $quantity;
                        } elseif ($comment == 'Double Shot +40 Bath') {
                            $total += ($shotPrice * 2 * $quantity);
                        } elseif ($comment == 'Triple Shot +60 Bath') {
                            $total += ($shotPrice * 3 * $quantity);
                        }

                        // Calculate total price for all items
                        $total_price += $total;
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['product_name']; ?> : <?php echo $row['comment']; ?></td>
                            <td style="text-align: center;"><?php echo $quantity; ?></td>
                            <td style="text-align: right;">
                                <?php 
                                    echo $row['price'] . " Bath";
                                ?>
                            </td>
                            <td style="text-align: right;">
                                <?php 
                                    if ($comment == 'Single Shot +20 Bath') {
                                        echo number_format($shotPrice) . " Bath";
                                    } elseif ($comment == 'Double Shot +40 Bath') {
                                        echo number_format($shotPrice * 2) . " Bath";
                                    } elseif ($comment == 'Triple Shot +60 Bath') {
                                        echo number_format($shotPrice * 3) . " Bath";
                                    } else {
                                        echo ""; // ถ้าไม่ตรงกับเงื่อนไขทั้งหมด
                                    }
                                ?>
                            </td>
                            <td style="text-align: right;"><?php echo number_format($total); ?> Bath</td>
                        </tr>
                    <?php endwhile; ?>
                    
                    <tr class="total-row">
                        <td colspan="4">Total</td>
                        <td><?php echo number_format($total_price); ?> Bath</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="text-align: center;" >
            <h4><i>Thank You. <br>
                    Have a good day with you 
            </i></h4>
        </div>
        <br><br>
        <div>
        <button type="button" class="btn btn-success" onclick="printReceipt('<?php echo $bill_data['id_bill']; ?>')">Print invoice</button>
        <br>
        <br>
        <form action="bill-close.php" method="GET">
            <select class="form-select" id="type" name="type" required>
                <option value="" selected disabled>Select Main Type</option>
                <option value="Cash">Cash</option>
                <option value="M-Banking">M-Banking</option>
            </select>
                <br>
            <input type="hidden" name="id" value="<?php echo $bill_data['id_bill']; ?>">
            <button type="submit" class="btn btn-danger">Close Bill</button>
        </form>
        </div>
           
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function printReceipt(id) {
        // เรียกใช้ window.print() เพื่อพิมพ์หน้าปัจจุบัน
        window.print();
    }
</script>
</html>

<?php
// ปิดการเชื่อมต่อกับฐานข้อมูล
mysqli_close($conn);
?>
