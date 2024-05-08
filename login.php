<?php
// ตรวจสอบการส่งข้อมูลแบบ POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // กำหนดข้อมูลเชื่อมต่อกับฐานข้อมูล
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop_coffee";

    // สร้างการเชื่อมต่อ
    $conn = new mysqli($servername, $username, $password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // รับค่าจากฟอร์ม
    $username = $_POST["username"];
    $password = $_POST["password"];

    // ทำคำสั่ง SQL เพื่อตรวจสอบข้อมูลในฐานข้อมูล
    $sql = "SELECT * FROM employee WHERE username=? AND password=? ";
    
    // ประการพร้อม
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // ตรวจสอบว่ามีข้อมูลที่ตรงกับเงื่อนไขหรือไม่
if ($result->num_rows > 0) {
    // เริ่มต้นเซสชัน
    session_start();
    // เก็บข้อมูลผู้ใช้ในเซสชัน
    $row = $result->fetch_assoc();
    $_SESSION['username'] = $row['username']; // สมมติว่า ID ของผู้ใช้เป็น username
    $_SESSION['type'] = $row['type']; // สมมติว่าประเภทของผู้ใช้เป็น admin
    $_SESSION['status'] = $row['status'];    // สมมติว่า status = working
    // ล็อกอินสำเร็จ
    // เปลี่ยนเส้นทางไปยังหน้า admin.php หรือ manager.php ตามประเภทของผู้ใช้
    if ($_SESSION['type'] == 'Manager') {
        echo "<script>
        alert('Welcome manager!');
        window.location.href = 'manager.php';
        </script>";
    } else if ($_SESSION['type'] == 'admin') {
        echo "<script>
        alert('Welcome admin!');
        window.location.href = 'admin.php';
        </script>";
    }
    exit(); // จบการทำงานของสคริปต์ที่นี่
} else {
    // ล็อกอินไม่สำเร็จ
    echo "<script>
    alert('Failed. Please Check username / password');
    window.location.href = 'index.php';
    </script>";
}
    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $stmt->close();
    $conn->close();
}
?>
