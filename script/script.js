var select_program = document.getElementById("select-program");
var form = document.getElementById("form-select-program");
select_program.addEventListener("change", function () {
    // Get reference to the form
    form.submit();
});

jQuery(document).ready(function ($) {
    "use strict";
    $(".table3 tr").on("mouseover", function () {
        $(this).find("td").css("background-color", "#9999");
    });

    $(".table3 tr").on("mouseout", function () {
        $(this).find("td").css("background-color", "");
    });
});

function save_program_form() {
    // ตรวจสอบว่าฟอร์มถูกกรอกครบหรือไม่
    let program_title = document.getElementById("program_title").value;
    let program_location = document.getElementById("program_location").value;
    let program_date = document.getElementById("program_date").value;
    if (
        program_title === "" ||
        program_location === "" ||
        program_date === ""
    ) {
        // แสดงข้อความแจ้งเตือนถ้าฟอร์มไม่ครบ
        Swal.fire({
            title: "กรุณากรอกข้อมูลให้ครบถ้วน",
            icon: "error",
            confirmButtonColor: "#1c7348",
            confirmButtonText: "ตกลง",
        });
        return;
    }

    // ถ้าฟอร์มถูกกรอกครบแล้ว ให้แสดงคำถามยืนยัน
    Swal.fire({
        title: "ยืนยันเพิ่มรายการแข่งขัน?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#1c7348",
        cancelButtonColor: "#b72e3c",
        confirmButtonText: "ตกลง",
        cancelButtonText: "ยกเลิก",
    }).then((result) => {
        if (result.isConfirmed) {
            // ถ้ายืนยัน ส่งฟอร์มไปยัง backend/select_athlete.php
            let form = document.getElementById("program_form");
            form.action = "backend/insert_program.php";
            form.method = "POST";
            form.submit();
        }
    });
}

function new_program_form() {
    // สร้าง div ใหม่สำหรับ program_form
    var new_program_form = document.createElement("div");
    new_program_form.classList.add(
        "program_form",
        "p-4",
        "rounded-4",
        "w-75",
        "mt-3"
    );
    new_program_form.style.backgroundColor = "#C3CACD";

    // คัดลอก HTML ของฟอร์ม program_form เข้าไปใน div ใหม่
    var program_form = document.querySelector(".program_form"); // เลือกตัวอย่าง div program_form แรก
    new_program_form.innerHTML = program_form.innerHTML;

    // ลบ tbody tr ที่มี class="athlete" ออกจาก div ใหม่
    var new_table = new_program_form.querySelector(".table_add_athlete tbody");
    new_table.innerHTML = "";

    // อ่านจำนวน div ทั้งหมดที่มี class 'program_form' ใน form
    var nums_program_form = document.querySelectorAll(".program_form").length;

    // แก้ไขเลขรายการในแท็ก h5 ของ div ใหม่
    var new_h5 = new_program_form.querySelector("h5");
    new_h5.innerText = "รายการ " + (nums_program_form + 1);

    // เพิ่มฟอร์ม program_form ใหม่ลงใน form
    var form = document.getElementById("program_form");
    form.appendChild(new_program_form);

    // หาตารางของรายการใหม่
    var new_table = new_program_form.querySelector(".table_add_athlete");
    // ถ้าเป็นรายการที่ 2 ให้ซ่อนตาราง
    if (nums_program_form >= 1) {
        new_table.style.display = "none";
    }

    // เพิ่มการเชื่อมโยงฟังก์ชัน add_athlete() กับปุ่ม "เพิ่มนักกีฬา" ของ div ใหม่
    var button_add_athlete = new_program_form.querySelector(
        "#button_add_athlete"
    );
    button_add_athlete.setAttribute("onclick", "add_athlete(this)");
}

function delete_program_form() {
    var program_forms = document.querySelectorAll(".program_form");

    // ถ้ามีฟอร์มมากกว่า 1 ให้ลบฟอร์มล่าสุด
    if (program_forms.length > 1) {
        var delete_program_form = program_forms[program_forms.length - 1];
        delete_program_form.parentNode.removeChild(delete_program_form);
    }
}

function add_athlete(button) {
    // หา div program_form ที่ใกล้ที่สุดโดยใช้ closest()
    var program_form = button.closest(".program_form");

    // หาตารางภายใน div program_form
    var table = program_form.querySelector(".table_add_athlete tbody");

    program_form.querySelector(".table_add_athlete").style.display = "";

    // สร้างแถวใหม่
    var row = table.insertRow(-1); // -1 หมายถึงให้แถวใหม่ถูกเพิ่มที่ตำแหน่งสุดท้าย

    // เพิ่ม class ให้แถวใหม่
    row.classList.add("athlete");

    // เพิ่มเซลล์ในแถวใหม่
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);

    cell1.classList.add("text-center", "text-danger", "h3");
    cell2.style.width = "10%";

    // เพิ่มองค์ประกอบของ input ในเซลล์แต่ละเซลล์
    cell1.innerHTML =
        '<i class="bi bi-trash3-fill" onclick="remove_athlete(this)"></i>';
    cell2.innerHTML =
        '<input type="text" class="form-control" name="athlete_bib[]" id="athlete_bib" autocomplete="off" required>';
    cell3.innerHTML =
        '<input type="text" class="form-control" name="athlete_name[]" id="athlete_name" autocomplete="off" required>';
    cell4.innerHTML =
        '<input type="text" class="form-control" name="athlete_club[]" id="athlete_club" autocomplete="off" required>';
}

function remove_athlete(button) {
    var program_form = button.closest(".program_form");
    var table = program_form.querySelector("#table_add_athlete");
    var tbody = table.querySelector("tbody");
    var athlete_row = tbody.querySelectorAll(".athlete");
    // ตรวจสอบว่ายังมีแถวที่มี class "athlete" อยู่ใน tbody หรือไม่
    if (athlete_row.length === 1) {
        var row = button.closest("tr"); // หาแถวที่ปุ่มถูกคลิก
        row.remove(); // ลบแถว
        table.style.display = "none";
    }else if (athlete_row.length > 0) {
        var row = button.closest("tr"); // หาแถวที่ปุ่มถูกคลิก
        row.remove(); // ลบแถว
    }
}

function edit_score_athlete() {
    let edit_button = document.getElementById("edit");
    let save_button = document.getElementById("save");

    save_button.style.display = "";
    edit_button.style.display = "none";
}

function format_date(newdate) {
    let thai_months = [
        "มกราคม",
        "กุมภาพันธ์",
        "มีนาคม",
        "เมษายน",
        "พฤษภาคม",
        "มิถุนายน",
        "กรกฎาคม",
        "สิงหาคม",
        "กันยายน",
        "ตุลาคม",
        "พฤศจิกายน",
        "ธันวาคม",
    ];

    let thai_year = newdate.getFullYear() + 543;
    let thai_month = thai_months[newdate.getMonth()];
    let thai_day = newdate.getDate();

    return "วันที่ " + thai_day + " " + thai_month + " " + thai_year;
}
