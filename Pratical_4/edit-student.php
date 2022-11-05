<?php

include 'connect-database.php';
//edit-student.php
$page_title = 'Edit Student';
//include 'helper.php';
//include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //var_export($_POST);
    $id = trim($_POST['id']);
    $name = trim($_POST['name']);
    $gender = array_key_exists('gender', $_POST) ? $_POST['gender'] : null;
    $program = $_POST['program'];

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
        $sql = "UPDATE Student SET StudentName=?,Gender=?,Program=? 
                WHERE StudentID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $name, $gender, $program, $id);
        $result = $stmt->execute();
        if ($result == true) {
            echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-heading">Success!</h4>
  <p class="mb-0">';
            echo "Student <b>$name</b> updated successfully.</p></div>";
        } else {
            var_dump($result);
        }
    }
} else {
    $id = $_GET['id'] ?? '';
    //check if ID is in correct pattern
    $pattern = "/[0-9]{2}[A-Z]{3}[0-9]{5}/";
    if (!preg_match($pattern, $id)) {
        $error['id'] = "Please use an <b>ID</b> with a valid pattern.";
    } else {
        $sql = "SELECT * FROM Student WHERE StudentID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row[$c1];
            $gender = $row[$c2];
            $program = $row[$c3];
        }
    }
}
?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <table class="table table-hover">
        <tr>
            <th>Student ID : </th>
            <td><?= $id ?>
                <input type="hidden"
                       name="id"
                       <?= isset($id) ? "value='$id'" : null ?>
                       class="form-control">                      
            </td>
        </tr>
        <tr>
            <th>Student Name :</th>
            <td><input type="text"
                       name="name" <?= isset($name) ? "value='$name'" : null ?>
                       maxlength="30"
                       class="form-control">                      
            </td>
        </tr>
        <tr>
            <th>Gender :</th>
            <td>
                <?php
                foreach (getGenders() as $v => $t) {
                    $s = $gender==$v?'checked':'';
                    echo "<input type='radio'
                                 name='gender'
                                 value='$v' id='$v' $s 
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
                        $s = $program==$v?'selected':'';
                        echo "<option $s value='$v'>$t</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <input type="submit" value="Update" class="btn btn-primary">
    <a href="list-student.php" class="btn btn-outline-secondary">Cancel</a>
</form>
