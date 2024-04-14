<!-- Sweetalert2 -->
<link rel="stylesheet" href="../css/font.css">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>

<?php
session_start();
include('../database/connect_database.php');


$errors = array();

if (isset($_POST['submit_login'])) {
    $admin_username  = mysqli_real_escape_string($condb, $_POST['username']);
    $admin_password  = mysqli_real_escape_string($condb, $_POST['password']);

    if (count($errors) == 0) {
        $admin_password = ($admin_password);
        $login_query = "SELECT * FROM `login` WHERE `login_user` = '$admin_username' 
            AND `login_password` = '$admin_password'";
        $login_result = mysqli_query($condb, $login_query);

        if (mysqli_num_rows($login_result) == 1) {
            $_SESSION['admin_username'] = $admin_username;
            $_SESSION['success'] = "คุณได้เข้าสู้ระบบ";
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "เข้าสู่ระบบสำเร็จ",
                    text: "Redirecting in 1 second",
                    showConfirmButton: false,
                    timer: 1500,
                    heightAuto: false
                }).then(function() {
                    window.location = "../home.php";
                });
            });
        </script>';
        } else {
            array_push($errors, "Wrong Username or Password!");
            $_SESSION['error'] = "ชื่อผู้ใช้หรือรหัสผ่านของคุณผิด!";
            session_write_close();
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "ชื่อผู้ใช้หรือรหัสผ่านของคุณผิด",
                    text: "Redirecting in 1 second",
                    showConfirmButton: false,
                    timer: 1500,
                    heightAuto: false
                }).then(function() {
                    window.location = "../sign_in.php";
                });
            });
        </script>';
        }
    }
} else {
    array_push($errors, "Wrong Username or Password!");
    $_SESSION['error'] = "ไม่สามารถลงชื่อเข้าสู่ระบบได้!";
    session_write_close();
    header("location: ../sign_in.php");
}