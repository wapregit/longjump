t<?php
    require_once '../database/connect_database.php';
    require_once  '../vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4-L',
        'default_font_size' => 14,
        'default_font' => 'sarabun'
    ]);

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

        $html = '';
        $html .= ' 
            <table class="table1">
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
            <table class="table2">
                <thead>
                    <tr>
                    <th>รายการที่</th>
                    <th>' . $row['program_id'] . '</th>
                    <th>' . $row['program_name'] . ' ' . $row['program_sex'] .  '</th>
                    <th>' . (is_numeric($row['program_age']) ? $row['program_age'] . " ปี" : $row['program_age']) . '</th>
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
                    <table class="table3">
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
                    <td class="order">' . (isset($athlete['athlete_order']) ? $athlete['athlete_order'] : '') . '</td>
                    <td class="bib">' . (isset($athlete['athlete_bib']) ? $athlete['athlete_bib'] : 'N/A') . '</td>
                    <td class="name">' . (isset($athlete['athlete_name']) ? $athlete['athlete_name'] : 'N/A N/A') . '</td>
                    <td class="club">' . (isset($athlete['athlete_club']) ? $athlete['athlete_club'] : 'N/A') . '</td>
                    <td class="result">' . (isset($athlete['athlete_result_1']) ? $athlete['athlete_result_1'] : '') . '</td>
                    <td class="result">' . (isset($athlete['athlete_result_2']) ? $athlete['athlete_result_2'] : '') . '</td>
                    <td class="result">' . (isset($athlete['athlete_result_3']) ? $athlete['athlete_result_3'] : '') . '</td>
                    <td class="bo3">' . ($athlete['athlete_bo3'] == '0' ? '' : $athlete['athlete_bo3']) . '</td>
                    <td class="result">' . (isset($athlete['athlete_result_4']) ? $athlete['athlete_result_4'] : '') . '</td>
                    <td class="result">' . (isset($athlete['athlete_result_5']) ? $athlete['athlete_result_5'] : '') . '</td>
                    <td class="result">' . (isset($athlete['athlete_result_6']) ? $athlete['athlete_result_6'] : '') . '</td>
                    <td class="record">' . ($athlete['athlete_record'] == '0' ? '' : $athlete['athlete_record']) . '</td>
                    <td class="ranking">' . (isset($athlete['athlete_ranking']) ? $athlete['athlete_ranking'] : '') . '</td>
                    <td class="comment">' . (isset($athlete['athlete_comment']) ? $athlete['athlete_comment'] : 'N/A') . '</td>
                </tr>';
            }
        } else {
            $html .= '
                        <tr>
                        <td colspan="14"> ไม่พบข้อมูล </td>
                        </tr>';
        }
        $html .= '
        </tbody>
            </table>
            <div class="sign">
            <span>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</span><br>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;กรรมการ</span>
            </div>';

        $stylesheet = file_get_contents('../css/pdf.css');

        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->Output();
    }