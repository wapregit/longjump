<!-- Sweetalert2 -->
<link rel="stylesheet" href="../css/font.css">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
<?php
include('../database/connect_database.php');

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['import_file'])) {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = "0";
        foreach ($data as $row) {
            if ($count > 0) {
                $program_title = $row[0]; // Primary Key อ่านคอลัมท์ A
                $program_location = $row[1]; // B
                $program_date = $row[2]; // C
                $program_id = $row[3]; // D
                $program_name = $row[4]; // E
                $program_sex = $row[5]; // F
                $program_age = $row[6]; // G
                $program_round = $row[7]; // H
                $program_time = $row[8]; // I
                $athlete_bib = $row[9]; // J
                $athlete_name = $row[10]; // K
                $athlete_club = $row[11]; // L

                $sql_excel_insert_program = "INSERT INTO competition_program (program_id, program_name, program_sex, program_age, program_round, program_time, program_date, program_title, program_location)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $sql_prepare_excel_insert_program = $condb->prepare($sql_excel_insert_program);

                $sql_excel_insert_athlete = "INSERT INTO competition_athlete (athlete_bib, athlete_name, athlete_club) VALUES (?, ?, ?)";
                $sql_prepare_excel_insert_athlete = $condb->prepare($sql_excel_insert_athlete);

                if ($sql_prepare_excel_insert_program) {
                    $sql_prepare_excel_insert_program->bind_param("sssssssss", $program_id, $program_name, $program_sex, $program_age, $program_round, $program_time, $program_date, $program_title, $program_location);
                    $sql_prepare_excel_insert_program->execute();
                    $sql_prepare_excel_insert_program->close();

                    if ($sql_prepare_excel_insert_athlete) {
                        $sql_prepare_excel_insert_athlete->bind_param("sss", $athlete_bib, $athlete_name, $athlete_club);
                        $sql_prepare_excel_insert_athlete->execute();
                        $sql_prepare_excel_insert_athlete->close();
                        // แสดงข้อความสำเร็จหลังจากเพิ่มข้อมูลเสร็จสิ้น
                        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "success",
                title: "นำเข้าข้อมูลสำเร็จ",
                text: "Redirecting in 1 second",
                showConfirmButton: false,
                timer: 1500,
                heightAuto: false
            }).then(function() {
                window.location = "../add_athlete.php";
            });
        });
    </script>';
                    }
                }
            } else {
                $count = "1";
            }
        }
    }
} else {
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "ไม่สามารถนำเข้าข้อมูลได้",
                text: "Redirecting in 1 second",
                showConfirmButton: false,
                timer: 1500,
                heightAuto: false
            }).then(function() {
                window.location = "../add_athlete.php";
            });
        });
    </script>';
}