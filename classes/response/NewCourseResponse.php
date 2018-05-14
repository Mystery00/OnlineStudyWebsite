<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 16:09
 */

class NewCourseResponse extends Response
{
    var $EMPTY_COURSE_NAME = 11;
    var $NO_TEACHER = 12;

    public function format($code)
    {
        $this->code = $code;
        switch ($code) {
            case $this->EMPTY_COURSE_NAME:
                $this->message = '课程名为空';
                break;
            case $this->NO_TEACHER:
                $this->message = '教师不存在';
                break;
            default:
                parent::format($code);
                break;
        }
    }
}