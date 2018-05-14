<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 22:02
 */

class NewCourseResourceResponse extends Response
{
    var $EMPTY_RESOURCE_NAME = 11;
    var $NO_COURSE = 12;
    var $EMPTY_COURSE_ID = 13;
    var $EMPTY_FILE = 14;
    var $FILE_TOO_BIG = 15;
    var $FILE_UPLOAD_ERROR = 16;

    public function format($code)
    {
        $this->code = $code;
        switch ($code) {
            case $this->EMPTY_RESOURCE_NAME:
                $this->message = '资源名为空';
                break;
            case $this->NO_COURSE:
                $this->message = '课程不存在';
                break;
            case $this->EMPTY_COURSE_ID:
                $this->message = '课程id为空';
                break;
            case $this->EMPTY_FILE:
                $this->message = '文件为空';
                break;
            case $this->FILE_TOO_BIG:
                $this->message = '文件过大';
                break;
            case $this->FILE_UPLOAD_ERROR:
                $this->message = '文件上传失败';
                break;
            default:
                parent::format($code);
                break;
        }
    }
}