<?php
session_start();
include('include/asset/header.php');

if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
    echo '<script>alert("' . $_SESSION['error'] . '");</script>';
    unset($_SESSION['error']); 
}
?>


<body>
    <div class="main">
        <div class="div-left"><img src="include/image/background3.jpg" /></div>
        <div class="d-flex flex-column justify-content-center align-items-center div-right">
            <div class="div-heading">
                <h1>ลงชื่อเข้าใช้งาน</h1>
                <h1>กรรมการการแข่งขัน</h1>
            </div>
            <form class="form-login card text-start pt-4 pb-2" action="include/backend/login.php" method="post">
                <div class="div-username">
                    <label class="form-label" for="username">ชื่อผู้ใช้</label>
                    <input id="username" class="form-control" type="text" name="username" autocomplete="off" required />
                </div>
                <div class="div-password">
                    <label class="form-label" for="password">รหัสผ่าน</label>
                    <input id="password" class="form-control" type="password" name="password" required />
                </div>
                <div id="div-button" class="text-center">
                    <button class="btn btn-primary btn-lg" type="submit" name="submit_login">ลงชื่อเข้าใช้งาน</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>