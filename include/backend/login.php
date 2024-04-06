<?php
session_start();
include('../database/connect_database.php');

$errors = array();

if (isset($_POST['submit_login'])) {
    $admin_username  = mysqli_real_escape_string($condb, $_POST['username']);
    $admin_password  = mysqli_real_escape_string($condb, $_POST['password']);

    if (count($errors) == 0) {
        $admin_password = ($admin_password);
        $query = "SELECT * FROM `login` WHERE `login_user` = '$admin_username' 
            AND `login_password` = '$admin_password'";
        $result = mysqli_query($condb, $query);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['admin_username'] = $admin_username;
            $_SESSION['success'] = "คุณได้เข้าสู้ระบบ";
            header("location: ../../Home.php");
        } else {
            array_push($errors, "Wrong Username or Password!");
            $_SESSION['error'] = "ชื่อผู้ใช้หรือรหัสผ่านของคุณผิด!";
            session_write_close();
            header("location: ../../sign_in.php");
        }
    }
} else {
    array_push($errors, "Wrong Username or Password!");
    $_SESSION['error'] = "ไม่สามารถลงชื่อเข้าสู่ระบบได้!";
    session_write_close();
    header("location: ../../sign_in.php");
}