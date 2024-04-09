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
    // สร้าง div ใหม่สำหรับ groupquestions
    var new_program_form_div = document.createElement('div');
    new_program_form_div.classList.add('program_form_group');

    // คัดลอก HTML ของฟอร์ม groupquestions เข้าไปใน div ใหม่
    var program_form_div = document.querySelector('.program_form .program_form_group');
    new_program_form_div.innerHTML = program_form_div.innerHTML;

    // เพิ่มฟอร์ม groupquestions ใหม่ลงใน form ที่มี ID เท่ากับ "quizForm"
    var program_form = document.querySelector('.program_form form');
    program_form.appendChild(new_program_form_div);
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
