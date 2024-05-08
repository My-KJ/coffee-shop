<?php 
 
  /** เชื่อมต่อฐานข้อมูล */
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "shop_coffee";
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  /** ตรวจสอบข้อผิดพลาดต่างๆ */
  if (mysqli_connect_error()) {
    echo "ไม่สามารถเชื่อมต่อฐานข้อมูล MySQL ได้: " . mysqli_connect_error();
    exit();
  }
  date_default_timezone_set('Asia/Bangkok');

  /** แปลงวันที่ให้เป็นภาษาไทย */
  function dateThai($strDate){
    $strYear= date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear $strHour:$strMinute น.";
  }

  try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>