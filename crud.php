<?php 
    require_once('connect.php');
    session_start();
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    $conn->close();
   
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
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <title>Product</title>
</head>

<body>
 

<div class="container mt-5">


<?php if (!isset($_SESSION['username']) || $_SESSION['status'] === 'Manager') : ?>
    <a class="btn btn-secondary float-left" href="manager.php" role="button">Previous</a>
<?php else: ?>
    <a class="btn btn-secondary float-left" href="admin.php" role="button">Previous</a>
<?php endif; ?>
<a class="btn btn-primary float-right" href="form-create.php" role="button" >Add Product</a>
<br>
<br>
<H3>All Product</H3> 


    <table id="table_id" class="display">
        <thead>
            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">Name</th>
                <th style="text-align: center;">Image</th>
                <th colspan="3">Price / Bath</th>
                <th style="text-align: center;">Type Main</th>
                <th style="text-align: center;">Type Second</th>
                <th style="text-align: center;"> Status</th>
                <th style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["id_product"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td> 
                        <?php 
                            // แสดงรูปภาพ
                            echo '<img src="' . $row['image'] . '" alt="Product Image" style="max-width: 100%; height: 50px;">';
                        ?> 
                    </td>
                    <td style="text-align: center;"> <?php echo $row["price_h"]; ?> </td>
                    <td style="text-align: center;"> <?php echo $row["price_c"]; ?> </td>
                    <td style="text-align: center;"> <?php echo $row["price_f"]; ?> </td>
                    <td style="text-align: center;"> <?php echo $row['type_1'] ?> </td>
                    <td style="text-align: center;"> <?php echo $row['type_2'] ?> </td>
                    <td style="text-align: center; color: <?php 
                        if ($row['status'] === 'Ready') {
                            echo 'green'; // ถ้าสถานะเป็น "Ready" ให้ใช้สีเขียว
                        } elseif ($row['status'] === 'Out of raw materials') {
                            echo 'red'; // ถ้าสถานะเป็น "Sold out" ให้ใช้สีแดง
                        } elseif ($row['status'] === 'Quit selling') {
                            echo 'orange'; // ถ้าสถานะเป็น "Quit selling" ให้ใช้สีเทา
                        } else {
                            echo 'black'; // สีดำสำหรับสถานะที่ไม่ระบุ
                        }
                    ?>;"><i><?php echo $row['status']; ?></i></td>
                    <td style="text-align: center;">
                        <div class="btn-group">
                            <button class="btn btn-primary" 
                                data-bs-toggle="modal" 
                                data-bs-target="#my-modal<?php echo $row['id_product'] ?>" 
                                style="width: 105px;"> Details </button>
                                <a href="form-update.php?id=<?php echo $row['id_product'] ?>" class="btn btn-warning"> Edit </a>
                        </div>
                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="my-modal<?php echo $row['id_product'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Product Name: <?php echo $row['name'] ?></p>
                                    <p>Image:
                                    <br>
                                        <?php 
                                        // แสดงรูปภาพ
                                        echo '<img src="' . $row['image'] . '" alt="Product Image" style="max-width: 40%;">';
                                        ?>
                                    </p>
                                    <?php if($row['price_h'] != 0): ?>
                                        <p>Hot Price: <?php echo number_format($row['price_h'], 0) ?> Baht</p>
                                    <?php endif; ?>
                                    <?php if($row['price_c'] != 0): ?>
                                        <p>Cold Price: <?php echo number_format($row['price_c'], 0) ?> Baht</p>
                                    <?php endif; ?>
                                    <?php if($row['price_f'] != 0): ?>
                                        <p>Fleppe Price: <?php echo number_format($row['price_f'], 0) ?> Baht</p>
                                    <?php endif; ?>
                                        <p>Main Type: <?php echo $row['type_1'] ?></p>
                                        <p>Second Type: <?php echo $row['type_2'] ?></p>
                                        <hr>
                                        <p>Created Date: <?php echo dateThai($row['create_at']) ?></p>
                                        <p>Updated Date: <?php echo dateThai($row['update_at']) ?></p>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>                                    
                <?php
                        }
                    } else {
                        echo "0 results";
                    }
                ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready( function () {
    $('#table_id').DataTable();
  } );
</script>
</body>
</html>
