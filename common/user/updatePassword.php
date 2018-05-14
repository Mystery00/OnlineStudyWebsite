<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 12:49
 */

require '../common.php';

$password = $newPassword = '';

switch ($_SERVER["REQUEST_METHOD"]) {
    case 'POST':
        $password = $_POST['password'];
        $newPassword = $_POST['newPassword'];
        break;
    case 'GET':
        $password = $_GET['password'];
        $newPassword = $_GET['newPassword'];
        break;
}

$response = new UpdatePasswordResponse();
if ($password == '') {
    $response->format($response->PASSWORD_ERROR);
    return_data($response);
}
if ($newPassword == '') {
    $response->format($response->EMPTY_NEW_PASSWORD);
    return_data($response);
}
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
$user->password = $password;
$code = $user->updatePassword($mysqli, $newPassword, $response);
if ($code == $response->RESULT_OK) {
    update_session();
}
$mysqli->close();
return_data($response, $code);