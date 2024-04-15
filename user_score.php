<?php
session_start();
include('database/connect_database.php');
include('backend/sql_select.php');
include('asset/header.php');
include('asset/navbar.php');
?>

<body>
    <main style="background-color: #D9E1E4">
        <div class="py-5">
            <div class="row mx-0">
                <div class="col-12">
                    <div class="card py-3 px-4 m-auto rounded-4" style="width: 90%">
                        <div class="div-select-program w-100 m-auto py-4 position-relative">
                            <form class="form" id="form_select_program" method="POST">
                                <label for="select_program" class="form-label h4">เลือกรายการแข่งขัน</label>
                                <hr>
                                <select name="select_program" id="select_program" class="form-select form-select-lg">
                                    <option value='' disabled selected>เลือกรายการแข่งขัน</option>
                                    <?php foreach ($select_program as $select_program) { ?>
                                    <option value="<?= $select_program['program_id']; ?>"
                                        <?php if (isset($_POST['select_program']) && $_POST['select_program'] == $select_program['program_id']) echo "selected"; ?>>
                                        รายการที่
                                        <?= $select_program['program_id'] . ' ' . $select_program['program_name'] . ' ' . $select_program['program_age'] . ' ' .  $select_program['program_sex']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <?php if (isset($_POST['select_program']) && $_POST['select_program'] !== '') { ?>
                <div class="col-12 mt-4">
                    <div class="container-table p-4 m-auto rounded-4" style="background-color: #C3CACD;width: 90%">
                        <div class="table-responsive table1">
                            <table class="table table-header">
                                <thead style="text-align: center">
                                    <tr>
                                        <th class="fw-bolder">รายชื่อนักกีฬา</th>
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
                                <thead style="text-align: center">
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
                                            <?= isset($athlete['athlete_result_1']) ? $athlete['athlete_result_1'] : ''; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_2']) ? $athlete['athlete_result_2'] : ''; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_3']) ? $athlete['athlete_result_3'] : ''; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= $athlete['athlete_bo3'] == '0' ? '' : $athlete['athlete_bo3']; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_4']) ? $athlete['athlete_result_4'] : ''; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_5']) ? $athlete['athlete_result_5'] : ''; ?>
                                        </td>
                                        <td class="table-data text-center result">
                                            <?= isset($athlete['athlete_result_6']) ? $athlete['athlete_result_6'] : ''; ?>
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