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

check_cookie($response);
$mysqli = check_database($response);

$user = new User();
$user->userID = $_SESSION['user_id'];
$user->password = $password;
$code = $user->updatePassword($mysqli, $newPassword, $response);
if ($code == $response->RESULT_OK) {
    update_session();
}
$mysqli->close();
return_data($response, $code);