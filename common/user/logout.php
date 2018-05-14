<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 20:49
 */
require '../common.php';

$response = new Response();
unset($_SESSION['user_id']);
unset($_SESSION['user_type']);
unset($_SESSION['link_id']);
unset($_SESSION['expire_time']);
session_destroy();
$response->format($response->RESULT_OK);
return_data($response);