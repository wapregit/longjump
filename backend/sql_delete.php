<!-- Sweetalert2 -->
<link rel="stylesheet" href="../css/font.css">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
<?php
include('../database/connect_database.php');

if (isset($_POST['delete_program_id'])) {
    // รับข้อมูลรายการแข่งขัน
    $program_id = $_POST['delete_program_id'];


    // เตรียมคำสั่ง SQL สำหรับการลบข้อมูลรายการแข่งขัน
    $sql_delete_program = "DELETE FROM competition_program WHERE program_id = ?";
    $sql_prepare_delete_program = $condb->prepare($sql_delete_program);

    if ($sql_prepare_delete_program) {
        $sql_prepare_delete_program->bind_param("s", $program_id);
        $sql_prepare_delete_program->execute();
        $sql_prepare_delete_program->close();
        // แสดงข้อความสำเร็จหลังจากเพิ่มข้อมูลเสร็จสิ้น
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "ลบรายการสำเร็จ",
                    text: "Redirecting in 1 second",
                    showConfirmButton: false,
                    timer: 1500,
                    heightAuto: false
                }).then(function() {
                    window.location = "../add_athlete.php";
                });
            });
        </script>';
    } else {
        // กรณีที่ไม่สามารถเตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูลรายการแข่งขันได้
        echo "Error: " . $sql_delete_program . "<br>" . $condb->$condb->close();
    }
}

if (isset($_POST['delete_athlete_id'])) {
    // รับข้อมูลรายการแข่งขัน
    $athlete_id = $_POST['delete_athlete_id'];


    // เตรียมคำสั่ง SQL สำหรับการลบข้อมูลรายการแข่งขัน
    $sql_delete_athlete = "DELETE FROM competition_athlete WHERE athlete_id = ?";
    $sql_prepare_delete_athlete = $condb->prepare($sql_delete_athlete);

    if ($sql_prepare_delete_athlete) {
        $sql_prepare_delete_athlete->bind_param("i", $athlete_id);
        $sql_prepare_delete_athlete->execute();
        $sql_prepare_delete_athlete->close();
        // แสดงข้อความสำเร็จหลังจากเพิ่มข้อมูลเสร็จสิ้น
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "ลบนักกีฬาสำเร็จสำเร็จ",
                    text: "Redirecting in 1 second",
                    showConfirmButton: false,
                    timer: 1500,
                    heightAuto: false
                }).then(function() {
                    window.location = "../add_athlete.php";
                });
            });
        </script>';
    } else {
        // กรณีที่ไม่สามารถเตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูลรายการแข่งขันได้
        echo "Error: " . $sql_delete_athlete . "<br>" . $condb->$condb->close();
    }
}

if(isset($_POST['record_id'])) {
    $record_id = $_POST['record_id'];

    $sql_select_path = "SELECT * FROM competition_record WHERE record_id = ?";
    $sql_prepare_select_path = $condb->prepare($sql_select_path);
    $sql_prepare_select_path->bind_param("i", $record_id);
    $sql_prepare_select_path->execute();
    $result = $sql_prepare_select_path->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $videoFilePath = '../videos/' . $row['record_path'];

        if (file_exists($videoFilePath)) {
            if (unlink($videoFilePath)) {
                // ลบวิดีโอจากโฟลเดอร์สำเร็จ
                // ดำเนินการลบข้อมูลจากฐานข้อมูล
                $sql_delete_video = "DELETE FROM competition_record WHERE record_id = ?";
                $sql_prepare_delete_video = $condb->prepare($sql_delete_video);
                $sql_prepare_delete_video->bind_param("i", $record_id);
                $sql_prepare_delete_video->execute();
                $sql_prepare_delete_video->close();

                echo '<script>
                        document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                                icon: "success",
                                title: "ลบรายการสำเร็จ",
                                text: "Redirecting in 1 second",
                                showConfirmButton: false,
                                timer: 1500,
                                heightAuto: false
                            }).then(function() {
                                window.location = "../competition_replay.php";
                            });
                        });
                    </script>';
            } else {
                // เกิดข้อผิดพลาดในการลบวิดีโอ
                showErrorAlertAndRedirect("เกิดข้อผิดพลาดในการลบวิดีโอ");
            }
        } else {
            // ไม่พบไฟล์วิดีโอที่ต้องการลบ
            showErrorAlertAndRedirect("ไม่พบไฟล์วิดีโอที่ต้องการลบ");
        }
    } else {
        // ไม่พบข้อมูลวิดีโอที่ต้องการลบ
        showErrorAlertAndRedirect("ไม่พบข้อมูลวิดีโอที่ต้องการลบ");
    }
}

function showErrorAlertAndRedirect($errorMessage) {
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "'.$errorMessage.'",
                    text: "Redirecting in 1 second",
                    showConfirmButton: false,
                    timer: 1500,
                    heightAuto: false
                }).then(function() {
                    window.location = "../competition_replay.php";
                });
            });
        </script>';
}

?>