<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/13/2018
 * Time: 18:21
 */

class Course
{
    var $courseID;
    var $courseName;
    var $courseIntroduce;
    var $courseTime;
    var $teacherID;

    function new_course(mysqli $mysqli, NewCourseResponse $response)
    {
        $date = date("Y-m-d H:i:s");
        $md5Str = $this->courseName . $date;
        $this->courseID = substr(strtoupper(md5($md5Str)), 0, 20);
        $sql = "insert into tb_course(course_id, course_name, course_intro, course_time, teacher_id) VALUES('$this->courseID','$this->courseName','$this->courseIntroduce','$this->courseTime','$this->teacherID')";
        $result = $mysqli->query($sql);
        if ($result == TRUE)
            return $response->RESULT_OK;
        else
            return $response->UNKNOWN_ERROR;
    }
}