<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/15/2018
 * Time: 00:10
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

$response = new ListCourseResourcesResponse();
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

$check_sql = "SELECT * FROM tb_course WHERE course_id='$courseID'";
$check_result = $mysqli->query($check_sql);
if ($check_result->num_rows == 0) {
    $response->format($response->NO_COURSE);
    return_data($response);
}

$sql = "select * from tb_resource where course_id='$courseID'";
$result = $mysqli->query($sql);
$array = array();
$index = 0;
while ($row = $result->fetch_assoc()) {
    $resource = new Resource();
    $resource->resourceID = $row['resource_id'];
    $resource->resourceName = $row['resource_name'];
    $resource->resourcePath = URL . $_SERVER['SERVER_NAME'] . PORT . $row['resource_path'];
    $resource->courseID = $row['course_id'];
    $array[$index] = $resource;
    $index++;
}
update_session();
$mysqli->close();
$response->code = $response->RESULT_OK;
$response->data = $array;
return_data($response);
