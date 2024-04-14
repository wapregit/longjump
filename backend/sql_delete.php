<!-- Sweetalert2 -->
<link rel="stylesheet" href="../css/font.css">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
<?php
include('../database/connect_database.php');

if (isset($_POST['program_id'])) {
    // รับข้อมูลรายการแข่งขัน
    $program_id = $_POST['program_id'];


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
        echo "Error: " . $sql_insert_program . "<br>" . $condb->$condb->close();
    }
}
?>