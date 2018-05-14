<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/15/2018
 * Time: 03:43
 */

class CourseGrade
{
    var $courseID;
    var $courseName;
    var $testName;
    var $testScore;

    public function __construct($courseID, $courseName, $testName, $testScore)
    {
        $this->courseID = $courseID;
        $this->courseName = $courseName;
        $this->testName = $testName;
        $this->testScore = $testScore;
    }


}