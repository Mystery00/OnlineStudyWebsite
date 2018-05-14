<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 19:15
 */

class ChooseCourseResponse extends Response
{
    var $NO_COURSE = 11;
    var $EXIST = 12;

    public function format($code)
    {
        $this->code = $code;
        switch ($code) {
            case $this->NO_COURSE:
                $this->message = '课程不存在';
                break;
            case $this->EXIST:
                $this->message = '课程已经选过了';
                break;
            default:
                parent::format($code);
                break;
        }
    }
}