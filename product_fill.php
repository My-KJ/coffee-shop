<?php    
    session_start();
    include 'connect.php';
    
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

    if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0);
    
     // Check if id_bill is set via GET and set it in session if available
     if(isset($_GET['id_bill'])) {
        // บันทึก ID ลงใน Session
        $_SESSION['id_bill'] = $_GET['id_bill'];
        
    }  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Product//</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/product.css">
</head>
<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
        <a class="navbar-brand" href="<?php echo $productPageURL; ?>">
        <?php
            $sql = "SELECT * FROM data_common";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $image_url = $row["pic1"];
            ?>
            <img src="<?= $image_url ?>" alt="Product Image" style="width: 40px; height: auto; border-radius: 10px;">
            <?php
            } else {
                echo "No image found.";
            }
            ?>
        </a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="cart.php?id_bill=<?php echo $_SESSION['id_bill']; ?>">
                    <span class="fa fa-shopping-cart" style="font-size: 26px;" ></span>
                </a>
            </li>
        </ul>
        </div>
    </nav>
    <!-- Navbar End -->

    <main>
    <div class="container">
        <div class="row">
            <div class="col-12">         
                <div class="text-left">
                    <button class="btn btn-secondary" type="submit" onclick="window.location.href='product.php?id_bill=<?php echo $_SESSION['id_bill']; ?>'">Refresh</button>           
                </div>    
                        <?php
                        // เช็คว่ากดปุ่มอะไรจากหน้า product.php
                        $type_1 = $_GET['type_1'];

                        // แสดงปุ่มตาม type_1
                        if ($type_1 === 'Beverage') {
                        ?>
                               
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                    <form action="product_fill_2.php" method="get">
                                    <input type="hidden" name="id_bill" value="<?php echo $_SESSION['id_bill']; ?>">
                                            <div class="btn-group"> 
                                                <button class="btn btn-primary" type="submit" name="type_2" value="Coffee">Coffee</button>
                                                <button class="btn btn-primary" type="submit" name="type_2" value="Tea">Tea</button>
                                                <button class="btn btn-primary" type="submit" name="type_2" value="Soda">Soda</button>          
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>                      
                        <?php
                            } elseif ($type_1 === 'Baked') {
                        ?>
                        <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                    <form action="product_fill_2.php" method="get">
                                    <input type="hidden" name="id_bill" value="<?php echo $_SESSION['id_bill']; ?>">
                                        <div class="btn-group">
                                            <button class="btn btn-primary" type="submit" name="type_2" value="Croissant">Croissant</button>
                                            <button class="btn btn-primary" type="submit" name="type_2" value="Croffle">Croffle</button>
                                            <button class="btn btn-primary" type="submit" name="type_2" value="Cake">Cake</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>  
                        <?php
                        }
                        ?>                              
            </div>
        </div>
    </div>
    
        <div class="container mt-5">
        <h1> <?php echo $type_1 ?> </h1>
            <div class="row">
            <?php
// ตรวจสอบว่ามีการส่งค่า type_1 มาจาก form หรือไม่
if (isset($_GET['type_1'])) {
  // ถ้ามีให้เก็บค่า type_1 ไว้ในตัวแปร $type_1
  $type_1 = $_GET['type_1'];

  // ตรวจสอบว่าค่าที่ส่งมาเป็น "Beverage", "Dished", หรือ "Baked" หรือไม่
  if ($type_1 === 'Beverage') {
    
    // ดึงข้อมูลสินค้าประเภท Beverage
    $sql = "SELECT * FROM products WHERE type_1 = '$type_1' && status != 'Quit selling'";
    $result = mysqli_query($conn, $sql);
  } else if ($type_1 === 'Dished') {
    // ดึงข้อมูลสินค้าประเภท Dished
    $sql = "SELECT * FROM products WHERE type_1 = '$type_1' && status != 'Quit selling'";
    $result = mysqli_query($conn, $sql);
  } else if ($type_1 === 'Baked') {
    // ดึงข้อมูลสินค้าประเภท Baked
    $sql = "SELECT * FROM products WHERE type_1 = '$type_1' && status != 'Quit selling'";
    $result = mysqli_query($conn, $sql);
  } else {
    // แสดงข้อความแจ้งเตือน
    echo 'Please select "Beverage", "Dished", or "Baked" from the dropdown.';
  }
} else {
  // แสดงข้อความแจ้งเตือน
  echo 'Please select a type from the dropdown.';
}

// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($result->num_rows > 0) {
  // Loop แสดงข้อมูลสินค้า
  while ($row = mysqli_fetch_assoc($result)) {

    if ($type_1 === 'Baked' || $type_1 === 'Dished') {
      // แสดงราคาแบบไม่ต้องมี selector และไม่ต้องมีคอมเม้น
      ?>
                  <div class="col-lg-3 col-md-6 mb-4">
                    <form action="cart-add.php?id_bill=<?php echo $_SESSION['id_bill']; ?>" method="post">
                    <div class="card">
                        <input type="hidden" name="id" value="<?php echo $row['id_product']; ?>">
                        <input type="hidden" name="price" value="<?= $row["price_h"] ?>">
                        <input type="hidden" name="comment" value="">
                        <img src="<?= $row["image"] ?>" class="card-img-top<?= ($row['status'] === 'Quit selling') ? ' grayscale' : '' ?>" alt="Product Image" style="height: 270px;">
                        <div class="card-body">
                        <h6 style="font-size: 15px;" class="card-title"><?= $row["name"] ?></h6>
                        <p class="card-text">Price: <?= $row["price_h"] ?> Bath</p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text">Quantity</span>
                            </div>
                            <input type="number" name="quantity" class="form-control" value="1" min="1" max="99">
                        </div>
                            <?php if ($row['status'] === 'Out of raw materials'): ?>
                                <button class="btn btn-danger mt-3" type="button" disabled>Out of Stock</button>
                            <?php else: ?>
                                <button class="btn btn-primary mt-3" type="submit">Add to Cart</button>
                            <?php endif; ?>
                    </div>
                    </div>
                    </form>
                </div>

      <?php
    } else {
      // แสดงแบบเดิม (มี selector และคอมเม้น)
      ?>
                  <div class="col-lg-3 col-md-6 mb-4">
                <form action="cart-add.php?id_bill=<?php echo $_SESSION['id_bill']; ?>" method="post">
                    <div class="card">
                        <input type="hidden" name="id" value="<?php echo $row['id_product']; ?>">
                        <img src="<?= $row["image"] ?>" class="card-img-top<?= ($row['status'] === 'Quit selling') ? ' grayscale' : '' ?>" alt="Product Image" style="height: 270px;">
                        <div class="card-body">
                            <h6 style="font-size: 15px;" class="card-title"><?= $row["name"] ?></h6>
                            <select class="custom-select mb-3" name="price" required>
                                <?php if ($row["price_h"] != 0): ?>
                                    <option data-type="price_h" value="<?= $row["price_h"] ?>">Hot : <?= $row["price_h"] ?> Bath</option>
                                <?php endif; ?>
                                <?php if ($row["price_c"] != 0): ?>
                                    <option data-type="price_c" value="<?= $row["price_c"] ?>">Cold : <?= $row["price_c"] ?> Bath</option>
                                <?php endif; ?>
                                <?php if ($row["price_f"] != 0): ?>
                                    <option data-type="price_f" value="<?= $row["price_f"] ?>">Fleppe : <?= $row["price_f"] ?> Bath</option>
                                <?php endif; ?>
                            </select>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Quantity</span>
                                </div>
                                <input type="number" class="form-control" name="quantity" value="1" min="1" max="99">
                            </div>
                            <label for="Comment">Option</label>
                            <select class="custom-select mb-3" name="comment">
                                <option value="">Normal sweet 50%</option>
                                        <optgroup label="Sweet">
                                            <option value="No Sweet">No Sweet</option>
                                            <option value="Low sweet 25%">Low sweet 25%</option>
                                            <option value="add sweet 25%">add sweet 25%</option>
                                            <option value="add sweet 50%">add sweet 50%</option>
                                        <?php if ($row['type_2'] == 'Coffee'): ?>
                                            <optgroup label="Shot">
                                                <option value="Single Shot +20 Bath">Single Shot +20 Bath</option>
                                                <option value="Double Shot +40 Bath">Double Shot +40 Bath</option>
                                                <option value="Triple Shot +60 Bath">Triple Shot +60 Bath</option>
                                            </optgroup>
                                        <?php endif; ?>
                            </select>
                            <br>
                            <?php if ($row['status'] === 'Out of raw materials'): ?>
                                <button class="btn btn-danger mt-3" type="button" disabled>Out of Stock</button>
                            <?php else: ?>
                                <button class="btn btn-primary mt-3" type="submit">Add to Cart</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
      <?php
    }
  }
}
?>          
            </div>       
        </div>
    </main>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>