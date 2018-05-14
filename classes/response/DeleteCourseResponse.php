<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 20:29
 */

class DeleteCourseResponse extends Response
{
    var $NO_COURSE = 11;
    var $NOT_CHOOSE = 12;
    var $EMPTY_COURSE_ID = 13;

    public function format($code)
    {
        $this->code = $code;
        switch ($code) {
            case $this->NO_COURSE:
                $this->message = '课程不存在';
                break;
            case $this->NOT_CHOOSE:
                $this->message = '该门课程未选择';
                break;
            case $this->EMPTY_COURSE_ID:
                $this->message = '课程id不能为空';
                break;
            default:
                parent::format($code);
                break;
        }
    }
}