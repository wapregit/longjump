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
                        <h1>รายการวิดีโอย้อนหลัง</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="card py-3 px-4 m-auto rounded-3">
                    <div class="w-100">
                        <div class="mt-4">
                            <table class="table table-video">
                                <thead>
                                    <th class="fw-bolder">วัน / เวลาที่อัปโหลด
                                    </th>
                                    <th class="fw-bolder">ชื่อวิดีโอ</th>
                                    <th class="fw-bolder">เล่น</th>
                                    <th class="fw-bolder">ลบ</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($select_video as $row) { ?>
                                    <tr>
                                        <td class="text-center"><?= $row['record_date'] ?></td>
                                        <td class="text-center"><?= $row['record_path'] ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-primary rounded-circle" data-bs-toggle="modal"
                                                data-bs-target="#modal_video"
                                                onclick="playVideo('videos/<?= $row['record_path'] ?>')">
                                                <i class="bi bi-play-circle-fill"></i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <form class="form" id="form_delete_video" method="POST">
                                                <input type="hidden" name="record_id" value="<?= $row['record_id'] ?>">
                                            </form>
                                            <button class="btn btn-danger rounded-circle" onclick="deleteVideo()"><i
                                                    class="bi bi-trash3-fill"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="modal_video" tabindex="-1" aria-labelledby="modal_video_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_video_label">
                    วิดีโอย้อนหลัง
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_import_excel" enctype="multipart/form-data">
                    <div class="col-12">
                        <div class="form-group d-flex justify-content-center">
                            <video id="videoPlayer" controls style="display: none;">
                                <source src="" type="video/webm">
                            </video>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<?php include('script.php'); ?>
<?php include('asset/footer.php'); ?>