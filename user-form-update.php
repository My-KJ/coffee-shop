<?php 
 require_once('connect.php');
 session_start();
 if(!isset($_GET['id'])){
     header("location: ./");
     exit();
 }
 $sql = "SELECT * FROM employee WHERE id_emp = '".mysqli_real_escape_string($conn, $_GET['id'])."' ";
 $result = mysqli_query($conn, $sql);
 $row = mysqli_fetch_assoc($result);
    
    if (!isset($_SESSION['username'])) {
        // หากยังไม่ได้ล็อกอิน ให้ redirect ไปยังหน้า index.php
        echo "<script>
        alert('Please! login');
        window.location.href='index.php';
        </script>";
        exit(); // จบการทำงานของสคริปต์ที่นี่
    }
    
    // ตรวจสอบว่ามีการล็อกอินแล้วหรือไม่ และผู้ใช้เป็น admin และไม่ได้ลาออก
    if (!isset($_SESSION['username']) || $_SESSION['type'] !== 'Manager' || $_SESSION['status'] === 'Resign') {
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
    <title>Edit Users Page </title>
    <!-- favicons -->
    <link rel="shortcut icon" type="image/x-icon" href="icon.ico">
    <!-- Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .flex-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #F5F8FF;
        }
    </style>
</head>
<body>
<div class="flex-container">
    <div class="container">
        <div class="shadow rounded p-5 bg-body h-100">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h1 class="mb-5"> Edit Users Systems </h1>
                    <h3>Edit User</h3>
                    <form class="row gy-4" action="user-update.php" method="POST">
                        <div class="col-md-12">
                            <label for="full" class="form-label">Name</label>
                            <input type="text" class="form-control" id="full" name="name" placeholder="Name of Products" value="<?php echo $row['name'] ?>"required>
                        </div>
                        <div class="col-md-12">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Name of Products" value="<?php echo $row['username'] ?>"required>
                        </div>
                        <div class="col-md-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
                        </div>
                        <div class="col-md-12">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="confirm_password" value="">
                        </div>
                        <div>
                            <input type="checkbox" onclick="myFunction()"> Show password</input>
                        </div>
                        <div class="col-md-4">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="<?php echo $row['type'] ?>"><?php echo $row['type'] ?></option>
                                <option value="admin">admin</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="tel" class="form-label">Tel.</label>
                            <input type="text" class="form-control" id="tel" name="tel" placeholder="Tel" value="<?php echo $row['tel'] ?>"required>
                        </div>
                        <div class="col-md-4">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="<?php echo $row['status'] ?>"><?php echo $row['status'] ?></option>
                                <option value="Working">Working</option>
                                <option value="Resign">Resign</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" >
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary d-block mx-auto">Accept</button>
                        </div>
                    </form>
                    <a href="user-crud.php">Previous</a>
                </div>  
            </div>
        </div>
        
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function myFunction() {
    var passwordField = document.getElementById("password");
    var confirmPasswordField = document.getElementById("confirm_password");

    if (passwordField.type === "password" && confirmPasswordField.type === "password") {
        passwordField.type = "text";
        confirmPasswordField.type = "text";
    } else {
        passwordField.type = "password";
        confirmPasswordField.type = "password";
    }
    }
</script>
</body>
</html>