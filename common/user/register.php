<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 03:49
 */

require '../common.php';

$username = $password = $userType = "";

switch ($_SERVER["REQUEST_METHOD"]) {
    case 'POST':
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userType = $_POST['userType'];
        break;
    case 'GET':
        $username = $_GET['username'];
        $password = $_GET['password'];
        $userType = $_GET['userType'];
        break;
}

if ($username == '') {
    echo register_format(REGISTER_RESULT_FIELD_USERNAME);
    return;
}
if ($password == '') {
    echo register_format(REGISTER_RESULT_FIELD_PASSWORD);
    return;
}
if ($userType == '') {
    echo register_format(REGISTER_RESULT_FIELD_USER_TYPE);
    return;
}
if ($userType != 'student' && $userType != 'teacher') {
    echo register_format(REGISTER_RESULT_FIELD_USER_TYPE);
    return;
}
$mysqli = connect();
if (!$mysqli) {
    echo register_format(REGISTER_RESULT_DATABASE_ERROR);
    return;
}

$user = new User();
$user->username = $username;
$user->password = $password;
$user->userType = $userType;
$code = $user->register($mysqli);
echo register_format($code);
$mysqli->close();