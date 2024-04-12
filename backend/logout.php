<!-- Sweetalert2 -->
<link rel="stylesheet" href="../css/font.css">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>

<?php
    session_start();
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['admin_username']);
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "ออกจากระบบสำเร็จ",
                    text: "Redirecting in 1 second",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location = "../index.html";
                });
            });
        </script>';
    }
?>