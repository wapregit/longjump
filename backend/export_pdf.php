<?php
require_once('../database/connect_database.php');
require_once('../vendor/autoload.php');

use Dompdf\Dompdf;
use Dompdf\Options;

extract($_POST);

if (isset($_POST['submit'])) {
    $programId = $_POST['export_program_id'];

    $sql = "SELECT * FROM competition_program WHERE program_id = ?";
    $stmt = $condb->prepare($sql);
    $stmt->bind_param("s", $programId);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    $program_date = date('Y-m-d', strtotime($row['program_date']));
    $date = new DateTime($program_date);
    $thai_months = array(
        1 => 'มกราคม',
        2 => 'กุมภาพันธ์',
        3 => 'มีนาคม',
        4 => 'เมษายน',
        5 => 'พฤษภาคม',
        6 => 'มิถุนายน',
        7 => 'กรกฎาคม',
        8 => 'สิงหาคม',
        9 => 'กันยายน',
        10 => 'ตุลาคม',
        11 => 'พฤศจิกายน',
        12 => 'ธันวาคม'
    );
    $day = $date->format('d');
    $month = $thai_months[(int)$date->format('m')];
    $year = $date->format('Y') + 543; // แปลงเป็นปี พ.ศ.
    $program_thai_date = "$day $month $year";

    $program_time = date('H:i', strtotime($row['program_time']));

    $html = <<<HTML
    <!DOCTYPE html>
    <html lang="th">

    <head>
    <!-- Required Meta Tag -->
    <meta charset="utf-8">
    <meta name="Author" content="Chakat & Ronnachai">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    
    </head>
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
        }
    </style>
    <body>
HTML;

    $html .= ' 
            <table style="width: 100%;border: 1px solid"">
                <thead>
                    <tr>
                        <th>ผลการแข่งขัน</th>
                    </tr>
                    <tr>
                        <th>' . $row['program_title'] . '</th>
                    </tr>
                    <tr>
                        <th>' . $row['program_location'] . '</th>
                    </tr>
                    <tr>
                        <th>' . $program_thai_date . '</th>
                    </tr>
                </thead>
            </table> ';
    $html .= '
            <table style="width: 100%;border: 1px solid">
                <thead>
                    <tr>
                    <th>รายการที่</th>
                    <th>' . $row['program_id'] . '</th>
                    <th>' . $row['program_name'] . ' ' . $row['program_sex'] .  '</th>
                    <th>' . is_numeric($row['program_age']) ? $row['program_age'] . " ปี" : $row['program_age'] . '</th>
                    <th>' . $row['program_round'] . '</th>
                    <th>' . $program_time . ' น.' . '</th>
                    </tr>
                </thead>
            </table>';

    $sql2 = "SELECT * FROM competition_athlete WHERE program_id = ?";
    $stmt2 = $condb->prepare($sql2);
    $stmt2->bind_param("s", $programId);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if (mysqli_num_rows($result2) > 0) {
        $html .= '
                    <table style="width: 100%">
                        <thead>
                            <tr>
                                <th rowspan="2">L/O</th>
                                <th rowspan="2">BIB</th>
                                <th rowspan="2">Athlete Name</th>
                                <th rowspan="2">Club</th>
                                <th colspan="3">Result</th>
                                <th rowspan="2">Best 3 times</th>
                                <th colspan="3">Result</th>
                                <th rowspan="2">Record</th>
                                <th rowspan="2">Ranking</th>
                                <th rowspan="2">Comment</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                            </tr>
                        </thead>
                        <tbody>';

        while ($athlete = $result2->fetch_assoc()) {
            $html .= '<tr>
                    <td>' . (isset($athlete['athlete_order']) ? $athlete['athlete_order'] : '') . '</td>
                    <td>' . (isset($athlete['athlete_bib']) ? $athlete['athlete_bib'] : 'N/A') . '</td>
                    <td>' . (isset($athlete['athlete_name']) ? $athlete['athlete_name'] : 'N/A N/A') . '</td>
                    <td>' . (isset($athlete['athlete_club']) ? $athlete['athlete_club'] : 'N/A') . '</td>
                    <td>' . (isset($athlete['athlete_result_1']) ? $athlete['athlete_result_1'] : '') . '</td>
                    <td>' . (isset($athlete['athlete_result_2']) ? $athlete['athlete_result_2'] : '') . '</td>
                    <td>' . (isset($athlete['athlete_result_3']) ? $athlete['athlete_result_3'] : '') . '</td>
                    <td>' . ($athlete['athlete_bo3'] == '0' ? '' : $athlete['athlete_bo3']) . '</td>
                    <td>' . (isset($athlete['athlete_result_4']) ? $athlete['athlete_result_4'] : '') . '</td>
                    <td>' . (isset($athlete['athlete_result_5']) ? $athlete['athlete_result_5'] : '') . '</td>
                    <td>' . (isset($athlete['athlete_result_6']) ? $athlete['athlete_result_6'] : '') . '</td>
                    <td>' . ($athlete['athlete_record'] == '0' ? '' : $athlete['athlete_record']) . '</td>
                    <td>' . (isset($athlete['athlete_ranking']) ? $athlete['athlete_ranking'] : '') . '</td>
                    <td>' . (isset($athlete['athlete_comment']) ? $athlete['athlete_comment'] : 'N/A') . '</td>
                </tr>';
        }
    } else {
        $html .= '
                        <tr>
                        <td colspan="14"> ไม่พบข้อมูล </td>
                        </tr>';
    }
    $html .= '</tbody>
            </table>
            </body>
            </html>';

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('fontDir', '../path/to/fonts/');
    $options->set('fontCache', '../path/to/font/cache/');
    $options->set('defaultFont', 'Sarabun');
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream("competition_result.pdf");
}