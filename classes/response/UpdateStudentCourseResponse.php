<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/15/2018
 * Time: 03:51
 */

class UpdateStudentCourseResponse extends Response
{
    var $EMPTY_COURSE_ID = 11;
    var $NO_COURSE = 12;
    var $NO_STUDENT = 13;

    public function format($code)
    {
        $this->code = $code;
        switch ($code) {
            case $this->EMPTY_COURSE_ID:
                $this->message = '课程id不能为空';
                break;
            case $this->NO_COURSE:
                $this->message = '课程不存在';
                break;
            case $this->NO_STUDENT:
                $this->message = '学生不存在';
                break;
            default:
                parent::format($code);
                break;
        }
    }
}