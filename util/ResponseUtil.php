<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/13/2018
 * Time: 18:46
 */

function register_format($code)
{
    $response = new Response();
    $response->code = $code;
    switch ($code) {
        case RESULT_OK:
            $message = '成功';
            break;
        case REGISTER_RESULT_FIELD_USERNAME:
            $message = '用户名为空';
            break;
        case REGISTER_RESULT_FIELD_PASSWORD:
            $message = '密码为空';
            break;
        case REGISTER_RESULT_FIELD_USER_TYPE:
            $message = '用户类型错误';
            break;
        case REGISTER_RESULT_EXIST_USER:
            $message = '用户已存在';
            break;
        case REGISTER_RESULT_REGISTER_ERROR:
            $message = '注册失败';
            break;
        case REGISTER_RESULT_DATABASE_ERROR:
            $message = '数据库错误';
            break;
        default:
            $message = '未知错误';
            break;
    }
    $response->message = $message;
    return json_encode($response);
}

function login_format($code)
{
    $response = new Response();
    $response->code = $code;
    switch ($code) {
        case RESULT_OK:
            $message = '成功';
            break;
        case LOGIN_RESULT_FIELD_USERNAME:
            $message = '用户名为空';
            break;
        case LOGIN_RESULT_FIELD_PASSWORD:
            $message = '密码为空';
            break;
        case LOGIN_RESULT_NO_USER:
            $message = '用户不存在';
            break;
        case LOGIN_RESULT_LOGIN_ERROR:
            $message = '密码错误';
            break;
        case LOGIN_RESULT_DATABASE_ERROR:
            $message = '数据库错误';
            break;
        default:
            $message = '未知错误';
            break;
    }
    $response->message = $message;
    return json_encode($response);
}

function common_format($code, $data)
{
    $response = new Response();
    $response->code = $code;
    switch ($code) {
        case RESULT_OK:
            $message = '成功';
            $response->data = $data;
            break;
        case NOT_LOGIN:
            $message = '未登录';
            break;
        default:
            $message = '未知错误';
            break;
    }
    $response->message = $message;
    return json_encode($response);
}