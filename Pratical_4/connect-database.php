<?php
//include_once 'create-database.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "p4";

// Create connection to db
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}else{
    echo 'yeah';
}

function getGenders() {
    return ['M' => 'Male', 'F' => 'Female'];
}

function getGender($g) {
    $genders = getGenders();
    if(array_key_exists($g, $genders)) {
        return $genders[$g];
    } else {
        return NULL;
    }
} 

function getPrograms() {
    return [
        'FT' => 'Information Technology',
        'IS' => 'Information System'
    ];
}

function getProgram($p) {
    $programs = getPrograms();
    if(array_key_exists($p, $programs)) {
        return $programs[$p];
    } else {
        return NULL;
    }
}


