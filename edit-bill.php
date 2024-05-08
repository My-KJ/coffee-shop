<?php   
    require_once('connect.php');
    session_start();
    if(!isset($_GET['id'])){
        header("location: ./");
        exit();
    }
    $order_detail_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Prepare the SQL query to fetch the order detail and product name
    $sql = "SELECT order_detail.*, products.name AS product_name
            FROM order_detail
            JOIN products ON order_detail.id_product = products.id_product
            WHERE order_detail.id = '$order_detail_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
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
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order Page </title>
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
                    <h1 class="mb-5"> Edit Order </h1>
                    <h3>Edit order</h3>
                    
                    
                    <form class="row gy-4" action="update-order.php" method="POST">
                    <div class="form-group">
                        <div class="old-pro" style="margin-bottom: 5px;">
                            <label for="products">Same Product: <b><?php echo $row['product_name'] ?></b></label>
                        </div>
                        <label for="products">Product:</label>
                        <select class="form-select" id="products" name="products" required>
                            <?php
                            // Fetch all products from the database
                            $sql = "SELECT * FROM products";
                            $result = $conn->query($sql);

                            // Check if there are any products
                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value=" <?php echo $row["id_product"] ?> "><?php echo $row["name"] ?> </option>";
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                            <label for="price" class="form-label">Old Price</label>
                            <input type="number" class="form-control" id="price" name="price" min="0" max="999999" placeholder="price" value="<?php echo $row['price_h'] ?>"readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="price_h" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price_h" name="price_h" min="0" max="999999" placeholder="price">
                        </div>

                        <div class="col-md-3">
                            <label for="price_c" class="form-label">Cold Price</label>
                            <input type="number" class="form-control" id="price_c" name="price_c" min="0" max="999999" placeholder="price" value="<?php echo $row['price_c'] ?>"required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="type_1" class="form-label">Main Type</label>
                                <select class="form-select" id="type_1" name="type_1" required>
                                    <option value="<?php echo $row['type_1'] ?>"><?php echo $row['type_1'] ?></option>
                                    <option value="Beverage">Beverage</option>
                                    <option value="Baked">Baked</option>
                                    <option value="Dished">Dished</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="type_2" class="form-label">Second Type</label>
                                <select class="form-select" id="type_2" name="type_2" required> 
                                    <option value="<?php echo $row['type_2'] ?>"><?php echo $row['type_2'] ?></option>                                  
                                    <option value="Tea">Tea</option>
                                    <option value="Coffee">Coffee</option>
                                    <option value="Soda">Soda</option>
                                    <option value="Bread">Bread</option>
                                    <option value="Croffle">Croffle</option>
                                    <option value="Cake">Cake</option>
                                    <option value="Dished">Dished</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="<?php echo $row['status'] ?>"><?php echo $row['status'] ?></option>                                   
                                    <option value="Ready">Ready</option>
                                    <option value="Out of raw materials">Out of raw materials</option>
                                    <option value="Quit selling">Quit Saling</option>                                
                                </select>
                            </div>
                        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" >
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary d-block mx-auto">Accept</button>
                        </div>
                    </form>
                    <a href="crud.php">Previous</a>
                </div>  
            </div>
        </div>
        
    </div>
</div>
<?php 
    if (isset($_POST['submit'])) {
        // Your update logic here
    }
    ?>

<script>
    // Get the select element
    var productSelect = document.getElementById("products");
    // Get the price input element
    var priceInput = document.getElementById("price_h");

    // Add event listener for when the select value changes
    productSelect.addEventListener("change", function() {
        // Get the selected option value (product ID)
        var selectedProductId = this.value;
        // Fetch the price of the selected product using AJAX
        fetch("get_price.php?id=" + selectedProductId)
            .then(response => response.json())
            .then(data => {
                // Update the price input value with the fetched price
                priceInput.value = data.price;
            })
            .catch(error => console.error("Error fetching price:", error));
    });
</script>

</body>
</html>