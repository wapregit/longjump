<?php
include('../database/connect_database.php');

// รับค่าจาก URL
$athleteId = $_GET['athlete_id'];
$value = $_GET['value'];
$id = $_GET['id'];

if ($id == 1) {
    // Update athlete_result_1
    $sql = "UPDATE competition_athlete SET athlete_result_1 = ? WHERE athlete_id = ?";
    $stmt = $condb->prepare($sql);
    $stmt->bind_param("si", $value, $athleteId); // "i" for integer

    if (!$stmt->execute()) {
        echo "Error executing statement: " . mysqli_error($condb);
        exit(); // Stop execution if there's an error
    } else {
        // Update successful, redirect to competition_result.php
        echo '<script>window.history.back();</script>';
        exit(); // Stop further execution after redirect
    }

    $stmt->close();
} else if ($id == 2) {
    // Update athlete_result_1
    $sql = "UPDATE competition_athlete SET athlete_result_2 = ? WHERE athlete_id = ?";
    $stmt = $condb->prepare($sql);
    $stmt->bind_param("si", $value, $athleteId); // "i" for integer

    if (!$stmt->execute()) {
        echo "Error executing statement: " . mysqli_error($condb);
        exit(); // Stop execution if there's an error
    } else {
        // Update successful, redirect to competition_result.php
        header('Location: ../competition_result.php');
        exit(); // Stop further execution after redirect
    }

    $stmt->close();
} else if ($id == 3) {
    // Update athlete_result_1
    $sql = "UPDATE competition_athlete SET athlete_result_3 = ? WHERE athlete_id = ?";
    $stmt = $condb->prepare($sql);
    $stmt->bind_param("si", $value, $athleteId); // "i" for integer

    if (!$stmt->execute()) {
        echo "Error executing statement: " . mysqli_error($condb);
        exit(); // Stop execution if there's an error
    } else {
        // Update successful, redirect to competition_result.php
        header('Location: ../competition_result.php');
        exit(); // Stop further execution after redirect
    }

    $stmt->close();
} else if ($id == 4) {
    // Update athlete_result_1
    $sql = "UPDATE competition_athlete SET athlete_result_4 = ? WHERE athlete_id = ?";
    $stmt = $condb->prepare($sql);
    $stmt->bind_param("si", $value, $athleteId); // "i" for integer

    if (!$stmt->execute()) {
        echo "Error executing statement: " . mysqli_error($condb);
        exit(); // Stop execution if there's an error
    } else {
        // Update successful, redirect to competition_result.php
        header('Location: ../competition_result.php');
        exit(); // Stop further execution after redirect
    }

    $stmt->close();
} else if ($id == 5) {
    // Update athlete_result_1
    $sql = "UPDATE competition_athlete SET athlete_result_5 = ? WHERE athlete_id = ?";
    $stmt = $condb->prepare($sql);
    $stmt->bind_param("si", $value, $athleteId); // "i" for integer

    if (!$stmt->execute()) {
        echo "Error executing statement: " . mysqli_error($condb);
        exit(); // Stop execution if there's an error
    } else {
        // Update successful, redirect to competition_result.php
        header('Location: ../competition_result.php');
        exit(); // Stop further execution after redirect
    }

    $stmt->close();
} else if ($id == 6) {
    // Update athlete_result_1
    $sql = "UPDATE competition_athlete SET athlete_result_6 = ? WHERE athlete_id = ?";
    $stmt = $condb->prepare($sql);
    $stmt->bind_param("si", $value, $athleteId); // "i" for integer

    if (!$stmt->execute()) {
        echo "Error executing statement: " . mysqli_error($condb);
        exit(); // Stop execution if there's an error
    } else {
        // Update successful, redirect to competition_result.php
        header('Location: ../competition_result.php');
        exit(); // Stop further execution after redirect
    }

    $stmt->close();
}
