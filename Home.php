<?php
session_start();
include('backend/bypass_detection.php');
include('database/connect_database.php');
include('backend/sql_query.php');
include('asset/header.php');
include('asset/navbar.php');
?>

<link rel="stylesheet" href="css/body.css">

<body style="background-image: url('image/background1.png');">
    <main>
        <div class="d-flex h-100 align-items-center text-center py-4 card-container">
            <div class="d-flex flex-row align-items-center m-auto gap-5">
                <div onclick="window.location='add_athlete.php'"
                    class="card-button card p-4 d-flex flex-column align-items-center justify-content-around ">
                    <img src="image/เพิ่มรายการแข่งขัน.png" alt="เพิ่มรายการแข่งขัน">
                    <button class="rounded-pill fw-bolder button-admin">สร้างรายการแข่งขัน</button>
                </div>
                <div class="card-button card p-4 d-flex flex-column align-items-center justify-content-around">
                    <img src="image/เลือกนักกีฬา.png" alt="เลือกนักกีฬา">
                    <button class="rounded-pill fw-bolder button-admin">เพิ่มนักกีฬาในรายการแข่งขัน</button>
                </div>
                <div class="card-button card p-4 d-flex flex-column align-items-center justify-content-around">
                    <img src="image/บันทึกผลการแข่งขัน.png" alt="บันทึกผลการแข่งขัน">
                    <button class="rounded-pill fw-bolder button-admin">บันทึกผลการแข่งขัน</button>

                </div>
            </div>
        </div>
    </main>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="script/script.js"></script>
    <?php include('asset/footer.php'); ?>