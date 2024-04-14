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
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <button class="btn btn-primary" onclick="window.location.href='backend/download_excel.php'">ดาวน์โหลดตัวอย่าง
                                            Excel</button>
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_import_excel">Import Excel</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal_import_excel" tabindex="-1" aria-labelledby="modal_import_excel_label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="modal_import_excel_label">
                                                            นำเข้าข้อมูลจาก Excel
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" id="form_import_excel">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <input name="import_file" id="import_file" type="file" class="form-control" accept=".xlsx" style="height: auto !important">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" onclick="submit_form_import_excel()">ตกลง</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <form class=" form" method="GET">
                                            <div class="search_button d-flex  align-items-center rounded-3 px-3" style="background-color: rgb(242, 242, 242);box-shadow: 0 2px 3px 1px rgb(204, 204, 204);">
                                                <i class="bi bi-search"></i>
                                                <input type="text" name="search_athlete" placeholder="ค้าหาชื่อนักกีฬา.." class="border-0" autocomplete="off" style="outline: 0;background-color: transparent">
                                            </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="mt-4">
                                    <table class="table">
                                        <thead>
                                            <th>รายการ</th>
                                            <th>สโมสร</th>
                                            <th>จัดการ</th>
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
                                                        <td colspan="2" class="fw-bolder h3">
                                                            <?= $row['program_id'] . ' : ' . $row['program_name'] . ' ' . $row['program_age'] . ' ' . $row['program_sex']; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <form class="form" id="form_delete_program">
                                                                <input type="hidden" name="program_id" value="<?= $row['program_id'] ?>">
                                                            </form>
                                                            <button class="btn btn-danger rounded-circle"><i class="bi bi-trash3-fill"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <?php if (!in_array($row['athlete_name'], $select_athlete) && $row['athlete_name'] !== null) { ?>
                                                    <?php $select_athlete[] = $row['athlete_name']; ?>
                                                    <tr>
                                                        <td>
                                                            <?= $row['athlete_bib'] . ' : ' . $row['athlete_name']  ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?= $row['athlete_club'] ?></td>
                                                        <td class="text-center">
                                                            <form class="form" id="form_delete_athlete">
                                                                <input type="hidden" name="athlete_id" value="<?= $row['athlete_id'] ?>">
                                                            </form>
                                                            <button class="btn btn-danger rounded-circle"><i class="bi bi-trash3-fill"></i></button>
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
                            <form class="form">
                                <div class="p-4 rounded-4" style="background-color: #C3CACD;">
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
                                            <div class="form-group position-relative">
                                                <label class="" for="program_location">นักกีฬา</label>
                                                <div class="btn btn-success rounded-circle position-absolute top-0 end-0">
                                                    <i class="bi bi-plus-lg"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3 d-flex justify-content-center">
                                            <div class="form-group">
                                                <button class="btn btn-primary">เพิ่ม</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>
<script src="script/script.js"></script>
<?php include('asset/footer.php'); ?>