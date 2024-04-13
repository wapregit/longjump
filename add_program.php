<?php
session_start();
include('backend/bypass_detection.php');
include('asset/header.php');
include('asset/navbar.php');
?>

<link rel="stylesheet" href="css/body.css">

<main style="background-color: #D9E1E4">
    <div class="button-sidebar d-flex flex-column gap-2 position-fixed" style="top:9%; right: 8%;">
        <button class="btn btn-success" id="button_save_program_form" onclick="save_program_form()"
            title="บันทึกข้อมูล"><i class="bi bi-floppy-fill"></i></button>
        <button class="btn btn-primary" id="button_add_program_form" onclick="new_program_form()" title="เพิ่มรายการ"><i
                class="bi bi-plus-circle-fill"></i></button>
        <button class="btn btn-danger" id="button_delete_program_form" onclick="delete_program_form()"
            title="ลบรายการล่าสุด"><i class="bi bi-trash3-fill"></i></button>
    </div>

    <form class="form d-flex flex-column align-items-center py-5" id="program_form" method="post">
        <div class="p-4 rounded-4 w-75" style="background-color: #C3CACD;">
            <h1>เพิ่มรายการแข่งขัน</h1>
            <hr>
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="form-group">
                        <label class="w-100" for="program_title">ชื่อรายการแข่งขัน</label>
                        <small id="program_titleHelp" class="form-text text-muted">ตัวอย่าง:
                            การแข่งขันมหกรรมกรีฑาชิงแชมป์
                            "นักเรียน นักศึกษา และอาจารย์" สาขาวิศวกรรมคอมพิวเตอร์ ปี 2567</small>
                        <input class="form-control" type="text" name="program_title" id="program_title"
                            autocomplete="off" required>
                        <span id="search_result"></span>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="form-group">
                        <label class="w-100" for="program_location">สถานที่แข่งขัน</label>
                        <small id="program_locationHelp" class="form-text text-muted">ตัวอย่าง:
                            สาขาวิศวกรรมคอมพิวเตอร์</small>
                        <input class="form-control" type="text" name="program_location" id="program_location"
                            autocomplete="off" required>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="form-group">
                        <label for="" class="w-100">วันที่แข่งขัน</label>
                        <input class="form-control" type="date" name="program_date" id="program_date" autocomplete="off"
                            required>
                    </div>
                </div>
            </div>
        </div>

        <div class="program_form p-4 rounded-4 w-75 mt-3" style="background-color: #C3CACD;">
            <h5>รายการ 1</h5>
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="w-100" for="program_id">เลขรายการแข่งขัน</label>
                                <small id="program_idHelp" class="form-text text-muted">ตัวอย่าง:
                                    101, 101/1 etc.</small>
                                <input class="form-control" type="text" name="program_id[]" id="program_id"
                                    autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="w-100" for="program_name">ประเภทการแข่งขัน</label>
                                <small id="program_nameHelp" class="form-text text-muted">ตัวอย่าง:
                                    กระโดดไกล</small>
                                <input type="text" class="form-control" name="program_name[]" id="program_name"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="w-100" for="program_sex">เพศ</label>
                                <small id="program_sexHelp" class="form-text text-muted">ตัวอย่าง:
                                    ชาย</small>
                                <select class="form-select" name="program_sex[]" id="program_sex" autocomplete="off"
                                    required>
                                    <option selected disabled>เลือกเพศ</option>
                                    <option value="ชาย">ชาย</option>
                                    <option value="หญิง">หญิง</option>
                                    <option value="ผสม">ผสม</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="w-100" for="program_age">ช่วงอายุ</label>
                                <small id="program_ageHelp" class="form-text text-muted">ตัวอย่าง:
                                    14 (ไม่ต้องระบุปี)</small>
                                <input type="text" class="form-control" name="program_age[]" id="program_age"
                                    autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="w-100" for="program_round">รอบการแข่งขัน</label>
                                <small id="program_roundHelp" class="form-text text-muted">ตัวอย่าง:
                                    คัดเลือก, ชิงชนะเลิศ</small>
                                <select class="form-select" name="program_round[]" id="program_round" autocomplete="off"
                                    required>
                                    <option selected disabled>เลือกรอบการแข่งขัน</option>
                                    <option value="คัดเลือก">คัดเลือก</option>
                                    <option value="ชิงชนะเลิศ">ชิงชนะเลิศ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="w-100" for="program_time">เวลาแข่งขัน</label>
                                <small id="program_ageHelp" class="form-text text-muted">AM: ช่วงเช้า, PM:
                                    ช่วงบ่าย
                                </small>
                                <input type="time" class="form-control" name="program_time[]" id="program_time"
                                    autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn btn-success" id="button_add_athlete" onclick="add_athlete(this)">เพิ่มนักกีฬา</div>
            <table class="table_add_athlete table mt-3" id="table_add_athlete" style="display: none;">
                <thead>
                    <tr>
                        <th></th>
                        <th class="fw-bolder">BIB</th>
                        <th class="fw-bolder">ชื่อนักกีฬา</th>
                        <th class="fw-bolder">Club</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>
<script src="script/script.js"></script>
<?php include('asset/footer.php'); ?>