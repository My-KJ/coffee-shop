<?php 

    require_once('connect.php');
    session_start();
    $sql = "SELECT
    od.id,
    p.name AS product_name,
    od.qty,
    od.price,
    od.comment,
    od.status,
    b.total_price,
    b.id_bill
  FROM
    order_detail od
  JOIN
    products p ON od.id_product = p.id_product
  JOIN
    bill b ON od.id_bill = b.id_bill
  ORDER BY
    id DESC;";
    $result = $conn->query($sql);

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/order.css">
<title>Order Details</title>

</head>
<body>
<div class="container">
    
        <?php if (!isset($_SESSION['username']) || $_SESSION['status'] === 'Manager') : ?>
            <a class="btn" href="manager.php" role="button"> <i class="fa fa-home"></i> Home</a>
        <?php else: ?>
            <a class="btn" href="admin.php" role="button"> <i class="fa fa-home"></i> Home</a>
        <?php endif; ?>

    <h2>Order Details</h2>
    <table id="table_id" class="display">
        <thead>
            <tr>
                <th>Order No.</th>
                <th>Name Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) { 
                  if ($row['status'] === 'Processing') {
                    ?>
                                <tr>
                                    <td><?php echo $row["id_bill"]; ?></td>
                                    <td><?php echo $row["product_name"]; ?> | <?php echo $row["comment"]; ?></td>
                                    <td><?php echo $row["qty"]; ?></td>
                                    <td><?php echo $row["price"]; ?> Bath</td>
                                    <td><?php echo $row["total_price"]; ?> Bath</td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td>
                                      <div class="btn-group">
                                      <a href="edit-product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                                      <a href="success.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Success</a>
                                      </div>
                                  </td>
                                </tr>
                    <?php
                            }
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
        $('#table_id').DataTable({
        "order": [[ 0, "desc" ]]
        });
    } );
    </script>
</script>
</body>
</html>
