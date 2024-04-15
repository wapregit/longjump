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

<body>
    <main style="background-color: #D9E1E4">
        <div class="py-5">
            <div class="row mx-0">
                <div class="col-12">
                    <div class="card py-3 px-4 m-auto rounded-4" style="width: 90%">
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
                                <select name="select_program" id="select_program" class="form-select form-select-lg">
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
                            <div class="edit h-100 position-absolute" id="edit" onclick="edit_score_athlete()">
                                <div class="input-group">
                                    <button class="rounded-start btn-edit">แก้ไข</button>
                                    <div class="input-group-append">
                                        <span class="input-group-text span-edit"
                                            style="border-top-left-radius: 0; border-bottom-left-radius: 0;"><i
                                                class="bi bi-pencil-square"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="save h-100 position-absolute" id="save" style="display:none;">
                                <div class="input-group">
                                    <button class="rounded-start btn-save">บันทึก</button>
                                    <div class="input-group-append">
                                        <span class="input-group-text span-save"
                                            style="border-top-left-radius: 0; border-bottom-left-radius: 0;"><i
                                                class="bi bi-save2"></i></span>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php if (isset($_GET['select_program']) && $_GET['select_program'] !== '') { ?>
                <div class="col-12 mt-4">
                    <div class="container-table p-4 m-auto rounded-4" style="background-color: #C3CACD;width: 90%">
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
                                    <?php foreach ($athlete as $athlete) { ?>
                                    <tr class="table-row">
                                        <td class="table-data text-center">
                                            <?= isset($athlete['athlete_order']) ? $athlete['athlete_order'] : 'N/A'; ?>
                                        </td>
                                        <td class="table-data text-center">
                                            <?= isset($athlete['athlete_bib']) ? $athlete['athlete_bib'] : 'N/A'; ?>
                                        </td>
                                        <td class="table-data">
                                            <?= isset($athlete['athlete_name']) ? $athlete['athlete_name'] : 'N/A N/A'; ?>
                                        </td>
                                        <td class="table-data">
                                            <?= isset($athlete['athlete_club']) ? $athlete['athlete_club'] : 'N/A'; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_1']) ? $athlete['athlete_result_1'] : '<a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . $row["value"] . '&id=1&program_id=' . $athlete['program_id'] . '"><button class="btn btn-success" style="width: 3vw">บันทึก</button></a> <a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . '-' . '&id=1&program_id=' . $athlete['program_id'] . '"><button class="btn btn-danger" style="width: 3vw">ขาด</button></a>'; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_2']) ? $athlete['athlete_result_2'] : '<a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . $row["value"] . '&id=2&program_id=' . $athlete['program_id'] . '"><button class="btn btn-success" style="width: 3vw">บันทึก</button></a> <a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . '-' . '&id=2&program_id=' . $athlete['program_id'] . '"><button class="btn btn-danger" style="width: 3vw">ขาด</button></a>'; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_3']) ? $athlete['athlete_result_3'] : '<a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . $row["value"] . '&id=3&program_id=' . $athlete['program_id'] . '"><button class="btn btn-success" style="width: 3vw">บันทึก</button></a> <a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . '-' . '&id=3&program_id=' . $athlete['program_id'] . '""><button class="btn btn-danger" style="width: 3vw">ขาด</button></a>'; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= $athlete['athlete_bo3'] == '0' ? '' : $athlete['athlete_bo3']; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_4']) ? $athlete['athlete_result_4'] : '<a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . $row["value"] . '&id=4&program_id=' . $athlete['program_id'] . '"><button class="btn btn-success" style="width: 3vw">บันทึก</button></a> <a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . '-' . '&id=4&program_id=' . $athlete['program_id'] . '"><button class="btn btn-danger" style="width: 3vw">ขาด</button></a>'; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_5']) ? $athlete['athlete_result_5'] : '<a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . $row["value"] . '&id=5&program_id=' . $athlete['program_id'] . '"><button class="btn btn-success" style="width: 3vw">บันทึก</button></a> <a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . '-' . '&id=5&program_id=' . $athlete['program_id'] . '"><button class="btn btn-danger" style="width: 3vw">ขาด</button></a>'; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_6']) ? $athlete['athlete_result_6'] : '<a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . $row["value"] . '&id=6&program_id=' . $athlete['program_id'] . '"><button class="btn btn-success" style="width: 3vw">บันทึก</button></a> <a href="backend/insert_data.php?athlete_id=' . $athlete['athlete_id'] . '&value=' . '-' . '&id=6&program_id=' . $athlete['program_id'] . '"><button class="btn btn-danger" style="width: 3vw">ขาด</button></a>'; ?>
                                        </td>
                                        <td class="table-data text-center">
                                            <?= $athlete['athlete_record'] == '0' ? '' : $athlete['athlete_record']; ?>
                                        </td>
                                        <td class="table-data text-center">
                                            <?= isset($athlete['athlete_ranking']) ? $athlete['athlete_ranking'] : ''; ?>
                                        </td>
                                        <td class="table-data text-center">
                                            <?= isset($athlete['athlete_comment']) ? $athlete['athlete_comment'] : 'N/A'; ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
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