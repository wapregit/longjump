<?php
session_start();
include('include/database/connect_database.php');
include('include/backend/sql_query.php');
include('include/asset/header.php');
include('include/asset/navbar.php');
?>

<link rel="stylesheet" href="include/css/body.css">

<main class="d-flex flex-column m-auto main-user py-4">
    <div class="div-select-program m-auto">
        <form class="form d-flex" id="form-select-program" method="post">
            <label for="select-program" class="form-label h4">เลือกรายการแข่งขัน</label>
            <select name="select-program" id="select-program" class="form-select form-select-lg">
                <option value='' disabled selected>เลือกรายการแข่งขัน</option>
                <?php foreach ($select_program as $select_program) { ?>
                <option value="<?= $select_program['program_id']; ?>"
                    <?php if (isset($_POST['select-program']) && $_POST['select-program'] == $select_program['program_id']) echo "selected"; ?>>
                    รายการที่
                    <?= $select_program['program_id'] . ' ' . $select_program['program_name'] . ' ' . $select_program['program_sex']; ?>
                </option>
                <?php } ?>
            </select>
        </form>
    </div>

    <?php if (isset($_POST['select-program']) && $_POST['select-program'] !== '') { ?>
    <div class="container-table m-auto">
        <div class="table-responsive table1">
            <table class="table table-header">
                <thead style="text-align: center">
                    <tr>
                        <th colspan="2">รายชื่อนักกีฬา</th>
                    </tr>
                    <?php foreach ($program as $program_table1) { ?>
                    <tr>
                        <th colspan="2"><?= $program_table1['program_title']; ?></th>
                    </tr>
                    <tr>
                        <th colspan="2"><?= $program_table1['program_location']; ?></th>
                    </tr>
                    <?php $program_date = date('d/m/Y', strtotime($program_table1['program_date'])); ?>
                    <tr>
                        <th colspan="2"><?= $program_date; ?></th>
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
            <table class="table">
                <thead style="text-align: center">
                    <tr>
                        <th rowspan="2">L/O</th>
                        <th rowspan="2">BIB</th>
                        <th rowspan="2">Athlete Name</th>
                        <th rowspan="2">Club</th>
                        <th colspan="3">Result</th>
                        <th rowspan="2">Best 3 times</th>
                        <th rowspan="2">New L/O</th>
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
                    <tr>
                        <td class="text-center">
                            <?= isset($athlete['athlete_order']) ? $athlete['athlete_order'] : 'N/A'; ?>
                        </td>
                        <td class="text-center">
                            <?= isset($athlete['athlete_bib']) ? $athlete['athlete_bib'] : 'N/A'; ?>
                        </td>
                        <td>
                            <?= isset($athlete['athlete_name']) ? $athlete['athlete_name'] : 'N/A N/A'; ?>
                        </td>
                        <td>
                            <?= isset($athlete['athlete_club']) ? $athlete['athlete_club'] : 'N/A'; ?>
                        </td>
                        <td class="text-center">
                            <?= isset($athlete['athlete_result_1']) ? $athlete['athlete_result_1'] : ''; ?>
                        </td>
                        <td class="text-center">
                            <?= isset($athlete['athlete_result_2']) ? $athlete['athlete_result_2'] : ''; ?>
                        </td>
                        <td class="text-center">
                            <?= isset($athlete['athlete_result_3']) ? $athlete['athlete_result_3'] : ''; ?>
                        </td>
                        <td class="text-center">
                            <?= $athlete['athlete_bo3'] == '0' ? '' : $athlete['athlete_bo3']; ?>
                        </td>
                        <td class="text-center">
                            <?= isset($athlete['athlete_new_order']) ? $athlete['athlete_new_order'] : ''; ?>
                        </td>
                        <td class="text-center">
                            <?= isset($athlete['athlete_result_4']) ? $athlete['athlete_result_4'] : ''; ?>
                        </td>
                        <td class="text-center">
                            <?= isset($athlete['athlete_result_5']) ? $athlete['athlete_result_5'] : ''; ?>
                        </td>
                        <td class="text-center">
                            <?= isset($athlete['athlete_result_6']) ? $athlete['athlete_result_6'] : ''; ?>
                        </td>
                        <td class="text-center">
                            <?= $athlete['athlete_record'] == '0' ? '' : $athlete['athlete_record']; ?>
                        </td>
                        <td class="text-center">
                            <?= isset($athlete['athlete_ranking']) ? $athlete['athlete_ranking'] : ''; ?>
                        </td>
                        <td class="text-center">
                            <?= isset($athlete['athlete_comment']) ? $athlete['athlete_comment'] : 'N/A'; ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php } ?>
</main>

</body>


<!-- Script -->
<script src="include\script\script.js"></script>