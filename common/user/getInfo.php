<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 04:19
 */

require '../common.php';

if (!isset($_COOKIE['cookie'])) {
    echo common_format(NOT_LOGIN, null);
    return;
}
$sessionID = $_COOKIE['cookie'];
session_id($sessionID);
session_start();
echo $_SESSION['user_id'];