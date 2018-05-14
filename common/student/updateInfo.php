<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 15:09
 */

require '../common.php';

$studentName = $studentSex = $studentBirthday = '';

switch ($_SERVER["REQUEST_METHOD"]) {
    case 'POST':
        $studentName = $_POST['studentName'];
        $studentSex = $_POST['studentSex'];
        $studentBirthday = $_POST['studentBirthday'];
        break;
    case 'GET':
        $studentName = $_GET['studentName'];
        $studentSex = $_GET['studentSex'];
        $studentBirthday = $_GET['studentBirthday'];
        break;
}
$response = new UpdateInfoResponse();
check_cookie($response);
$mysqli = check_database($response);
$user = new User();
$user->userID = $_SESSION['user_id'];
$user->userType = $_SESSION['user_type'];
if ($user->userType != 'student') {
    $response->format($response->USER_TYPE_ERROR);
    return_data($response);
}
$link_id_result = $user->get_link_id($mysqli, $response);
if ($link_id_result != $response->RESULT_OK) {
    $response->format($link_id_result);
    return_data($response);
}
$student = new Student();
$student->studentID = $user->linkID;
$student->studentName = $studentName;
$student->studentSex = $studentSex;
$student->studentBirthday = $studentBirthday;
$result = $student->updateInfo($mysqli, $response);
update_session();
$mysqli->close();
return_data($response, $result);