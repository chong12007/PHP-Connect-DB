<?php

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE p4";
if (mysqli_query($conn, $sql)) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}

$dbname = "p4";
// Create connection to db
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql = "CREATE TABLE Student ( "
        . "StudentID CHAR(10) NOT NULL , "
        . "StudentName VARCHAR(30) NOT NULL ,"
        . " Gender CHAR(1) NOT NULL , "
        . "Program CHAR(2) NOT NULL , "
        . "PRIMARY KEY (StudentID))";

if (mysqli_query($conn, $sql)) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

$sql = "INSERT INTO Student (`StudentID`, `StudentName`, `Gender`, `Program`) VALUES
('20WMD00001', 'Ke Atas', 'M', 'FT'),
('21WMD00001', 'Masuk', 'M', 'IS'),
('21WMD00002', 'Keluar', 'F', 'IS'),
('22WMD00001', 'Ke Sini', 'M', 'FT'),
('22WMD00002', 'Ke Sana', 'F', 'FT');
";

if (mysqli_query($conn, $sql)) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
