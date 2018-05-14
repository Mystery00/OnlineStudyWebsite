<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 20:49
 */
require '../common.php';

$response = new Response();
$_SESSION['expire_time'] = time() - 99999;
session_destroy();
$response->format($response->RESULT_OK);
return_data($response);