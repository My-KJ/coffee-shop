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

// ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if (isset($_POST['submit'])) {
    // ตรวจสอบว่าโต๊ะถูกเลือกหรือไม่
    if (!empty($_POST['table'])) {
        // รับข้อมูลจากฟอร์ม
        $tableId = $_POST['table'];
        $employeeId = 1; // ให้ใช้รหัสพนักงานตามที่กำหนด
        $orderDate = date("Y-m-d H:i:s"); // วันที่และเวลาปัจจุบัน
        $totalPrice = null;
        $status = 'not paid';
        $type = null;

        // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูลลงในตาราง bill
        $sql = "INSERT INTO `bill` (`id_emp`, `total_price`, `status`, `order_date`, `type`, `id_table`) 
                VALUES ('$employeeId', '$totalPrice', '$status', '$orderDate', '$type', '$tableId')";

        // ทำการเรียกใช้คำสั่ง SQL
        if (mysqli_query($conn, $sql)) {
            // เมื่อเพิ่มข้อมูลลงในตาราง bill เรียบร้อยแล้ว
            // ให้ดึงรหัสล่าสุดของบิลที่เพิ่มเข้าไป
            $lastInsertedBillId = mysqli_insert_id($conn);

            // ทำการเพิ่มข้อมูลในตาราง order_detail
            $sql_order_detail = "INSERT INTO `order_detail` (`id_bill`, `id_product`, `qty`, `price`, `comment`, `status`) 
                                VALUES ('$lastInsertedBillId', null, null, null, null, 'Wait')";

            if (mysqli_query($conn, $sql_order_detail)) {
                // หากเพิ่มข้อมูลลงในตาราง order_detail เรียบร้อยแล้ว
                // หลังจากสร้างบิลสำเร็จเรียบร้อย
                echo '<script> 
                alert("Bill created successfully");
                window.location.href = "product.php?id_bill=' . $lastInsertedBillId . '"; // ไปยังหน้า product.php พร้อมส่งรหัส bill
                </script>';
            } else {
                // หากมีปัญหาในการเพิ่มข้อมูลลงในตาราง order_detail
                echo '<script> 
                    alert("Error creating bill: ' . mysqli_error($conn) . '");
                    window.location.href = "admin.php"; // หรือไปยังหน้าที่แสดงแบบฟอร์มอีกครั้ง
                    </script>';
            }
        } else {
            // หากมีปัญหาในการเพิ่มข้อมูลลงในตาราง bill
            echo '<script> 
                alert("Error creating bill: ' . mysqli_error($conn) . '");
                window.location.href = "admin.php"; // หรือไปยังหน้าที่แสดงแบบฟอร์มอีกครั้ง
                </script>';
        }
    } else {
        // หากไม่ได้เลือกโต๊ะ
        echo '<script> 
            alert("Please select a table.");
            window.location.href = "admin.php"; // หรือไปยังหน้าที่แสดงแบบฟอร์มอีกครั้ง
            </script>';
    }
}

mysqli_close($conn);
?>