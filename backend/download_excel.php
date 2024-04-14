<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// เปลี่ยนเป็นที่อยู่ของไฟล์ Excel ของคุณ
$existingFile = '../excel/Template_Competition_Longjump.xlsx';
date_default_timezone_set('Asia/Bangkok');


$filename = 'Template_Competition_Longjump_' . date('dmY_Hi') . '.xlsx'; // เพิ่มวันที่และเวลาให้กับชื่อไฟล์

// สร้างสเปรดชีทใหม่
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($existingFile);

// กำหนดการส่งออกไฟล์ Excel
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// ส่งออกไฟล์ Excel ที่ดาวน์โหลดได้
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');