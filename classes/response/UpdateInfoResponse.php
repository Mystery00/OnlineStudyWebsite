<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 15:04
 */

class UpdateInfoResponse extends Response
{
    var $NO_USER = 11;

    public function format($code)
    {
        $this->code = $code;
        switch ($code) {
            case $this->NO_USER:
                $this->message = '用户不存在';
                break;
            default:
                parent::format($code);
                break;
        }
    }
}