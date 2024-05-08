<?php
session_start();
require_once('connect.php');

// คำสั่ง SQL สำหรับลบข้อมูลที่มี price เป็นค่าว่างในตาราง order_detail
$sql = "DELETE FROM order_detail WHERE price IS NULL";

if ($conn->query($sql) === TRUE) {
    echo "Records deleted successfully";
} else {
    echo "Error deleting records: " . $conn->error;
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
