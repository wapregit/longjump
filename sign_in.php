<?php
session_start();
include('include/asset/header.php');
if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
    echo '<script>alert("' . $_SESSION['error'] . '");</script>';
    unset($_SESSION['error']); // เมื่อแสดงแล้วให้ลบค่า session นี้ทิ้ง
}
?>


<body>
    <div style="display: flex;width: 100%;height: 100%;position: relative;background: linear-gradient(#aeabf2, white);">
        <div class="div-left"
            style="width: 50%;clip-path: polygon(0 0, 100% 0, 93% 100%, 0% 100%);position: absolute;height: 100%;">
            <img src="include/image/background3.jpg" style="width: 100%;height: 100%;" width="1595" height="1077" />
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center div-right"
            style="text-align: center;width: 45%;height: 100%;position: absolute;">
            <div style="margin-bottom: 20px;">
                <h1 style="color: #636363;">ลงชื่อเข้าใช้งาน</h1>
                <h1 style="color: #636363;">กรรมการการแข่งขัน</h1>
            </div>
            <form action="include/backend/login.php" method="post" class="card text-start pt-4 pb-4"
                style="border-radius: 20px;width: 60%;padding: 50px;background: rgb(98,159,202);">
                <div style="margin-bottom: 2rem;">
                    <label class="form-label" for="username" style="font-size: 30px;color: #fff;">ชื่อผู้ใช้</label>
                    <input id="username" class="form-control form-control-lg" type="text" name="username"
                        autocomplete="off" style="border-radius: 10px;height: 4rem;" required />
                </div>
                <div class="text-start" style="margin-bottom: 2rem;">
                    <label class="form-label" for="password" style="font-size: 30px;color: #fff;">รหัสผ่าน</label>
                    <input id="password" class="form-control form-control-lg" type="password" name="password"
                        style="border-radius: 10px;height: 4rem;" required />
                </div>
                <div class="text-center">
                    <button class="btn btn-primary btn-lg" type="submit" name="submit_login"
                        style="width: 30%;border-radius: 20px;">ลงชื่อเข้าใช้งาน</button>
                </div>
            </form>
        </div>
    </div>
</body>

</body>

</html>