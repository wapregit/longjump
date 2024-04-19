<?php
session_start();
include('database/connect_database.php');
include('backend/sql_select.php');
include('asset/header.php');
include('asset/navbar.php');

// ดึงข้อมูล
$sql = "SELECT * FROM transaction_value ORDER BY value_id DESC";
$stmt = $condb->prepare($sql);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

$stmt->close();


?>

<main style="background-color: #D9E1E4">
    <div class="py-5">
        <div class="row m-auto" style="width: 90%">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <div class="card py-3 px-4  rounded-4 w-100">
                            <div class="div-select-program w-100 m-auto py-4 position-relative">
                                <div class="d-flex gap-4 align-items-center">
                                    <label for=" select_program" class="form-label h4">เลือกรายการแข่งขัน</label>
                                    <?php if (isset($_GET['select_program']) && $_GET['select_program'] !== '') { ?>
                                    <div>
                                        <form action="backend/export_pdf.php" method="POST">
                                            <input type="hidden" name="export_program_id"
                                                value="<?= $_GET['select_program'] ?>">
                                            <button class="btn btn-primary" type="submit" name="submit">Export
                                                ตาราง</button>
                                        </form>
                                    </div>
                                    <?php } ?>
                                </div>
                                <hr>
                                <form class="form" id="form_select_program" method="GET">
                                    <select name="select_program" id="select_program"
                                        class="form-select form-select-lg">
                                        <option value='' disabled selected>เลือกรายการแข่งขัน</option>
                                        <?php foreach ($select_program as $select_program) { ?>
                                        <option value="<?= $select_program['program_id']; ?>"
                                            <?php if (isset($_GET['select_program']) && $_GET['select_program'] == $select_program['program_id']) echo "selected"; ?>>
                                            รายการที่
                                            <?= $select_program['program_id'] . ' ' . $select_program['program_name'] . ' ' . (is_numeric($select_program['program_age']) ? $select_program['program_age'] . " ปี" : $select_program['program_age']) . ' ' .  $select_program['program_sex']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </form>

                                <?php if (isset($_GET['select_program']) && $_GET['select_program'] !== '') { ?>
                                <div class="edit position-absolute" id="edit" onclick="edit_score_athlete()">
                                    <div class="input-group">
                                        <button class="rounded-start btn-edit">แก้ไข</button>
                                        <div class="input-group-append">
                                            <span class="input-group-text span-edit h-auto"
                                                style="border-top-left-radius: 0; border-bottom-left-radius: 0;"><i
                                                    class="bi bi-pencil-square"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="save position-absolute" id="save" style="display:none;"
                                    onclick="submit_form_edit_data()">
                                    <div class="input-group">
                                        <button class="rounded-start btn-save">บันทึก</button>
                                        <div class="input-group-append">
                                            <span class="input-group-text span-save h-auto"
                                                style="border-top-left-radius: 0; border-bottom-left-radius: 0;"><i
                                                    class="bi bi-save2"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if (isset($_GET['select_program']) && $_GET['select_program'] !== '') { ?>
                        <div class="card py-3 px-4  mt-5 rounded-4 w-100 h-50">
                            <button class="btn btn-success h-100" onclick="startCompetition()">
                                <h1>เริ่มการแข่งขัน</h1>
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                    <?php if (isset($_GET['select_program']) && $_GET['select_program'] !== '') { ?>
                    <div class="col-6">
                        <div class="card rounded-4 w-100 p-4 gap-2 justify-content-center align-items-center">
                            <video id="video-preview" width="480" height="480" autoplay muted></video>
                            <div class="d-flex justify-content-center gap-3 w-100">
                                <button id="start-recording" class="btn btn-success w-25"><i
                                        class="bi bi-record-circle"></i> บันทึกวิดีโอ</button>
                                <button id="stop-recording" disabled class="btn btn-danger w-25"><i
                                        class="bi bi-pause-circle"></i> หยุดบันทึก /
                                    Save</button>
                                <button class="btn btn-primary"
                                    onclick="window.location.href='competition_replay.php'"><i class="bi bi-film"></i>
                                    รายการย้อนหลัง</button>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php if (isset($_GET['select_program']) && $_GET['select_program'] !== '') { ?>
            <div class="col-12 mt-4">
                <div class="container-table p-4 m-auto rounded-4 w-100" style="background-color: #C3CACD;">
                    <div class="table-responsive table1">
                        <table class="table table-header">
                            <thead>
                                <tr>
                                    <th class="fw-bolder">ผลการแข่งขัน</th>
                                </tr>
                                <?php foreach ($program as $program_table1) { ?>
                                <tr>
                                    <th class="fw-bolder"><?= $program_table1['program_title']; ?></th>
                                </tr>
                                <tr>
                                    <th class="fw-bolder"><?= $program_table1['program_location']; ?></th>
                                </tr>
                                <tr>
                                    <?php
                                            $program_date = date('Y-m-d', strtotime($program_table1['program_date']));
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
                                            ?>
                                    <th class="fw-bolder"> <?= $program_thai_date; ?> </th>
                                </tr>
                                <?php } ?>
                            </thead>
                        </table>
                    </div>
                    <div class="table-responsive table2">
                        <table class="table">
                            <thead>
                                <tr>
                                    <?php foreach ($program as $program_table2) { ?>
                                    <th>รายการที่</th>
                                    <th><?= $program_table2['program_id']; ?></th>
                                    <th><?= $program_table2['program_name'] . ' ' . $program_table2['program_sex']; ?>
                                    </th>
                                    <th>กลุ่มอายุ:
                                        <?= is_numeric($program_table2['program_age']) ? $program_table2['program_age'] . " ปี" : $program_table2['program_age']; ?>
                                    </th>
                                    <th><?= $program_table2['program_round']; ?></th>
                                    <?php $program_time = date('H:i', strtotime($program_table2['program_time'])); ?>
                                    <th><?= $program_time . ' น.'; ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="table-responsive table3">
                        <table class="table" id="table3">
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
                            <tbody>
                                <form action="backend/sql_update.php" METHOD="POST" class="form"
                                    id="form_edit_data_athlete">
                                    <?php foreach ($athlete as $athlete) { ?>
                                    <input type="hidden" name="program_id" value="<?= $athlete['program_id'] ?>">
                                    <input type="hidden" name="update_table_athlete_id[]"
                                        value="<?= $athlete['athlete_id'] ?>">
                                    <tr class="table-row">
                                        <td class="table-data text-center order">
                                            <?= isset($athlete['athlete_order']) ? '<input type="text" name="athlete_order[]" class="bg-transparent border-0 w-100 text-center" value="' . $athlete['athlete_order'] . '" autocomplete="off" disabled>' :
                                                        '<input type="text" name="athlete_order[]" class="bg-transparent border-0 w-100 text-center"  value="' . $athlete['athlete_order'] . '" placeholder="N/A" autocomplete="off" disabled>'; ?>
                                        </td>
                                        <td class="table-data text-center bib">
                                            <?= isset($athlete['athlete_bib']) ? $athlete['athlete_bib'] : 'N/A'; ?>
                                        </td>
                                        <td class="table-data name">
                                            <?= isset($athlete['athlete_name']) ? $athlete['athlete_name'] : 'N/A N/A'; ?>
                                        </td>
                                        <td class="table-data club">
                                            <?= isset($athlete['athlete_club']) ? $athlete['athlete_club'] : 'N/A'; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_1']) ? '<input type="text" name="athlete_result_1[]" class="bg-transparent border-0 w-100 text-center" value="' . $athlete['athlete_result_1'] . '" autocomplete="off" disabled>' :
                                            '<a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . $row["value"] . '&id=1&program_id=' . $athlete['program_id'] . '">
                                            <div class="btn btn-success" style="width: 3vw">บันทึก</div></a> 
                                            <a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . '-' . '&id=1&program_id=' . $athlete['program_id'] . '">
                                            <div class="btn btn-danger" style="width: 3vw">ขาด</div></a> 
                                            '; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_2']) ? '<input type="text" name="athlete_result_2[]" class="bg-transparent border-0 w-100 text-center" value="' . $athlete['athlete_result_2'] . '" autocomplete="off" disabled>' :
                                                        '<a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . $row["value"] . '&id=2&program_id=' . $athlete['program_id'] . '">
                                            <div class="btn btn-success" style="width: 3vw">บันทึก</div></a> 
                                            <a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . '-' . '&id=2&program_id=' . $athlete['program_id'] . '">
                                            <div class="btn btn-danger" style="width: 3vw">ขาด</div></a> 
                                            '; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_3']) ? '<input type="text" name="athlete_result_3[]" class="bg-transparent border-0 w-100 text-center" value="' . $athlete['athlete_result_3'] . '" autocomplete="off" disabled>' :
                                                        '<a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . $row["value"] . '&id=3&program_id=' . $athlete['program_id'] . '">
                                            <div class="btn btn-success" style="width: 3vw">บันทึก</div></a> 
                                            <a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . '-' . '&id=3&program_id=' . $athlete['program_id'] . '">
                                            <div class="btn btn-danger" style="width: 3vw">ขาด</div></a> 
                                            '; ?>
                                        </td>
                                        <td class="table-data text-center bo3">
                                            <?php
                                                    $bo3 = '';
                                                    if ($athlete['athlete_bo3'] == '0') {
                                                        $bo3 = '';
                                                        if ($athlete['athlete_result_1'] == '-' && $athlete['athlete_result_2'] == '-' && $athlete['athlete_result_3'] == '-') {
                                                            $bo3 = '-';
                                                        }
                                                    } else {
                                                        $bo3 = $athlete['athlete_bo3'];
                                                    }
                                                    echo $bo3
                                                    ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_4']) ? '<input type="text" name="athlete_result_4[]" class="bg-transparent border-0 w-100 text-center" value="' . $athlete['athlete_result_4'] . '" autocomplete="off" disabled>' :
                                                        '<a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . $row["value"] . '&id=4&program_id=' . $athlete['program_id'] . '">
                                            <div class="btn btn-success" style="width: 3vw">บันทึก</div></a> 
                                            <a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . '-' . '&id=4&program_id=' . $athlete['program_id'] . '">
                                            <div class="btn btn-danger" style="width: 3vw">ขาด</div></a> 
                                            '; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_5']) ? '<input type="text" name="athlete_result_5[]" class="bg-transparent border-0 w-100 text-center" value="' . $athlete['athlete_result_5'] . '" autocomplete="off" disabled>' :
                                                        '<a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . $row["value"] . '&id=5&program_id=' . $athlete['program_id'] . '">
                                            <div class="btn btn-success" style="width: 3vw">บันทึก</div></a> 
                                            <a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . '-' . '&id=5&program_id=' . $athlete['program_id'] . '">
                                            <div class="btn btn-danger" style="width: 3vw">ขาด</div></a> 
                                            '; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_6']) ? '<input type="text" name="athlete_result_6[]" class="bg-transparent border-0 w-100 text-center" value="' . $athlete['athlete_result_6'] . '" autocomplete="off" disabled>' :
                                                        '<a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . $row["value"] . '&id=6&program_id=' . $athlete['program_id'] . '">
                                            <div class="btn btn-success" style="width: 3vw">บันทึก</div></a> 
                                            <a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . '-' . '&id=6&program_id=' . $athlete['program_id'] . '">
                                            <div class="btn btn-danger" style="width: 3vw">ขาด</div></a> 
                                            '; ?>
                                        </td>
                                        <td class="table-data text-center record">
                                            <?= $athlete['athlete_record'] == '0' ? '' : $athlete['athlete_record']; ?>
                                        </td>
                                        <td class="table-data text-center ranking">
                                            <?= isset($athlete['athlete_ranking']) ? '<input type="text" name="athlete_ranking[]" class="bg-transparent border-0 w-100 text-center" value="' . $athlete['athlete_ranking'] . '" autocomplete="off" disabled>' :
                                                        '<input type="text" name="athlete_ranking[]" class="bg-transparent border-0 w-100 text-center"  value="' . $athlete['athlete_ranking'] . '" placeholder="" autocomplete="off" disabled>'; ?>
                                        </td>
                                        <td class="table-data text-center comment">
                                            <?= isset($athlete['athlete_comment']) ? '<input type="text" name="athlete_comment[]" class="bg-transparent border-0 w-100 text-center" value="' . $athlete['athlete_comment'] . '" autocomplete="off" disabled>' :
                                                        '<input type="text" name="athlete_comment[]" class="bg-transparent border-0 w-100 text-center" value="' . $athlete['athlete_comment'] . '" autocomplete="off" disabled>'; ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</main>

<?php include('script.php'); ?>
<?php include('asset/footer.php'); ?>