<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/15/2018
 * Time: 03:48
 */

require '../common.php';

$courseID = $studentID = $testName = $testScore = '';

switch ($_SERVER["REQUEST_METHOD"]) {
    case 'POST':
        $courseID = $_POST['courseID'];
        $studentID = $_POST['studentID'];
        $testName = $_POST['testName'];
        $testScore = $_POST['testScore'];
        break;
    case 'GET':
        $courseID = $_GET['courseID'];
        $studentID = $_GET['studentID'];
        $testName = $_GET['testName'];
        $testScore = $_GET['testScore'];
        break;
}
$response = new UpdateStudentCourseResponse();
if ($courseID == '') {
    $response->format($response->EMPTY_COURSE_ID);
    return_data($response);
}
check_cookie($response);
$mysqli = check_database($response);
$check_sql = "SELECT * FROM tb_course WHERE course_id='$courseID'";
$check_result = $mysqli->query($check_sql);
if ($check_result->num_rows == 0) {
    $response->format($response->NO_COURSE);
    return_data($response);
}
if ($studentID != '') {
    $check_sql = "SELECT * FROM tb_student WHERE student_id='$studentID'";
    $check_result = $mysqli->query($check_sql);
    if ($check_result->num_rows == 0) {
        $response->format($response->NO_STUDENT);
        return_data($response);
    }
}

$user = new User();
$user->userID = $_SESSION['user_id'];
$user->userType = $_SESSION['user_type'];
$user->linkID = $_SESSION['link_id'];
if ($user->userType != 'teacher') {
    $response->format($response->USER_TYPE_ERROR);
    return_data($response);
}
$sql = "UPDATE tb_choose SET ";
if ($testName != '')
    $sql = $sql . "test_name='$testName',";
if ($testScore != '')
    $sql = $sql . "test_score='$testScore',";
$sql = substr($sql, 0, strlen($sql) - 1);
$sql = $sql . " WHERE course_id='$courseID'";
if ($studentID != '') {
    $sql = $sql . " and student_id='$studentID'";
}
$result = $mysqli->query($sql);
if (!$result)
    $code = $response->UNKNOWN_ERROR;
else
    $code = $response->RESULT_OK;
update_session();
$mysqli->close();
return_data($response, $code);