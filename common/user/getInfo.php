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
$get_info_result = $user->getInfo($mysqli, $response);
update_session();
$mysqli->close();
if (is_int($get_info_result)) {
    return_data($response, $get_info_result);
} else {
    $response->code = $response->RESULT_OK;
    $response->data = $get_info_result;
    return_data($response);
}