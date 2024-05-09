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
    
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Admin PAGE</title>

</head>
<body>
    <!-- Nav start -->
<nav class="navbar sticky-top">
    <div class="container">
        <div class="nav-con">
                <a class="navbar-brand" href="admin.php">
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
            </div>
            <ul class="menu">
                <li style="position: relative;">
                    <a href="order-details.php">
                        <i id="notificationIcon" class="fa fa-bell" style="font-size: 20px; color: #333;"></i>
                    </a>
                </li>
                <li><a href="type_2.php"><i>information</i></a></li>
                <li><a href="crud.php"><i>Product</i></a></li>
                <li><a href="about.php"><i>About</i></a></li>
                <li><a href="logout.php"><i>log-out</i></a></li>
            </ul>
        </div>
</nav>
   <!-- Navbar End -->

    <div class="flex-container" style="align-items: center;" >
        <div class="container">
            <div class="shadow rounded p-5 bg-body h-100">

            <h4><i>Welcome, <?php echo $_SESSION['username']; ?></i></h4>
            <form action="bill-add.php" method="post">
            <label for="table">Select Table: </label>
                    <select name="table" id="table">
                        <option value="">Choose Table</option>
                        <option value="1">L1</option>
                        <option value="2">L2</option>
                        <option value="3">L3</option>
                        <option value="4">C1</option>
                        <option value="5">C2</option>
                        <option value="6">C3</option>
                        <option value="7">R1</option>
                        <option value="8">R2</option>
                        <option value="9">R3</option>
                        <option value="10">Take Home</option>                       
                    </select>
                <button type="submit" name="submit" class="btn btn-success" style="width: 100px;">Add Bill</button>
            </form>

            <button class="btn btn-warning" onclick="window.location.href='slip-up.php'" >Upload slip</button>

              <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <br>
                        <h1> Product sales information </h1>
                        
                        <?php

                            $query = "SELECT bill.*, employee.name AS emp_name, 
                            products.name AS product_name, 
                            order_detail.qty, order_detail.price, 
                            (order_detail.qty * order_detail.price) AS total_price, 
                            t_able.name AS table_name, 
                            order_detail.status AS status_or, 
                            order_detail.comment
                            FROM bill
                            INNER JOIN employee ON bill.id_emp = employee.id_emp
                            INNER JOIN order_detail ON bill.id_bill = order_detail.id_bill
                            INNER JOIN products ON order_detail.id_product = products.id_product
                            INNER JOIN t_able ON bill.id_table = t_able.id_table
                            ORDER BY bill.id_bill DESC ";

            
                                
                            $result = mysqli_query($conn, $query);
                            $total_sales = 0;
                        ?>
                        
                        <span class="float-end" >Total product sales information  <?php echo mysqli_num_rows($result) ?>  times.</span>                        
                    </div>
                    <br>
                    <div class="col-lg-12">
                        <div class="table-responsive" >
                            <?php if (mysqli_num_rows($result) > 0): ?>
                            <table class="table table-bordered" id="table_id">
                                <thead>
                                <tr class="text-center text-light bg-dark">
                                    <th>#</th>
                                    <th>Employee</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    
                                                                      
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)):?>
                                    <tr class="text-center">
                                        <td> <?php echo $row['id_bill'] ?> </td>
                                        <td> <?php echo $row['emp_name'] ?> </td>
                                        <td> <?php echo $row['product_name'] ?> </td>
                                        <td> <?php echo $row['qty'] ?> </td>
                                        <td> <?php echo number_format($row['price'], 0) ?> Bath</td>
                                        <td> <?php echo number_format($row['total_price'], 0) ?> Bath</td>
                                        <td> <?php echo $row['status'] ?> </td>
                                        <td> <button class="btn btn-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#my-modal<?php echo $row['id_bill'] ?>" 
                                                style="width: 105px;"> Details </button> 
                                        </td>    
                                    </tr>
                                    <div class="modal fade" id="my-modal<?php echo $row['id_bill'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- modal -->
                            <div class="modal-body">
                                <p>#: <?php echo $row['id_bill'] ?></p>
                                    <p>Image:
                                    <br>
                                    <?php
                                    if (!empty( $row['slip'] )) {
                                        
                                        // แสดงรูปภาพ
                                        echo '<img src="' . $row['slip'] . '" alt="Slip" style="max-width: 40%;">';
                    
                                    } else {
                                        // ไม่มีรูปภาพ
                                    }
                                    ?>
                                    </p>
                                    <p>Employees who take care of orders: <?php echo $row['emp_name'] ?></p>
                                    <p>Product: <?php echo $row['product_name'] ?> : <?php echo $row['comment'] ?></p>
                                    <p>type: <?php echo $row['type'] ?></p>
                                    <p>Status: <?php echo $row['status'] ?></p>
                                    
                                        <hr>
                                        <p>Created Date: <?php echo dateThai($row['order_date']) ?></p>
                                        <p>Table: <?php echo $row['table_name'] ?></p>
                                        
                                        
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                                <?php endwhile; ?>
                                </tbody>
                            </table>    
                            <?php 
                                else: 
                                    echo "<p class='mt-5'>ไม่มีข้อมูลในฐานข้อมูล</p>"; 
                                    echo "Error: " . mysqli_error($conn);
                                endif; 
                            ?>
                        </div>
                        
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready( function () {
        $('#table_id').DataTable({
        "order": [[ 0, "desc" ]]
        });
    } );
    </script>
    <script>
        function toggleUserInfo() {
            var userInfoDiv = document.getElementById('userInfo');
            if (userInfoDiv.style.display === 'none') {
                userInfoDiv.style.display = 'block';
            } else {
                userInfoDiv.style.display = 'none';
            }
        }
    </script>


    <?php mysqli_close($conn) 
    
    ?>
</body>
</html>
