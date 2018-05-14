<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 19:12
 */

require '../common.php';

$courseID = '';
switch ($_SERVER["REQUEST_METHOD"]) {
    case 'POST':
        $courseID = $_POST['courseID'];
        break;
    case 'GET':
        $courseID = $_GET['courseID'];
        break;
}
$response = new DeleteCourseResponse();
if ($courseID == '') {
    $response->format($response->EMPTY_COURSE_ID);
    return_data($response);
}

check_cookie($response);
$mysqli = check_database($response);
$user = new User();
$user->userID = $_SESSION['user_id'];
$user->userType = $_SESSION['user_type'];
$user->linkID = $_SESSION['link_id'];
if ($user->userType != 'student') {
    $response->format($response->USER_TYPE_ERROR);
    return_data($response);
}
$check_sql = "SELECT * FROM tb_course WHERE course_id='$courseID'";
$check_result = $mysqli->query($check_sql);
if ($check_result->num_rows == 0) {
    $response->format($response->NO_COURSE);
    return_data($response);
}
$check_choose_sql = "select * from tb_choose where course_id='$courseID' and student_id='$user->linkID'";
$check_choose_result = $mysqli->query($check_choose_sql);
if ($check_choose_result->num_rows == 0) {
    $response->format($response->NOT_CHOOSE);
    return_data($response);
}
$sql = "delete from tb_choose where student_id='$user->linkID' and course_id='$courseID'";
$result = $mysqli->query($sql);
update_session();
$mysqli->close();
if (!$result) {
    $response->format($response->UNKNOWN_ERROR);
    return_data($response);
} else {
    $response->format($response->RESULT_OK);
    return_data($response);
}
