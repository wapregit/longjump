<?php
    session_start();
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['admin_username']);
        header('location: index.html');
    }
?>