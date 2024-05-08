<?php
// login_page.php

// ตรวจสอบว่ามีข้อความแจ้งข้อผิดพลาดหรือไม่
if (isset($_GET["error"])) {
    $error = $_GET["error"];
    echo "Login failed. ";
    
    if ($error == "InvalidCredentials") {
        echo "Invalid username or password.";
    } elseif ($error == "EmptyFields") {
        echo "Please enter both username and password.";
    } else {
        // เพิ่มเงื่อนไขข้อผิดพลาดอื่น ๆ ตามต้องการ
    }
}
?>



<!DOCTYPE html>
<html lang="en"> 
 <head> 
    <meta charset="UTF-8"> 
    <title>Login Page</title> 
    <link rel="stylesheet" href="css/login.css"> 
 </head> 

 <body> 
  <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> 
  <div class="signin"> 
        <div class="content"> 
            <h2>Sign In</h2> 
            <p>This is Systems of Cafe'</p>
            <div class="form"> 
                <form action="login.php" method="post">
                    <div class="inputBox"> 
                        <input type="text" name="username" required> <i>Username</i> 
                    </div> 
                    <br>
                    <div class="inputBox"> 
                        <input type="password" name="password" method required class="password-toggle"> <i>Password</i> 
                        <br>
                    </div>   
                    <br>
                    <div>
                        <input type="checkbox" onclick="myFunction()"> Show password</input>
                    </div>               
                    <br>
                    <div class="inputBox"> 
                        <input type="submit" value="Login"> 
                    </div>
                </form>
            </div> 
        </div> 
    </div> 
</section> 

<script>
    function myFunction() {
    var x = document.querySelector(".password-toggle");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    }
</script>

</body>
</html>