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
$fileName = "Freelancers.xls";

/* Excel Column Name */
$fields = array('#', 'Full Name', 'Gender', 'Age', 'Contacts', 'Location', 'Email');


/* Implode Excel Data */
$excelData = implode("\t", array_values($fields)) . "\n";

/* Fetch All Records From The Database */
$query = $mysqli->query("SELECT * FROM users u 
INNER JOIN login l ON l.login_id = u.user_login_id
WHERE l.login_rank = 'Freelancer'");
if ($query->num_rows > 0) {
    /* Load All Fetched Rows */
    $cnt = 1;
    while ($row = $query->fetch_assoc()) {
        /* Hardwire This Data Into .xls File */
        $lineData = array(
            $cnt, $row['user_fname'] . ' ' . $row['user_lname'], $row['user_gender'],
            $row['user_age'] . ' ' . 'Years', $row['user_contact'], $row['user_location'], $row['login_email']
        );
        array_walk($lineData, 'filterData');
        $excelData .= implode("\t", array_values($lineData)) . "\n";
        $cnt = $cnt + 1;
    }
} else {
    $excelData .= 'No Freelancers Available...' . "\n";
}

/* Generate Header File Encodings For Download */
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");

/* Render  Excel Data For Download */
echo $excelData;

exit;
