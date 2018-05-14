<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 16:37
 */

require '../common.php';

$response = new Response();
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

$sql = "select tb_course.course_id,tb_course.course_name,tb_course.course_intro,tb_course.course_time,tb_course.teacher_id,tb_teacher.teacher_name from tb_course join tb_teacher on tb_course.teacher_id=tb_teacher.teacher_id where tb_teacher.teacher_id='$user->linkID'";
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
