<!-- Sweetalert2 -->
<link rel="stylesheet" href="../css/font.css">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
<?php
include('../database/connect_database.php');

if (isset($_POST['program_title']) && isset($_POST['program_location']) && isset($_POST['program_date'])) {
    // รับข้อมูลรายการแข่งขัน
    $program_title = $_POST['program_title'];
    $program_location = $_POST['program_location'];
    $program_date = $_POST['program_date'];
    $program_id = $_POST['program_id'];
    $program_name = $_POST['program_name'];
    $program_sex = $_POST['program_sex'];
    $program_age = $_POST['program_age'];
    $program_round = $_POST['program_round'];
    $program_time = $_POST['program_time'];

    // รับข้อมูลนักกีฬา
    $athlete_bib = $_POST['athlete_bib'];
    $athlete_name = $_POST['athlete_name'];
    $athlete_club = $_POST['athlete_club'];

    // เตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูลรายการแข่งขัน
    $sql_insert_program = "INSERT INTO competition_program (program_title, program_location, program_date, program_id, program_name, program_sex, program_age, program_round, program_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $sql_prepare_insert_program = $condb->prepare($sql_insert_program);

    if ($sql_prepare_insert_program) {
        // วนลูปเพื่อเพิ่มข้อมูลรายการแข่งขัน
        for ($i = 0; $i < count($program_id); $i++) {
            $sql_prepare_insert_program->bind_param("sssssssss", $program_title, $program_location, $program_date, $program_id[$i], $program_name[$i], $program_sex[$i], $program_age[$i], $program_round[$i], $program_time[$i]);
            $sql_prepare_insert_program->execute();

            // เตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูลนักกีฬา
            $sql_insert_athlete = "INSERT INTO competition_athlete (program_id, athlete_bib, athlete_name, athlete_club) VALUES (?, ?, ?, ?)";
            $sql_prepare_insert_athlete = $condb->prepare($sql_insert_athlete);

            // ตรวจสอบว่าสามารถเตรียมคำสั่ง SQL สำหรับเพิ่มข้อมูลนักกีฬาได้หรือไม่
            if ($sql_prepare_insert_athlete) {
                // เพิ่มข้อมูลนักกีฬาโดยใช้ลำดับของข้อมูลเพื่อเชื่อมโยงกับ program_id
                for ($j = 0; $j < count($athlete_name); $j++) {
                    $sql_prepare_insert_athlete->bind_param("ssss", $program_id[$i], $athlete_bib[$j], $athlete_name[$j], $athlete_club[$j]);
                    $sql_prepare_insert_athlete->execute();
                }
                $sql_prepare_insert_athlete->close();
            } else {
                // กรณีไม่สามารถเตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูลนักกีฬาได้
                echo "Error: " . $sql_insert_athlete . "<br>" . $condb->error;
            }
        }
        $sql_prepare_insert_program->close();

        // แสดงข้อความสำเร็จหลังจากเพิ่มข้อมูลเสร็จสิ้น
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "เพิ่มข้อมูลสำเร็จ",
                    text: "Redirecting in 1 second",
                    showConfirmButton: false,
                    timer: 1500,
                    heightAuto: false
                }).then(function() {
                    window.location = "../home.php";
                });
            });
        </script>';
    } else {
        // กรณีที่ไม่สามารถเตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูลรายการแข่งขันได้
        echo "Error: " . $sql_insert_program . "<br>" . $condb->$condb->close();
    }
}
?>