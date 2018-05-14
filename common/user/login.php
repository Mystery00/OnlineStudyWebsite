<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/13/2018
 * Time: 18:27
 */

require '../common.php';

$username = $password = '';

switch ($_SERVER["REQUEST_METHOD"]) {
    case 'POST':
        $username = $_POST['username'];
        $password = $_POST['password'];
        break;
    case 'GET':
        $username = $_GET['username'];
        $password = $_GET['password'];
        break;
}
$response = new LoginResponse();
if ($username == '') {
    $response->format($response->EMPTY_FIELD_USERNAME);
    return_data($response);
}
if ($password == '') {
    $response->format($response->EMPTY_FIELD_PASSWORD);
    return_data($response);
}
$mysqli = check_database($response);

$user = new User();
$user->username = $username;
$user->password = $password;
$code = $user->login($mysqli, $response);
if ($code == $response->RESULT_OK) {
    session_start();
    $_SESSION['user_id'] = $user->userID;
    $_SESSION['user_type'] = $user->userType;
    $_SESSION['link_id'] = $user->linkID;
    update_session();
    $response->data = array('userType' => $user->userType);
}
$mysqli->close();
return_data($response, $code);