<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/13/2018
 * Time: 18:27
 */

require '../common.php';

$username = $password = "";

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

if ($username == '') {
    echo login_format(LOGIN_RESULT_FIELD_USERNAME);
    return;
}
if ($password == '') {
    echo login_format(LOGIN_RESULT_FIELD_PASSWORD);
    return;
}
$mysqli = connect();
if (!$mysqli) {
    echo login_format(LOGIN_RESULT_DATABASE_ERROR);
    return;
}

$user = new User();
$user->username = $username;
$user->password = $password;
$code = $user->login($mysqli);
if ($code==RESULT_OK){
    $expire = time() + 60 * 10;
    session_name('cookie');
    $_SESSION['user_id'] = $user->userID;
    $_SESSION['user_type'] = $user->userType;
    setcookie(session_name(), strtoupper(session_id()), $expire);
}
echo login_format($code);
$mysqli->close();