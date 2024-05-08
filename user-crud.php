<?php  
    require_once('connect.php');
    $sql = "SELECT * FROM employee";
    $result = mysqli_query($conn, $sql);
    // เริ่มต้นเซสชัน
    session_start();
    
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
  <link rel="stylesheet" href="css/crud.css">
  <title>Employee - Manage</title>
    
</head>
<body>
    <div class="flex-container">
        <div class="container">
            <div class="shadow rounded p-5 bg-body h-100">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h1 class="pb-4"> Users Management Systems </h1>
                        <a href="manager.php" class="btn btn-secondary">Previous</a>
                        <a href="user-form-created.php" class="btn btn-primary"  >Add Users</a>
                        <br>
                        <span class="float-end" >There are a total of <?php echo mysqli_num_rows($result) ?> user data </span>                        
                    </div>
                    <br>
                    <div class="col-lg-10">
                        <div class="table-responsive" >
                            <?php if (mysqli_num_rows($result) > 0): ?>
                            <table id="table_id" class="table table-bordered">
                                <thead>
                                <tr class="text-center text-light bg-dark">
                                    <th>#</th>
                                    <th>user</th>
                                    <th>Fullname</th>                                   
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Management</th>                                   
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)):?>
                                    <tr class="text-center">
                                        <td> <?php echo $row['id_emp'] ?> </td>
                                        <td> <?php echo $row['username'] ?> </td>
                                        <td> <?php echo $row['name'] ?> </td>
                                        <td> <?php echo $row['type'] ?> </td>
                                        <td> <?php echo $row['status'] ?> </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-primary" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#my-modal<?php echo $row['id_emp'] ?>" 
                                                        style="width: 105px;"> Details </button>
                                                <a href="user-form-update.php?id=<?php echo $row['id_emp'] ?>" class="btn btn-warning"> Edit </a>
                                                <a href="user-delete.php?id=<?php echo $row['id_emp'] ?>" class="btn btn-danger"> Delete </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="my-modal<?php echo $row['id_emp'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">User Info</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    
                                                    <p>Name: <?php echo $row['name'] ?></p>
                                                    <p>username: <?php echo $row['username'] ?></p>
                                                    <p>Type: <?php echo $row['type'] ?></p>
                                                    <p>Status: <?php echo $row['status'] ?></p>  
                                                    <p>Tel: <?php echo $row['tel'] ?></p>                                  
                                                    <hr>
                                                    <p>Creation date: <?php echo dateThai($row['create_at']) ?></p>
                                                    <p>Update date: <?php echo dateThai($row['update_at']) ?></p>
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
        $('#table_id').DataTable();
    } );
    </script>
    
    <?php mysqli_close($conn) ?>
</body>
</html>