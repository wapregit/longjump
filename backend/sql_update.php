<!-- Sweetalert2 -->
<link rel="stylesheet" href="../css/font.css">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
<?php
include('../database/connect_database.php');

if (isset($_POST['update_athlete_bib'])) {
    $athlete_id = $_POST['athlete_id'];
    $athlete_bib = $_POST['update_athlete_bib'];

    $sql_update_bib = "UPDATE competition_athlete SET athlete_bib = ? WHERE athlete_id = ? ";
    $sql_prepare_update_bib = $condb->prepare($sql_update_bib);

    if ($sql_prepare_update_bib) {
        $sql_prepare_update_bib->bind_param("si", $athlete_bib, $athlete_id);
        $sql_prepare_update_bib->execute();
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "แก้ไขข้อมูลสำเร็จ",
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
        echo "Error: " . $sql_update_bib . "<br>" . $condb->$condb->close();
    }
}

if (isset($_POST['update_athlete_name'])) {
    $athlete_id = $_POST['athlete_id'];
    $athlete_name = $_POST['update_athlete_name'];

    $sql_update_name = "UPDATE competition_athlete SET athlete_name = ? WHERE athlete_id = ? ";
    $sql_prepare_update_name = $condb->prepare($sql_update_name);

    if ($sql_prepare_update_name) {
        $sql_prepare_update_name->bind_param("si", $athlete_name, $athlete_id);
        $sql_prepare_update_name->execute();
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "แก้ไขข้อมูลสำเร็จ",
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
        echo "Error: " . $sql_update_bib . "<br>" . $condb->$condb->close();
    }
}

if (isset($_POST['update_athlete_club'])) {
    $athlete_id = $_POST['athlete_id'];
    $athlete_club = $_POST['update_athlete_club'];

    $sql_update_club = "UPDATE competition_athlete SET athlete_club = ? WHERE athlete_id = ? ";
    $sql_prepare_update_club = $condb->prepare($sql_update_club);

    if ($sql_prepare_update_club) {
        $sql_prepare_update_club->bind_param("si", $athlete_club, $athlete_id);
        $sql_prepare_update_club->execute();
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "แก้ไขข้อมูลสำเร็จ",
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
        echo "Error: " . $sql_update_club . "<br>" . $condb->$condb->close();
    }
}

if (isset($_POST['update_table_athlete_id'])) {
    $programId = $_POST['program_id'];
    $athleteId = $_POST['update_table_athlete_id'];
    $athlete_order = $_POST['athlete_order'];
    $athlete_result1 = $_POST['athlete_result_1'];
    $athlete_result2 = $_POST['athlete_result_2'];
    $athlete_result3 = $_POST['athlete_result_3'];
    $athlete_result4 = $_POST['athlete_result_4'];
    $athlete_result5 = $_POST['athlete_result_5'];
    $athlete_result6 = $_POST['athlete_result_6'];
    $athlete_ranking = $_POST['athlete_ranking'];
    $athlete_comment = $_POST['athlete_comment'];

    $sql_update_data = "UPDATE competition_athlete SET athlete_order = ?, athlete_result_1 = ?, athlete_result_2 = ?, athlete_result_3 = ?, athlete_result_4 = ?, athlete_result_5 = ?, athlete_result_6 = ?, athlete_ranking = ?, athlete_comment = ? WHERE athlete_id = ? ";
    $sql_prepare_update_data = $condb->prepare($sql_update_data);

    if ($sql_prepare_update_data) {
        for ($i = 0; $i < count($athleteId); $i++) {
            $sql_prepare_update_data->bind_param("sssssssssi", $athlete_order[$i], $athlete_result1[$i], $athlete_result2[$i], $athlete_result3[$i], $athlete_result4[$i], $athlete_result5[$i], $athlete_result6[$i], $athlete_ranking[$i], $athlete_comment[$i], $athleteId[$i]);
            $sql_prepare_update_data->execute();
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "แก้ไขข้อมูลสำเร็จ",
                    text: "Redirecting in 1 second",
                    showConfirmButton: false,
                    timer: 4500,
                    heightAuto: false
                }).then(function() {
                    window.location = "../competition_result.php?select_program=' . $programId . '";
                });
            });
        </script>';
        }
    }
}
?>