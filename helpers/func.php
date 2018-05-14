<?php

function check_cookie(Response $response)
{
    session_start();
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type'])) {
        $response->format($response->NOT_LOGIN);
        return_data($response);
    }
}

function check_database(Response $response)
{
    //建立数据库连接
    $mysqli = connect();
    if (!$mysqli) {
        $response->format($response->DATABASE_ERROR);
        return_data($response);
    }
    $mysqli->query("SET NAMES utf8");
    return $mysqli;
}

function update_session()
{
    $expire = time() + 60 * 10;
    $_SESSION['expire_time'] = $expire;
}