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

    function update_course(mysqli $mysqli, UpdateInfoResponse $response)
    {
        $sql = "select * from tb_course where course_id='$this->courseID'";
        $result = $mysqli->query($sql);
        if ($result->num_rows == 0)
            return $response->NO_COURSE;
        $sql = "UPDATE tb_course SET ";
        if ($this->courseName != '')
            $sql = $sql . "course_name='$this->courseName',";
        if ($this->courseIntroduce != '')
            $sql = $sql . "course_name='$this->courseIntroduce',";
        if ($this->courseTime != '')
            $sql = $sql . "course_name='$this->courseTime',";
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql = $sql . " WHERE course_id='$this->courseID'";
        $result = $mysqli->query($sql);
        if (!$result)
            return $response->UNKNOWN_ERROR;
        else
            return $response->RESULT_OK;
    }
}