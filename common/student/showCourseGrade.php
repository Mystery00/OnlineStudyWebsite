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
if ($user->userType != 'student') {
    $response->format($response->USER_TYPE_ERROR);
    return_data($response);
}

$sql = "select tb_course.course_id,tb_course.course_name,tb_choose.test_name,tb_choose.test_score from (tb_choose join tb_course on tb_choose.course_id=tb_course.course_id) where tb_choose.student_id='$user->linkID'";
$result = $mysqli->query($sql);
$array = array();
$index = 0;
while ($row = $result->fetch_assoc()) {
    $list_course = new CourseGrade($row['course_id'], $row['course_name'], $row['test_name'], $row['test_score']);
    $array[$index] = $list_course;
    $index++;
}
update_session();
$mysqli->close();
$response->code = $response->RESULT_OK;
$response->data = $array;
return_data($response);
