<?php
// เริ่ม session (หากยังไม่ได้เริ่ม)
session_start();

// ทำลาย session
session_destroy();

// ส่งผู้ใช้กลับไปยังหน้าหลักหรือหน้าเข้าสู่ระบบ

echo "<script>
alert('Logout Success!');
window.location.href = 'index.php';
</script>";
exit();
?>