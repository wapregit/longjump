<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "longjump_competition";

$condb = mysqli_connect($server, $username, $password, $database);

if (!$condb) {
    die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้" . mysqli_connect_error());
}