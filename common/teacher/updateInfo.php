<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 15:09
 */

require '../common.php';

$teacherName = $teacherSex = $teacherBirthday = '';

switch ($_SERVER["REQUEST_METHOD"]) {
    case 'POST':
        $teacherName = $_POST['teacherName'];
        $teacherSex = $_POST['teacherSex'];
        $teacherBirthday = $_POST['teacherBirthday'];
        break;
    case 'GET':
        $teacherName = $_GET['teacherName'];
        $teacherSex = $_GET['teacherSex'];
        $teacherBirthday = $_GET['teacherBirthday'];
        break;
}
$response = new UpdateInfoResponse();
check_cookie($response);
$mysqli = check_database($response);

$user = new User();
$user->userID = $_SESSION['user_id'];
$user->userType = $_SESSION['user_type'];
$user->linkID = $_SESSION['link_id'];
if ($user->userType != 'teacher') {
    $response->format($response->USER_TYPE_ERROR);
    return_data($response);
}
$teacher = new Teacher();
$teacher->teacherID = $user->linkID;
$teacher->teacherName = $teacherName;
$teacher->teacherSex = $teacherSex;
$teacher->teacherBirthday = $teacherBirthday;
$result = $teacher->updateInfo($mysqli, $response);
update_session();
$mysqli->close();
return_data($response, $result);