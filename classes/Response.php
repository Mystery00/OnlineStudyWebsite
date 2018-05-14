<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/13/2018
 * Time: 18:47
 */

class Response
{
    var $RESULT_OK = 0;
    var $NOT_LOGIN = 1;
    var $DATABASE_ERROR = 2;
    var $USER_TYPE_ERROR = 3;
    var $UNKNOWN_ERROR = 9;

    var $code;
    var $data;
    var $message;

    function format($code)
    {
        $this->code = $code;
        switch ($code) {
            case $this->RESULT_OK:
                $this->message = '成功';
                break;
            case $this->NOT_LOGIN:
                $this->message = '未登录';
                break;
            case $this->DATABASE_ERROR:
                $this->message = '数据库错误';
                break;
            case $this->USER_TYPE_ERROR:
                $this->message = '用户类型错误';
                break;
            case $this->UNKNOWN_ERROR:
            default:
                $this->message = '未知错误';
                break;
        }
    }
}