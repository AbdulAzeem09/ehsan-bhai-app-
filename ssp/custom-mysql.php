<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../univ/baseurl.php');
function loadEnv($file = '.env') {
    if (!file_exists($file)) {
        throw new Exception('.env file not found');
    }

    $envVars = parse_ini_file($file);
    if (!$envVars) {
        throw new Exception('Error parsing .env file');
    }

    foreach ($envVars as $key => $value) {
        putenv("$key=$value");
    }
}
loadEnv('../.env');
require('ssp.class.php');
$sql_details = [
    'user' => getenv('DB_USER'),      // Database username
    'pass' => getenv('DB_PASS'),          // Database password
    'db'   => getenv('DB_NAME'),  // Database name
    'host' => getenv('DB_HOST')  // Database host
];


$mysqli = new mysqli($sql_details['host'], $sql_details['user'], $sql_details['pass'], $sql_details['db']);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

function selectQuery($table, $where = '') {
    global $mysqli;
    $query = "SELECT * FROM $table";
    if ($where) {
        $query .= " WHERE $where";
    }
    $result = $mysqli->query($query);

    if (!$result) {
        die('Query Error: ' . $mysqli->error);
    }

    

    return $result;
}

function updateQuery($table, $updateData, $where) {
    global $mysqli;
    $set = [];
    foreach ($updateData as $column => $value) {
        $set[] = "$column = '" . $mysqli->real_escape_string($value) . "'";
    }
    $setString = implode(', ', $set);

    $whereClauses = [];
    foreach ($where as $column => $value) {
        $whereClauses[] = "$column = '" . $mysqli->real_escape_string($value) . "'";
    }
    $whereString = implode(' AND ', $whereClauses);

    $query = "UPDATE $table SET $setString WHERE $whereString";
    if (!$mysqli->query($query)) {
        die('Update Query Error: ' . $mysqli->error);
    }

    return $mysqli->affected_rows;
}


function deleteQuery($table, $where) {
    global $mysqli;
    $whereClauses = [];
    foreach ($where as $column => $value) {
        $whereClauses[] = "$column = '" . $mysqli->real_escape_string($value) . "'";
    }
    $whereString = implode(' AND ', $whereClauses);

    $query = "DELETE FROM $table WHERE $whereString";
    if (!$mysqli->query($query)) {
        die('Delete Query Error: ' . $mysqli->error);
    }

    return $mysqli->affected_rows;
}