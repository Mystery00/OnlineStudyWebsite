<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 20:29
 */

class DeleteCourseResourceResponse extends Response
{
    var $NO_RESOURCE = 11;
    var $EMPTY_RESOURCE_ID = 12;

    public function format($code)
    {
        $this->code = $code;
        switch ($code) {
            case $this->NO_RESOURCE:
                $this->message = '资源不存在';
                break;
            case $this->EMPTY_RESOURCE_ID:
                $this->message = '资源id不能为空';
                break;
            default:
                parent::format($code);
                break;
        }
    }
}