<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 18:59
 */

class ListCourse
{
    var $courseID;
    var $courseName;
    var $courseIntroduce;
    var $courseTime;
    var $teacherID;
    var $teacherName;

    public function __construct($courseID, $courseName, $courseIntroduce, $courseTime, $teacherID, $teacherName)
    {
        $this->courseID = $courseID;
        $this->courseName = $courseName;
        $this->courseIntroduce = $courseIntroduce;
        $this->courseTime = $courseTime;
        $this->teacherID = $teacherID;
        $this->teacherName = $teacherName;
    }


}