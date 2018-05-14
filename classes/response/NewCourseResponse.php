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
    var $EMPTY_TEACHER_INFO = 13;

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
            case $this->EMPTY_TEACHER_INFO:
                $this->message = '请先完善教师信息';
                break;
            default:
                parent::format($code);
                break;
        }
    }
}