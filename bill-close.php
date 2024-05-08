<?php
require_once('connect.php');

// เริ่มต้นเซสชัน
session_start();

// ตรวจสอบว่ามีค่า id ที่ส่งมาหรือไม่
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // ดึงค่า id จาก URL
    $id = $_GET['id'];
    
    $type = $_GET['type'];
    
    // ดึงข้อมูลบิลจากฐานข้อมูลโดยใช้ไอดีบิลที่ระบุ
    $query = "SELECT * FROM bill WHERE id_bill = $id";
    $result = mysqli_query($conn, $query);
    
    // ตรวจสอบว่ามีบิลที่ตรงกับไอดีที่ระบุหรือไม่
    if (mysqli_num_rows($result) > 0) {
        // ดึงข้อมูลบิล
        $bill_data = mysqli_fetch_assoc($result);
        
        // ดึงราคารวมจากตาราง order_detail
        $query = "SELECT SUM(qty * price) AS total_price FROM order_detail WHERE id_bill = $id";
        $total_result = mysqli_query($conn, $query);
        $total_data = mysqli_fetch_assoc($total_result);
        $total_price = $total_data['total_price'];
        
        // ปรับปรุงข้อมูลในตาราง bill
        $query = "UPDATE bill SET total_price = $total_price, status = 'Paid', type = '$type' WHERE id_bill = $id";
        mysqli_query($conn, $query);
        
        unset($_SESSION['cart']);
        // แสดงข้อความสำเร็จและ redirect ไปยังหน้าที่แสดงรายการบิล
        echo "<script>
        alert('Bill closed successfully!');
        window.location.href='admin.php';
        </script>";
        exit(); // จบการทำงานของสคริปต์ที่นี่
    } else {
        // หากไม่พบบิลที่ตรงกับไอดีที่ระบุ ให้แสดงข้อความและ redirect ไปยังหน้าที่แสดงรายการบิล
        echo "<script>
        alert('Bill not found!');
        window.location.href='admin_page.php';
        </script>";
        exit(); // จบการทำงานของสคริปต์ที่นี่
    }
} else {
    // หากไม่มีค่า id ที่ส่งมา ให้แสดงข้อความและ redirect ไปยังหน้าที่แสดงรายการบิล
    echo "<script>
    alert('Invalid request! Please select a bill.');
    window.location.href='#';
    </script>";
    exit(); // จบการทำงานของสคริปต์ที่นี่
}

?>