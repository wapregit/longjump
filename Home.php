<?php
session_start();
include('include/backend/bypass_detection.php');
include('include/database/connect_database.php');
include('include/backend/sql_query.php');
include('include/asset/header.php');
include('include/asset/navbar.php'); 
?>

<link rel="stylesheet" href="include/css/body.css">

<body style="background-image: url('include/image/background1.png');">
    <main>
        <div class="d-flex h-100 align-items-center text-center py-4">
            <div class="card d-flex flex-row m-auto gap-3 p-3">
                <div onclick="window.location='add_athlete.php'" class="card p-4"><i class="bi bi-plus-square-fill"></i>
                    <b>สร้างรายการแข่งขัน</b>
                </div>
                <div class="card p-4"><i class="bi bi-check-square-fill"></i> <b>เพิ่มนักกีฬาในรายการแข่งขัน</b></div>
                <div class="card p-4"><i class="bi bi-floppy2-fill"></i> <b>บันทึกผลการแข่งขัน</b></div>
            </div>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="include/script/script.js"></script>
    <?php include('include/asset/footer.php'); ?>