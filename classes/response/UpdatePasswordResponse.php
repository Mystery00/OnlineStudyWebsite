<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 14:25
 */

class UpdatePasswordResponse extends Response
{
    var $NO_USER = 11;
    var $PASSWORD_ERROR = 12;
    var $EMPTY_NEW_PASSWORD=13;

    public function format($code)
    {
        $this->code = $code;
        switch ($code) {
            case $this->NO_USER:
                $this->message = '用户不存在';
                break;
            case $this->PASSWORD_ERROR:
                $this->message = '密码错误';
                break;
            case $this->EMPTY_NEW_PASSWORD:
                $this->message = '新密码不能为空';
                break;
            default:
                parent::format($code);
                break;
        }
    }
}