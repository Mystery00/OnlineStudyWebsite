<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 04:19
 */

require '../common.php';

$response = new GetInfoResponse();
//检查是否有cookie
if (!isset($_COOKIE['cookie'])) {
    $response->format($response->NOT_LOGIN);
    return_data($response);
}

//检查session是否过期
$sessionID = $_COOKIE['cookie'];
session_id($sessionID);
session_start();
if (isset($_SESSION['expire_time']))
    if ($_SESSION['expire_time'] < time()) {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_type']);
        unset($_SESSION['expire_time']);
        $response->format($response->NOT_LOGIN);
        return_data($response);
    } else
        $_SESSION['expire_time'] = time() + 60 * 10;

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type'])) {
    $response->format($response->NOT_LOGIN);
    return_data($response);
}
//建立数据库连接
$mysqli = connect();
if (!$mysqli) {
    $response->format($response->DATABASE_ERROR);
    return_data($response);
}
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