<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 04:19
 */

require '../common.php';

$response = new GetInfoResponse();
check_cookie($response);
$mysqli = check_database($response);

$user = new User();
$user->userID = $_SESSION['user_id'];
$user->userType = $_SESSION['user_type'];
$user->linkID = $_SESSION['link_id'];
switch ($user->userType) {
    case 'student':
        $student = new Student();
        $student->studentID = $user->linkID;
        $get_info_result = $student->getInfo($mysqli, $response);
        if ($get_info_result == $response->RESULT_OK) {
            $get_info_result = $student;
        }
        break;
    case 'teacher':
        $teacher = new Teacher();
        $teacher->teacherID = $user->linkID;
        $get_info_result = $teacher->getInfo($mysqli, $response);
        if ($get_info_result == $response->RESULT_OK) {
            $get_info_result = $teacher;
        }
        break;
    default:
        $get_info_result = $response->USER_TYPE_ERROR;
        break;
}
update_session();
$mysqli->close();
if (is_int($get_info_result)) {
    return_data($response, $get_info_result);
} else {
    $response->code = $response->RESULT_OK;
    $response->data = $get_info_result;
    return_data($response);
}