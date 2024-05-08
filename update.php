<?php 
require_once('connect.php');
session_start();

if (!isset($_SESSION['username'])) {
    // หากยังไม่ได้ล็อกอิน ให้ redirect ไปยังหน้า index.php
    echo "<script>
    alert('Please! login');
    window.location.href='index.php';
    </script>";
    exit(); // จบการทำงานของสคริปต์ที่นี่
}

// ตรวจสอบว่ามีการล็อกอินแล้วหรือไม่ และผู้ใช้เป็น admin และไม่ได้ลาออก
if (!isset($_SESSION['username']) || $_SESSION['status'] === 'Resign') {
    // หากยังไม่ได้ล็อกอินหรือไม่ใช่ admin หรือเป็น " ให้แสดงแจ้งเตือนและ redirect ไปยังหน้า index.php
    echo "<script>
    alert('Sorry! : You have resigned / You have been fired.');
    window.location.href='index.php';
    </script>";
    exit(); // จบการทำงานของสคริปต์ที่นี่
}

if (isset($_POST['submit'])) {
    // ตรวจสอบว่ามีการอัปโหลดรูปภาพใหม่หรือไม่
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK && !empty($_FILES['image']['name'])) {
        // ตรวจสอบประเภทของไฟล์
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/JPG', 'image/PNG', 'image/JPEG'];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            $uploadPath = 'img/';
            $newFileName = uniqid() . '_' . $_FILES['image']['name'];
            $fullPath = $uploadPath . $newFileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $fullPath)) {
                // ถ้าอัปโหลดรูปภาพใหม่สำเร็จ ก็ทำการอัปเดตฐานข้อมูล
                $sql = "UPDATE products SET 
                    name = '".htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8')."',
                    price_h = '".$_POST['price_h']."', 
                    price_c = '".$_POST['price_c']."',                
                    price_f = '".$_POST['price_f']."', 
                    type_1 = '".htmlspecialchars($_POST['type_1'], ENT_QUOTES, 'UTF-8')."',
                    type_2 = '".htmlspecialchars($_POST['type_2'], ENT_QUOTES, 'UTF-8')."',
                    status = '".htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8')."',
                    image = '".$fullPath."',
                    update_at = '".date("Y-m-d H:i:s")."'
                    WHERE id_product = '".mysqli_real_escape_string($conn, $_POST['id'])."' ";

                if (mysqli_query($conn, $sql)) {
                    echo '<script> alert("Success!")</script>';
                    header('Refresh:0; crud.php');
                } else {
                    echo '<script> alert("Failed!")</script>';
                    echo "Error: " . mysqli_error($conn);
                    header('form-update.php');
                }
            } else {
                echo 'ไม่สามารถอัปโหลดไฟล์ได้';
            }
        } else {
            echo 'ประเภทของไฟล์ไม่ถูกต้อง';
        }
    } else {
        // ถ้าไม่มีการอัปโหลดรูปภาพใหม่ ก็อัปเดตข้อมูลปกติ
        $sql = "UPDATE products SET 
            name = '".htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8')."',
            price_h = '".$_POST['price_h']."', 
            price_c = '".$_POST['price_c']."',                
            price_f = '".$_POST['price_f']."', 
            type_1 = '".htmlspecialchars($_POST['type_1'], ENT_QUOTES, 'UTF-8')."',
            type_2 = '".htmlspecialchars($_POST['type_2'], ENT_QUOTES, 'UTF-8')."',
            status = '".htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8')."',
            update_at = '".date("Y-m-d H:i:s")."'
            WHERE id_product = '".mysqli_real_escape_string($conn, $_POST['id'])."' ";

        if (mysqli_query($conn, $sql)) {
            echo '<script> alert("Success!")</script>';
            header('Refresh:0; crud.php');
        } else {
            echo '<script> alert("Failed!")</script>';
            echo "Error: " . mysqli_error($conn);
            header('form-update.php');
        }
    }
}

mysqli_close($conn);
?>