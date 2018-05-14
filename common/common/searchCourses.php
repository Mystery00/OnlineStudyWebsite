<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 16:37
 */

require '../common.php';

$keyword = '';
switch ($_SERVER["REQUEST_METHOD"]) {
    case 'POST':
        $keyword = $_POST['keyword'];
        break;
    case 'GET':
        $keyword = $_GET['keyword'];
        break;
}
$response = new SearchCourseResponse();
if ($keyword == '') {
    $response->format($response->KEY_NULL);
    return_data($response);
}
check_cookie($response);
$mysqli = check_database($response);

$user = new User();
$user->userID = $_SESSION['user_id'];
$user->userType = $_SESSION['user_type'];
$user->linkID = $_SESSION['link_id'];

$sql = "select tb_course.course_id,tb_course.course_name,tb_course.course_intro,tb_course.course_time,tb_course.teacher_id,tb_teacher.teacher_name from tb_course join tb_teacher on tb_course.teacher_id=tb_teacher.teacher_id where tb_course.course_name like '%$keyword%' or tb_course.course_intro like '%$keyword%' or tb_teacher.teacher_name like '%$keyword%'";
$result = $mysqli->query($sql);
$array = array();
$index = 0;
while ($row = $result->fetch_assoc()) {
    $list_course = new ListCourse($row['course_id'], $row['course_name'], $row['course_intro'], $row['course_time'], $row['teacher_id'], $row['teacher_name']);
    $array[$index] = $list_course;
    $index++;
}
update_session();
$mysqli->close();
$response->code = $response->RESULT_OK;
$response->data = $array;
return_data($response);
