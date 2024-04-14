<?php
//ดึงข้อมูลจากตาราง competition_program
$sql_select_program = "SELECT * FROM competition_program;";
$query_select_program = $condb->query($sql_select_program);
$select_program = array();
while ($row_program = $query_select_program->fetch_assoc()) {
    $select_program[] = $row_program;
}

if (isset($_POST['select_program'])) {
    $program_id = $_POST['select_program'];

    //ดึงข้อมูลจากตาราง competition_program
    $sql_select_program_2 = "SELECT * FROM competition_program WHERE program_id = '$program_id';";
    $query_select_program_2 = $condb->query($sql_select_program_2);
    $program = array();
    while ($row_program_2 = $query_select_program_2->fetch_assoc()) {
        $program[] = $row_program_2;
    }

    //ดึงข้อมูลจากตาราง competition_athlete
    $sql_select_athlete = "SELECT * FROM competition_athlete WHERE program_id = '$program_id';";
    $query_select_athlete = $condb->query($sql_select_athlete);
    $athlete = array();
    while ($row_athlete = $query_select_athlete->fetch_assoc()) {
        $athlete[] = $row_athlete;
    }
}


## หน้าจัดการนักกีฬา ##
if (isset($_GET['search_athlete'])) {
    $search_athlete = $_GET['search_athlete'];
    $sql_search = "SELECT * FROM competition_athlete LEFT JOIN competition_program ON competition_athlete.program_id = competition_program.program_id WHERE athlete_name LIKE '%$search_athlete%';";
    $query_select_all = $condb->query($sql_search);
} else {
    $sql_select_all = "SELECT * FROM competition_athlete LEFT JOIN competition_program ON competition_athlete.program_id = competition_program.program_id";
    $query_select_all = $condb->query($sql_select_all);
}
$select_athlete = array();
$select_all = array();
while ($row_all = $query_select_all->fetch_assoc()) {
    $select_all[] = $row_all;
}