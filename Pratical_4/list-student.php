<?php

include 'connect-database.php';

$page_title = 'List Student';


$sql = "SELECT StudentID, StudentName, Gender, Program FROM Student";
$result = $conn->query($sql);

$c0 = 'StudentID';
$c1 = 'StudentName';
$c2 = 'Gender';
$c3 = 'Program';

echo "<a class='btn btn-secondary' href='edit-student.php'>edit Student</a>";

if ($result->num_rows > 0) {
    echo "<table class='table table-hover'><tr><th>$c0</th><th>$c1</th><th>$c2</th><th>$c3</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $g = getGender($row[$c2]);
        $p = getProgram($row[$c3]);
        echo "<tr><td>$row[$c0]</td><td>$row[$c1]</td><td>$g</td><td>$row[$c3] - $p</td></tr>";
    }
    echo "<tr><td colspan=4>$result->num_rows record(s) returned."
    . "<a class='btn btn-secondary' href='insert-student.php'>Insert Student</a></td></tr>";
    echo "</table>";
} else {
    echo "No result.";
}
