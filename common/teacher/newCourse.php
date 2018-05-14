<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 16:03
 */

require '../common.php';

$courseName = $courseIntroduce = $courseTime = '';

switch ($_SERVER["REQUEST_METHOD"]) {
    case 'POST':
        $courseName = $_POST['courseName'];
        $courseIntroduce = $_POST['courseIntroduce'];
        $courseTime = $_POST['courseTime'];
        break;
    case 'GET':
        $courseName = $_GET['courseName'];
        $courseIntroduce = $_GET['courseIntroduce'];
        $courseTime = $_GET['courseTime'];
        break;
}
$response = new NewCourseResponse();
if ($courseName == '') {
    $response->format($response->EMPTY_COURSE_NAME);
    return_data($response);
}
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
if ($user->linkID == '') {
    $response->format($response->NO_TEACHER);
    return_data($response);
}
$course = new Course();
$course->courseName = $courseName;
$course->courseIntroduce = $courseIntroduce;
$course->courseTime = $courseTime;
$course->teacherID = $user->linkID;

$result = $course->new_course($mysqli, $response);
update_session();
$mysqli->close();
return_data($response, $result);