<?php
session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../config/codeGen.php');
check_login();
require_once('../vendor/autoload.php');

/* Persist Reports Into CSV File */
/* Filter Excel Data */
function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

/* Excel File Name */
$fileName = "Errands.xls";

/* Excel Column Name */
$fields = array('#', 'Posted By', 'Errand Name', 'Errand Budget', 'Errand Due', 'Errand Details');


/* Implode Excel Data */
$excelData = implode("\t", array_values($fields)) . "\n";

/* Fetch All Records From The Database */
$query = $mysqli->query("SELECT * FROM errands e
INNER JOIN users u ON u.user_id = e.errand_user_id
INNER JOIN login l ON l.login_id = u.user_login_id");
if ($query->num_rows > 0) {
    /* Load All Fetched Rows */
    $cnt = 1;
    while ($row = $query->fetch_assoc()) {
        /* Hardwire This Data Into .xls File */
        $lineData = array(
            $cnt, $row['user_fname'] . ' ' . $row['user_lname'], $row['errand_name'],
            'Ksh' . number_format($row['errand_amount'], 2), date('d M Y', strtotime($row['errand_due_date'])), $row['errand_description']
        );
        array_walk($lineData, 'filterData');
        $excelData .= implode("\t", array_values($lineData)) . "\n";
        $cnt = $cnt + 1;
    }
} else {
    $excelData .= 'No Posted Errands Available...' . "\n";
}

/* Generate Header File Encodings For Download */
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");

/* Render  Excel Data For Download */
echo $excelData;

exit;
