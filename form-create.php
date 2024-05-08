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
if (!isset($_SESSION['username']) || $_SESSION['status'] === 'Resign') {
    // หากยังไม่ได้ล็อกอินหรือไม่ใช่ admin หรือเป็น " ให้แสดงแจ้งเตือนและ redirect ไปยังหน้า index.php
    echo "<script>
    alert('Sorry! : You have resigned / You have been fired.');
    window.location.href='index.php';
    </script>";
    exit(); // จบการทำงานของสคริปต์ที่นี่
}
$id_emp = $_SESSION['username'];
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product Page </title>
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
                    <h1 class="mb-5"> Add Product Systems </h1>
                    <h3>Add Product</h3>
                    <form class="row gy-4" action="create.php" method="POST" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" required>
                        </div>
                        <div class="col-md-12">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" accept="image/*" id="image" name="image" required>
                        </div> 
                                      
                        <div class="col-md-3">
                            <label for="price" class="form-label">Hot Price</label>
                            <input type="number" class="form-control" id="price" name="price_h" min="0" max="999999" placeholder="Price" required>
                        </div>
                        <div class="col-md-3">
                            <label for="price" class="form-label">Cold Price</label>
                            <input type="number" class="form-control" id="price" name="price_c" min="0" max="999999" placeholder="Price" required>
                        </div>
                        <div class="col-md-3">
                            <label for="price" class="form-label">Fleppe Price</label>
                            <input type="number" class="form-control" id="price" name="price_f" min="0" max="999999" placeholder="Price" required>
                        </div>
                        <p style="color: red;" >*If the product has the same price, put it in the Hot field.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="main_type" class="form-label">Main Type</label>
                                <select class="form-select" id="main_type" name="type_1" required>
                                    <option value="" selected disabled>Select Main Type</option>
                                    <option value="Beverage">Beverage</option>
                                    <option value="Baked">Baked</option>
                                    <option value="Dished">Dished</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="second_type" class="form-label">Second Type</label>
                                <select class="form-select" id="second_type" name="type_2" required>
                                    <option value="" selected disabled>Select Second Type</option>
                                    <option value="Tea">Tea</option>
                                    <option value="Coffee">Coffee</option>
                                    <option value="Soda">Soda</option>
                                    <option value="Croissant">Croissant</option>
                                    <option value="Croffle">Croffle</option>
                                    <option value="Cake">Cake</option>
                                    <option value="Dished">Dished</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>                                   
                                    <option value="Ready">Ready</option>
                                    <option value="Out of raw materials">Out of raw materials</option>
                                    <option value="Quit selling">Quit Saling</option>                                   
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary d-block mx-auto">Confirm</button>
                        </div>
                    </form>
                    <a href="crud.php">Back to Product Page</a>
                </div>  
            </div>
        </div>
        
    </div>
</div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>