<?php

require_once('connect.php');

$targetDir = "img/";
if (isset($_POST['submit'])) {
    $name = basename($_FILES["image"]["name"]); 
    $targetFilePath = $targetDir . $name;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $allowTypes = array("JPG", "jpg","PNG", "png","JPEG", "jpeg","GIF", "gif","PDF", "pdf");

    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // File upload successful, continue with database insertion
            $sql = "INSERT INTO `products` (`name`, `image`, `price_h`, `price_c`, `price_f`, `type_1`, `type_2`, `status`, `create_at`, `update_at`) 
                VALUES (
                        '" . htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') . "', 
                        '" . $targetFilePath . "', 
                        '" . $_POST['price_h'] . "',
                        '" . $_POST['price_c'] . "',
                        '" . $_POST['price_f'] . "',
                        '" . $_POST['type_1'] . "', 
                        '" . $_POST['type_2'] . "', 
                        '" . $_POST['status'] . "',
                        '" . date("Y-m-d H:i:s") . "', 
                        '" . date("Y-m-d H:i:s") . "')";

            if (mysqli_query($conn, $sql)) {
                echo '<script> 
                alert("เพิ่มข้อมูลเสร็จเรียบร้อย");
                window.location.href = "crud.php"
                </script>';
            } else {
                echo '<script> 
                    alert("เพิ่มข้อมูลไม่สำเร็จ");
                    window.location.href = "form-create.php"
                    </script>';
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
    }
}

mysqli_close($conn);

?>
