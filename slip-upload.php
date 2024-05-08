<?php
require_once('connect.php');
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

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Get the bill number and image file name
    $bill_number = $_POST['id_bill'];
    $image = $_FILES['image']['name'];
    
    // Specify the directory where you want to save the uploaded image
    $target_dir = "slip/";
    
    // Specify the full path of the uploaded image
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert the image file name and bill number into the database
            $sql = "UPDATE bill SET slip = '" . $target_dir . basename($_FILES["image"]["name"]) . "' WHERE id_bill = '" . $bill_number . "';";

            if (mysqli_query($conn, $sql)) {
                echo "<script>
            alert('File uploaded successfully.');
            window.location.href='slip-up.php'; // Redirect to slip-up.php after displaying the alert
            </script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
    }
}
?>