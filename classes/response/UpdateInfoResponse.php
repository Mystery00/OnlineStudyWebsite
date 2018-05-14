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
    var $EMPTY_COURSE_ID = 12;
    var $EMPTY_COURSE_NAME = 13;
    var $NO_COURSE = 14;

    public function format($code)
    {
        $this->code = $code;
        switch ($code) {
            case $this->NO_USER:
                $this->message = '用户不存在';
                break;
            case $this->EMPTY_COURSE_ID:
                $this->message = '课程id不能为空';
                break;
            case $this->EMPTY_COURSE_NAME:
                $this->message = '课程名不能为空';
                break;
            case $this->NO_COURSE:
                $this->message = '课程不存在';
                break;
            default:
                parent::format($code);
                break;
        }
    }
}