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

$response = new RegisterResponse();
if ($username == '') {
    $response->code=$response->EMPTY_FIELD_USERNAME;
    return_data($response);
}
if ($password == '') {
    $response->code=$response->EMPTY_FIELD_PASSWORD;
    return_data($response);
}
if ($userType == '') {
    $response->code=$response->USER_TYPE_ERROR;
    return_data($response);
}
if ($userType != 'student' && $userType != 'teacher') {
    $response->code=$response->USER_TYPE_ERROR;
    return_data($response);
}
$mysqli = connect();
if (!$mysqli) {
    $response->format($response->DATABASE_ERROR);
    return_data($response);
}

$user = new User();
$user->username = $username;
$user->password = $password;
$user->userType = $userType;
$code = $user->register($mysqli,$response);

$mysqli->close();
return_data($response,$code);