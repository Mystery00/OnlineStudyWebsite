<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/15/2018
 * Time: 00:14
 */

class ListCourseResourcesResponse extends Response
{
    var $EMPTY_COURSE_ID = 11;
    var $NO_COURSE=12;

    public function format($code)
    {
        $this->code = $code;
        switch ($code) {
            case $this->EMPTY_COURSE_ID:
                $this->message = '课程id为空';
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