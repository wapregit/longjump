<?php
session_start();
include('backend/bypass_detection.php');
include('asset/header.php');
include('asset/navbar.php');
?>

<body style="background-image: url('image/background1.png');">
    <main>
        <div class="d-flex h-100 align-items-center text-center py-4 card-container">
            <div class="d-flex flex-row align-items-center m-auto gap-5">
                <div onclick="window.location='add_program.php'" class="card-button card p-4 d-flex flex-column align-items-center justify-content-around ">
                    <img src="image/เพิ่มรายการแข่งขัน.png" alt="เพิ่มรายการแข่งขัน">
                    <button class="rounded-pill fw-bolder button-admin">สร้างรายการแข่งขัน</button>
                </div>
                <div onclick="window.location='add_athlete.php'" class="card-button card p-4 d-flex flex-column align-items-center justify-content-around">
                    <img src="image/เลือกนักกีฬา.png" alt="เลือกนักกีฬา">
                    <button class="rounded-pill fw-bolder button-admin">จัดการนักกีฬา</button>
                </div>
                <div onclick="window.location='competition_result.php'" class="card-button card p-4 d-flex flex-column align-items-center justify-content-around">
                    <img src="image/บันทึกผลการแข่งขัน.png" alt="บันทึกผลการแข่งขัน">
                    <button class="rounded-pill fw-bolder button-admin">บันทึกผลการแข่งขัน</button>
                </div>
            </div>
        </div>
    </main>


    <?php include('script.php'); ?>
    <?php include('asset/footer.php'); ?>