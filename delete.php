<?php 
require_once('connect.php');

if (isset($_GET['id'])) {
    $id_product = $_GET['id'];

    // กำหนดค่าการลบแบบ cascade สำหรับ foreign key constraint
    $conn->query("SET FOREIGN_KEY_CHECKS=0");

    // ลบข้อมูลสินค้าจากฐานข้อมูล
    $sql = "DELETE FROM products WHERE id_product = $id_product";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Record deleted successfully');
        window.location.href='crud.php';
        </script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // เปลี่ยนค่าการลบแบบ cascade กลับเป็นค่าเริ่มต้น
    $conn->query("SET FOREIGN_KEY_CHECKS=1");
} else {
    // หากไม่มีค่า id ที่ส่งมา ให้แสดงข้อความแจ้งเตือนและ redirect ไปยังหน้าแสดงรายการสินค้า
    echo "<script>
    alert('No product ID provided');
    window.location.href='crud.php';
    </script>";
}

$conn->close();
?>
