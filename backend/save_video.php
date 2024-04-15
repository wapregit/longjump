<?php
include('../database/connect_database.php');

// ตรวจสอบว่ามีการส่งไฟล์ขึ้นมาหรือไม่
if(isset($_FILES['video'])) {
    $file = $_FILES['video'];

    // ตรวจสอบว่ามีข้อผิดพลาดในการอัปโหลดหรือไม่
    if($file['error'] === UPLOAD_ERR_OK) {
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];

        // ระบุโฟลเดอร์ที่ต้องการบันทึกไฟล์
        $uploadPath = '../videos/' . $fileName;

        // ย้ายไฟล์ไปยังโฟลเดอร์ที่ต้องการ
        if(move_uploaded_file($fileTmpName, $uploadPath)) {
            // ใช้ Prepared Statements เพื่อป้องกัน SQL Injection
            $sql = "INSERT INTO competition_record (record_path, record_date) VALUES (?, NOW())";
            $stmt = $condb->prepare($sql);
            $stmt->bind_param("s", $fileName);
            if ($stmt->execute()) {
                // บันทึกไฟล์สำเร็จ
                http_response_code(200);
            } else {
                // บันทึกไฟล์ไม่สำเร็จ
                http_response_code(500);
            }
        } else {
            // บันทึกไฟล์ไม่สำเร็จ
            http_response_code(500);
        }
    } else {
        // ข้อผิดพลาดในการอัปโหลด
        http_response_code(500);
    }
} else {
    // ไม่มีไฟล์ที่อัปโหลด
    http_response_code(400);
}
?>