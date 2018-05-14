<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 12:49
 */

require '../common.php';

//检查是否有cookie
if (!isset($_COOKIE['cookie'])) {
    echo get_info_format(NOT_LOGIN, null);
    return;
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
        echo get_info_format(NOT_LOGIN, null);
        return;
    } else
        $_SESSION['expire_time'] = time() + 60 * 10;

//建立数据库连接
$mysqli = connect();
if (!$mysqli) {
    echo get_info_format(LOGIN_RESULT_DATABASE_ERROR, null);
    return;
}

$user = new User();
$user->userID = $_SESSION['user_id'];
$user->userType = $_SESSION['user_type'];
