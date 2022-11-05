<?php

//insert-student.php
include 'connect-database.php';
$page_title = 'Insert Student';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //var_export($_POST);
    $id = trim($_POST['id']);
    $name = trim($_POST['name']);
    $gender = array_key_exists('gender', $_POST) ? $_POST['gender'] : null;
    $program = $_POST['program'];

    //check if ID is in correct pattern
    $pattern = "/[0-9]{2}[A-Z]{3}[0-9]{5}/";
    if (!preg_match($pattern, $id)) {
        $error['id'] = "Please insert an <b>ID</b> with a valid pattern.";
    } else {
        $sql = "SELECT * FROM student WHERE StudentID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $error['id'] = "<b>Student ID</b> given already exist. Try another.";
        }
    }

    //check name, gender, program
    if (empty($name)) {
        $error['name'] = 'Please insert a <b>Name</b>.';
    }
    if (empty($gender)) {
        $error['gender'] = 'Please insert a <b>Gender</b>.';
    }
    if (empty($program)) {
        $error['program'] = 'Please insert a <b>Program</b>.';
    }


    if (isset($error)) {
        echo '<div class="alert alert-dismissible alert-warning">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-heading">Warning!</h4>
  <ul class="mb-0">';
        foreach ($error as $e => $t) {
            echo "<li>$t</li>";
        }
        echo '</ul></div>';
    } else {
        $sql = "INSERT INTO student (StudentID,StudentName,Gender,Program) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $id, $name, $gender, $program);
        $result = $stmt->execute();
        if ($result == true) {
            echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-heading">Success!</h4>
  <p class="mb-0">';
            echo "Student $name inserted successfully.</p></div>";
            $id = null;
            $name = null;
        } else {
            var_dump($result);
        }
    }
}
?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <table class="table table-hover">
        <tr>
            <th>Student ID :</th>
            <td><input type="text"
                       name="id"
                       placeholder="Format of ID: 99XXX99999"
                       maxlength="10" <?= isset($id)?"value='$id'":null ?>
                       class="form-control">                      
            </td>
        </tr>
        <tr>
            <th>Student Name :</th>
            <td><input type="text"
                       name="name" <?= isset($name)?"value='$name'":null ?>
                       maxlength="30"
                       class="form-control">                      
            </td>
        </tr>
        <tr>
            <th>Gender :</th>
            <td>
<?php
foreach (getGenders() as $v => $t) {
    echo "<input type='radio'
                                 name='gender'
                                 value='$v' id='$v'
                                 class='form-check-input'>
                          <label for='$v'
                                 class='form-check-label'>
                          $t&nbsp;</label>";
}
?>
            </td>
        </tr>
        <tr>
            <th>Program :</th>
            <td><select name="program" class="form-select">
                    <option value="">-- Select One --</option>
<?php
foreach (getPrograms() as $v => $t) {
    echo "<option value='$v'>$t</option>";
}
?>
                </select>
            </td>
        </tr>
    </table>
    <input type="submit" value="Insert" class="btn btn-primary">
    <a href="list-student.php" class="btn btn-outline-secondary">Cancel</a>
</form>

