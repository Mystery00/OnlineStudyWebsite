<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 21:39
 */

require '../common.php';

$resourceName = $courseID = '';
$upload_dir = DIR . '/upload/';

$resourceName = $_POST['resourceName'];
$courseID = $_POST['courseID'];
$response = new NewCourseResourceResponse();
if ($resourceName == '') {
    $response->format($response->EMPTY_RESOURCE_NAME);
    return_data($response);
}
if ($courseID == '') {
    $response->format($response->EMPTY_COURSE_ID);
    return_data($response);
}
if ($_FILES['file']['name'] == '') {
    $response->format($response->EMPTY_FILE);
    return_data($response);
}
if ($_FILES['file']['error'] > 0) {
    switch ($_FILES['file']['error']) {
        case 1:
        case 2:
            $response->format($response->FILE_TOO_BIG);
            return_data($response);
            break;
        default:
            $response->format($response->FILE_UPLOAD_ERROR);
            return_data($response);
            break;
    }
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
$check_sql = "SELECT * FROM tb_course WHERE course_id='$courseID'";
$check_result = $mysqli->query($check_sql);
if ($check_result->num_rows == 0) {
    $response->format($response->NO_COURSE);
    return_data($response);
}
$upload_dir = $upload_dir . $courseID . '/';
if (!file_exists($upload_dir))
    mkdir($upload_dir, 0777, true);
move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . $_FILES['file']['name']);
$resource = new Resource();
$resource->resourceName = $resourceName;
$resource->resourcePath = '/upload/' . $courseID . '/' . $_FILES['file']['name'];
$resource->courseID = $courseID;

$result = $resource->new_resource($mysqli, $response);
update_session();
$mysqli->close();
return_data($response, $result);