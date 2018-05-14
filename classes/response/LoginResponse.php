<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 13:26
 */

class LoginResponse extends Response
{
    var $EMPTY_FIELD_USERNAME = 11;
    var $EMPTY_FIELD_PASSWORD = 12;
    var $LOGIN_ERROR = 13;
    var $NO_USER = 14;

    public function format($code)
    {
        $this->code = $code;
        switch ($code) {
            case $this->EMPTY_FIELD_USERNAME:
                $this->message = '用户名为空';
                break;
            case $this->EMPTY_FIELD_PASSWORD:
                $this->message = '密码为空';
                break;
            case $this->LOGIN_ERROR:
                $this->message = '密码错误';
                break;
            case $this->NO_USER:
                $this->message = '用户不存在';
                break;
            default:
                parent::format($code);
                break;
        }
    }
}