<?php
session_start();
include('database/connect_database.php');
include('backend/bypass_detection.php');
include('backend/sql_select.php');
include('asset/header.php');
include('asset/navbar.php');
?>

<main style="background-color: #D9E1E4">
    <div class="py-5 m-auto" style="width: 90%">
        <div class="row mx-0">
            <div class="col-12">
                <div class="card py-3 px-4 m-auto rounded-4">
                    <div class="page-header w-100 m-auto py-4">
                        <h1>จัดการนักกีฬา</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="row">
                    <div class="col-8">
                        <div class="card py-3 px-4 m-auto rounded-3">
                            <div class="w-100">
                                <div class="d-flex align-items-center justify-content-end">
                                    <form class=" form" method="GET">
                                        <div class="search_button d-flex  align-items-center rounded-3 px-3"
                                            style="background-color: rgb(242, 242, 242);box-shadow: 0 2px 3px 1px rgb(204, 204, 204);">
                                            <i class="bi bi-search"></i>
                                            <input type="text" name="search_athlete" placeholder="ค้าหาชื่อนักกีฬา.."
                                                class="border-0 bg-transparent" autocomplete="off" style="outline: 0;">
                                        </div>
                                    </form>
                                </div>
                                <div class="mt-4">
                                    <table class="table table-show-data">
                                        <thead>
                                            <th class="fw-bolder">รายการ</th>
                                            <th class="fw-bolder">สโมสร</th>
                                            <th class="fw-bolder">จัดการ</th>
                                        </thead>
                                        <tbody>
                                            <?php $current_program_id = null; ?>
                                            <?php foreach ($select_all as $row) { ?>
                                            <?php if ($row['program_id'] !== $current_program_id) { ?>
                                            <?php if ($current_program_id !== null) { ?>
                                            </tr>
                                            <?php } ?>
                                            <?php $current_program_id = $row['program_id']; ?>
                                            <tr>
                                                <td colspan="2" class="fw-bolder h3 td-program">
                                                    <?= $row['program_id'] . ' : ' . $row['program_name'] . ' ' . (is_numeric($row['program_age']) ? $row['program_age'] . " ปี" : $row['program_age']) . ' ' . $row['program_sex']; ?>
                                                </td>
                                                <td class="text-center td-program">
                                                    <form class="form"
                                                        id="form_delete_program_<?= $row['program_id'] ?>">
                                                        <input type="hidden" name="delete_program_id"
                                                            value="<?= $row['program_id'] ?>">
                                                    </form>
                                                    <button class="btn btn-danger rounded-circle"
                                                        onclick="submit_form_delete('form_delete_program_<?= $row['program_id'] ?>')"><i
                                                            class="bi bi-trash3-fill"></i></button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php if (!in_array($row['athlete_name'], $select_athlete) && $row['athlete_name'] !== null) { ?>
                                            <?php $select_athlete[] = $row['athlete_name']; ?>
                                            <tr>
                                                <td class="td-athlete">
                                                    <div class="form-group d-flex justify-content-start gap-2">
                                                        <form action="backend\sql_update.php" class="form"
                                                            id="form_update_bib" method="POST" style="width: 10%">
                                                            <input type="hidden" name="athlete_id"
                                                                value="<?= $row['athlete_id'] ?>">
                                                            <input class="border-0 h-auto w-100 bg-transparent"
                                                                type="text" name="update_athlete_bib"
                                                                id="update_athlete_bib"
                                                                value="<?= $row['athlete_bib'] ?>" style="outline: 0">
                                                        </form>
                                                        :
                                                        <form action="backend\sql_update.php" class="form"
                                                            id="form_update_name" method="POST">
                                                            <input type="hidden" name="athlete_id"
                                                                value="<?= $row['athlete_id'] ?>">
                                                            <input class="border-0 h-auto w-100 bg-transparent"
                                                                type="text" name="update_athlete_name"
                                                                id="update_athlete_name"
                                                                value="<?= $row['athlete_name'] ?>" style="outline: 0">
                                                        </form>
                                                    </div>
                                                </td>
                                                <td class="td-athlete">
                                                    <form action="backend\sql_update.php" class="form"
                                                        id="form_update_club" method="POST">
                                                        <input type="hidden" name="athlete_id"
                                                            value="<?= $row['athlete_id'] ?>">
                                                        <input class="border-0 h-auto w-100 bg-transparent text-center"
                                                            type="text" name="update_athlete_club"
                                                            id="update_athlete_club" value="<?= $row['athlete_club'] ?>"
                                                            style="outline: 0">
                                                    </form>
                                                </td>
                                                <td class=" text-center td-athlete">
                                                    <form class="form"
                                                        id="<?= 'form_delete_athlete_' . $row['athlete_id'] ?>">
                                                        <input type="hidden" name="delete_athlete_id"
                                                            value="<?= $row['athlete_id'] ?>">
                                                    </form>
                                                    <button class="btn btn-danger rounded-circle"><i
                                                            class="bi bi-trash3-fill"
                                                            onclick="submit_form_delete('form_delete_athlete_<?= $row['athlete_id'] ?>')"></i></button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php } ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card py-3 px-4 m-auto rounded-3">
                            <div class="p-4 rounded-4" style="background-color: #C3CACD;">
                                <form class="form" method="POST" id="form_insert_athlete">
                                    <h1>เพิ่มนักกีฬาในรายการแข่งขัน</h1>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label class="w-100" for="program_title">รายการ</label>
                                                <select class="form-select" name="program_id">
                                                    <option selected disabled>เลือกรายการ</option>
                                                    <?php foreach ($select_program as $row_program) { ?>
                                                    <option value="<?= $row_program['program_id'] ?>">
                                                        <?= $row_program['program_id'] . ' : ' . $row_program['program_name'] ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="add_athlete form-group position-relative">
                                                <label class="" for="program_location">นักกีฬา</label>
                                                <div class="btn btn-success rounded-circle position-absolute top-0 end-0"
                                                    onclick="add_athlete_2(this)">
                                                    <i class="bi bi-plus-lg"></i>
                                                </div>
                                                <table class="table_add_athlete table mt-3" id="table"
                                                    style="display: none;">
                                                    <thead>
                                                        <th></th>
                                                        <th class="fw-bolder">BIB</th>
                                                        <th class="fw-bolder">ชื่อนักกีฬา</th>
                                                        <th class="fw-bolder">สโมสร</th>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-12 mb-3 d-flex justify-content-center">
                                    <div class="form-group">
                                        <button class="btn btn-primary"
                                            onclick="submit_form_insert_athlete()">เพิ่ม</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('script.php'); ?>
<?php include('asset/footer.php'); ?>