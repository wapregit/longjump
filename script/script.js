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

function new_program_form() {
    // สร้าง div ใหม่สำหรับ program_form
    var new_program_form = document.createElement('div');
    new_program_form.classList.add('program_form', 'p-4', 'rounded-4', 'w-75', 'mt-3');
    new_program_form.style.backgroundColor = "#C3CACD";

    // คัดลอก HTML ของฟอร์ม program_form เข้าไปใน div ใหม่
    var program_form = document.querySelector('.program_form'); // เลือกตัวอย่าง div program_form แรก
    new_program_form.innerHTML = program_form.innerHTML;

    // อ่านจำนวน div ทั้งหมดที่มี class 'program_form' ใน form
    var nums_program_form = document.querySelectorAll('.program_form').length;

    // แก้ไขเลขรายการในแท็ก h5 ของ div ใหม่
    var new_h5 = new_program_form.querySelector('h5');
    new_h5.innerText = 'รายการ ' + (nums_program_form + 1);

    // เพิ่มฟอร์ม program_form ใหม่ลงใน form
    var form = document.getElementById('program_form');
    form.appendChild(new_program_form);
}


function delete_program_form() {
    var quizForm = document.querySelector('.formquiz form');
    var new_program_form = quizForm.querySelectorAll('.groupquestions');

    // ถ้ามีฟอร์มมากกว่า 1 ให้ลบฟอร์มล่าสุด
    if (groupQuestions.length > 1) {
        var lastGroupQuestion = groupQuestions[groupQuestions.length - 1];
        quizForm.removeChild(lastGroupQuestion);
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
