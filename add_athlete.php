<?php
session_start();
include('include/backend/bypass_detection.php');
include('include/database/connect_database.php');
include('include/backend/sql_query.php');
include('include/asset/header.php');
include('include/asset/navbar.php'); 
?>

<link rel="stylesheet" href="include/css/body.css">

<main style="background-color: #D9E1E4">
    <button class="btn btn-success position-fixed end-0" id="button_add_program_form" onclick="new_program_form()"><i
            class="bi bi-plus-circle-fill"></i></button>
    <div id="form_container" class="d-flex flex-column align-items-center py-5">
        <form class="form p-4 rounded-4 w-75" style="background-color: #C3CACD;" method="post">
            <h1>เพิ่มรายการแข่งขัน
            </h1>
            <hr>
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="form-group">
                        <label class="w-100" for="program_title">ชื่อรายการแข่งขัน</label>
                        <small id="program_titleHelp" class="form-text text-muted">ตัวอย่าง:
                            การแข่งขันมหกรรมกรีฑาชิงแชมป์
                            "นักเรียน นักศึกษา และอาจารย์" สาขาวิศวกรรมคอมพิวเตอร์ ปี 2567</small>
                        <input class="form-control" type="text" name="program_title" id="program_title" required>
                        <span id="search_result"></span>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="form-group">
                        <label class="w-100" for="program_location">สถานที่แข่งขัน</label>
                        <small id="program_locationHelp" class="form-text text-muted">ตัวอย่าง:
                            สาขาวิศวกรรมคอมพิวเตอร์</small>
                        <input class="form-control" type="text" name="program_location" id="program_location" required>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="form-group">
                        <label for="" class="w-100">วันที่แข่งขัน</label>
                        <input class="form-control" type="date" name="program_date" id="program_date" required>
                    </div>
                </div>
            </div>
        </form>

        <div id="program_form" class="program_form w-75 mt-3">
            <h5>รายการ 1</h5>
            <form class="form p-4 rounded-4" style="background-color: #C3CACD;" method="post">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="w-100" for="program_id">เลขรายการแข่งขัน</label>
                                    <small id="program_idHelp" class="form-text text-muted">ตัวอย่าง:
                                        101, 101/1 etc.</small>
                                    <input class="form-control" type="text" name="program_id" id="program_id" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="w-100" for="program_name">ประเภทการแข่งขัน</label>
                                    <small id="program_nameHelp" class="form-text text-muted">ตัวอย่าง:
                                        กระโดดไกล</small>
                                    <input type="text" class="form-control" name="program_name" id="program_name"
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
                                    <select class="form-select" name="program_sex" id="program_sex" required>
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
                                    <input type="text" class="form-control" name="program_age" id="program_age"
                                        required>
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
                                    <select class="form-select" name="program_round" id="program_round" required>
                                        <option selected disabled>เลือกรอบการแข่งขัน</option>
                                        <option value="คัดเลือก">ชาย</option>
                                        <option value="ชิงชนะเลิศ">หญิง</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="w-100" for="program_time">เวลาแข่งขัน</label>
                                    <small id="program_ageHelp" class="form-text text-muted">ตัวอย่าง:
                                        14 (ไม่ต้องระบุปี)</small>
                                    <input type="time" class="form-control" name="program_time" id="program_time"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>
<script src="include/script/script.js"></script>
<?php include('include/asset/footer.php'); ?>