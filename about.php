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
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>About Me</title>
</head>
<body>
    <!-- Navbar Start -->
    <nav> 
        <div class="container">
            <div class="nav-con">
                <div>
                    <a href="#">
                    <img src="pic_me/icon_coffe.png" alt="Logo" class="Logo" width="55px" height="auto">
                    </a>
                </div>
                <ul class="menu">
                    <li>
                        <?php if (!isset($_SESSION['username']) || $_SESSION['status'] === 'Manager') : ?>
                        <a class="home" href="manager.php" role="button">HOME</a>
                        <?php else: ?>
                            <a class="home" href="admin.php" role="button">HOME</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
    <main>           
        <div class="container">
            
    <!-- Banner Start -->
    <div class="box-banner">
        <section class="banner">
            <div class="banner-info">
                <img src="pic_me/rajamangala_logo.png" alt="university Logo">
                
                <div class="txt-ban">
                    <h1><i>Rajamangala Tawan-ok Bangphra University. </i></h1>
                </div>

            </div>
        </section>
    </div>
    <!-- Banner end -->
        <br>
    <!-- Card Start -->
    <div class="profile-card">
            <div class="profile-image">
                <img src="pic_me/nattawat.jpeg" alt="Profile Image">
            </div>
            <div class="profile-info">
                <h2>Mr.Nattawat Imthong</h2>
                <p>Student of University</p>
                <p>Student ID: 016540641013-5</p>
                <i class="fa fa-phone"> : 098-093-9604</i>
                
            </div>           
    </div>
            <br>
    <div class="profile-card">
            <div class="profile-image">
                <img src="pic_me\nopporn.jpg" alt="Profile Image">
            </div>
            <div class="profile-info">
                <h2>Mr.Nopporn Pornpitak</h2>
                <p>Student of University</p>
                <p>Student ID: 016540641027-5</p>
                <i class="fa fa-phone"> : 063-168-7912</i>            
            </div>           
    </div>    

    <!-- Card End -->
        </div>
    </main>


    
</body>
</html>