var selectElement = document.getElementById("select-program");
selectElement.addEventListener("change", function () {
    // Get reference to the form
    var form = document.getElementById("form-select-program");
    form.submit();
});

function format_date(date) {
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

    let thai_year = date.getFullYear() + 543;
    let thai_month = thai_months[date.getMonth()];
    let thai_day = date.getDate();

    return "วันที่ " + thai_day + " " + thai_month + " " + thai_year;
}
