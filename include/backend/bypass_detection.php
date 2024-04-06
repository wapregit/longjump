<?php
if (!isset($_SESSION['admin_username'])) {
    echo "<script>
    alert('คุณต้องลงชื่อเข้าใช้ก่อนถึงจะเข้าสู่หน้าเว็บได้!');
    window.location.href = 'index.html';
    </script>";
}