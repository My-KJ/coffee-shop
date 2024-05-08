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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Upload Bill Slip</title>
    <link rel="stylesheet" href="css/u-slip.css">
</head>
<body>
    <div class="container">
    <a class="btn btn-secondary float-left" href="admin.php" role="button" >Previous</a>
        <h2>Upload Bill Slip</h2>
        <form action="slip-upload.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
                <label for="bill_number">Bill Number:</label>
                <select id="id_bill" name="id_bill" style="width: 200px" required>
                    <option value="">Select id Bill</option>
                    <?php
                    
                    // Fetch bill numbers from database
                    $sql = "SELECT id_bill FROM bill WHERE slip IS NULL AND type = 'M-Banking'";
                    $result = mysqli_query($conn, $sql);
                    
                    // Check if any bill numbers found
                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?php echo $row['id_bill']  ?> "> <?php echo $row['id_bill'] ?></option>"
                            <?php
                        }
                    } else {
                        echo "<option value=''>No bills found</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="bill_slip">Bill Slip:</label>
                <input type="file" id="bill_slip" name="image" required>
            </div>
            <button type="submit" name="submit">Upload</button>
        </form>
    </div>
</body>
</html>
