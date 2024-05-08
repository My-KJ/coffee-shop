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
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <title>Sales Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/dash.css">
</head>
<body>
    <div class="container">
      <?php if (!isset($_SESSION['username']) || $_SESSION['status'] === 'Manager') : ?>
      <a class="btn btn-secondary float-left" href="manager.php" role="button">Previous</a>
  <?php else: ?>
      <a class="btn btn-secondary float-left" href="admin.php" role="button">Previous</a>
  <?php endif; ?>
    <br>

    <?php
        $sql =  "SELECT type_2, total_orders FROM ( SELECT p.type_2, COUNT(od.id) AS total_orders 
        FROM products p JOIN order_detail od ON p.id_product = od.id_product 
        WHERE od.status = 'Yes' 
        GROUP BY p.type_2 ORDER BY total_orders DESC ) AS type2_orders;";
        
        
        $result = mysqli_query($conn, $sql);
        $xValues = array();
        $yValues = array();
        $barColors = array();
        while($row = mysqli_fetch_assoc($result)) {
          $xValues[] = $row["type_2"];
          $yValues[] = $row["total_orders"];
          $barColors[] = "#" . substr(md5($row["type_2"]), 0, 6);
        }
        ?>

        <canvas id="top5" style="width:100%;max-width:800px"></canvas>
        


        
                        <?php
                            // ตรวจสอบว่ามีข้อมูลในตารางหรือไม่
                            if (mysqli_num_rows($result) > 0) {
                                // วนลูปเพื่อแสดงข้อมูลในตาราง
                                while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    
                                    <?php
                                }
                            } else {
                                echo "0 results";
                            }

                            // ปิดการเชื่อมต่อฐานข้อมูล
                            mysqli_close($conn);
                        ?>
                         <br>
                        <div style="text-align: right;">      
                            <a href="sale-detail.php">
                                <button class="btn btn-success">   Next </button>
                            </a>
                        </div>
        </div>
        
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
// สร้างกราฟแสดงข้อมูล
new Chart("top5", {
  type: "pie",
  data: {
    labels: <?php echo json_encode($xValues); ?>,
    datasets: [{
      backgroundColor: <?php echo json_encode($barColors); ?>,
      data: <?php echo json_encode($yValues); ?>
    }]
  },
  options: {
    title: {
      display: true,
      text: "Total purchases Product type"
    }
  }
});
</script>

</body>
</html>
