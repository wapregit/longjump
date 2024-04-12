<?php
session_start();
include('asset/header.php');

if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
    unset($_SESSION['error']);
}
?>

<body>
    <?php include('backend/loading.php'); ?>
    <main class="main h-100 w-100 d-flex position-relative" style="background: linear-gradient(#aeabf2, white);">
        <div class="w-50 h-100 position-absolute start-0 z-1" style="clip-path: polygon(0 0, 100% 0, 93% 100%, 0% 100%);">
            <img src="image/background2.jpg" class="w-100 h-100" />
        </div>

        <div class="d-flex flex-column justify-content-center align-items-center w-50 h-100 position-absolute end-0 text-center">

            <div class="div-heading mb-2">
                <h1>ลงชื่อเข้าใช้งาน</h1>
                <h1>กรรมการการแข่งขัน</h1>
            </div>

            <form class="card text-start w-50 rounded-4 px-4 py-4" style="background: rgb(98, 159, 202);" action="backend/login.php" method="post">
                <div class="div-username mb-3">
                    <label class="form-label" for="username">ชื่อผู้ใช้</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="icon-username" style="border-top-right-radius: 0; border-bottom-right-radius: 0;"><i class="bi bi-person-fill"></i></span>
                        </div>
                        <input id="username" class="form-control" type="text" name="username" placeholder="Username" autocomplete="off" aria-describedby="icon-user" aria-label="username" required />
                    </div>
                </div>
                <div class="div-password mb-3">
                    <label class="form-label" for="password">รหัสผ่าน</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="icon-password" style="border-top-right-radius: 0; border-bottom-right-radius: 0;"><i class="bi bi-key-fill"></i></span>
                        </div>
                        <input id="password" class="form-control" type="password" name="password" placeholder="Password" aria-describedby="icon-password" aria-label="password" required />
                    </div>
                </div>
                <div id="div-button" class="text-center">
                    <button class="btn btn-primary btn-lg rounded-pill px-3 " type="submit" name="submit_login">ลงชื่อเข้าใช้งาน</button>
                </div>
            </form>

        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
    <script src="script/script.js"></script>
    <?php include('asset/footer.php'); ?>