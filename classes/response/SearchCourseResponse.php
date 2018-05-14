<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 20:24
 */

class SearchCourseResponse extends Response
{
    var $KEY_NULL = 11;

    public function format($code)
    {
        $this->code = $code;
        switch ($code) {
            case $this->KEY_NULL:
                $this->message = '关键词为空';
                break;
            default:
                parent::format($code);
                break;
        }
    }
}