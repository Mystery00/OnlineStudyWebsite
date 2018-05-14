<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 13:50
 */

class RegisterResponse extends Response
{
    var $EMPTY_FIELD_USERNAME = 11;
    var $EMPTY_FIELD_PASSWORD = 12;
    var $EXIST_USER = 13;

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
            case $this->REGISTER_ERROR:
                $this->message = '注册失败';
                break;
            case $this->EXIST_USER:
                $this->message = '用户已存在';
                break;
            default:
                parent::format($code);
                break;
        }
    }
}