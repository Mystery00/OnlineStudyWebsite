<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 19:12
 */

require '../common.php';

$resourceID = '';
switch ($_SERVER["REQUEST_METHOD"]) {
    case 'POST':
        $resourceID = $_POST['resourceID'];
        break;
    case 'GET':
        $resourceID = $_GET['resourceID'];
        break;
}
$response = new DeleteCourseResourceResponse();
if ($resourceID == '') {
    $response->format($response->EMPTY_RESOURCE_ID);
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
$check_sql = "SELECT * FROM tb_resource WHERE resource_id='$resourceID'";
$check_result = $mysqli->query($check_sql);
if ($check_result->num_rows == 0) {
    $response->format($response->NO_RESOURCE);
    return_data($response);
}
$delete_file_path = $check_result->fetch_assoc()['resource_path'];
$sql = "delete from tb_resource where resource_id='$resourceID'";
$result = $mysqli->query($sql);
update_session();
$mysqli->close();
if (!$result) {
    $response->format($response->UNKNOWN_ERROR);
    return_data($response);
} else {
    unlink(DIR . $delete_file_path);
    $response->format($response->RESULT_OK);
    return_data($response);
}
