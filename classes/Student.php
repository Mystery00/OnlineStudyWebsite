<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/13/2018
 * Time: 18:15
 */

class Student
{
    var $studentID;
    var $studentName;
    var $studentSex;
    var $studentBirthday;

    function register(mysqli $mysqli, RegisterResponse $response)
    {
        $date = date("Y-m-d H:i:s");
        $md5Str = $this->studentName . $date;
        $this->studentID = substr(strtoupper(md5($md5Str)), 0, 20);
        $this->studentName = '';
        $this->studentSex = '';
        $this->studentBirthday = $date;
        $sql = "insert into tb_student(student_id, student_name, student_sex, student_birthday) VALUES('$this->studentID','$this->studentName','$this->studentSex','$this->studentBirthday')";
        $result = $mysqli->query($sql);
        if ($result == TRUE)
            return $response->RESULT_OK;
        else
            return $response->REGISTER_ERROR;
    }

    function getInfo(mysqli $mysqli, GetInfoResponse $response)
    {
        $sql = "SELECT * FROM tb_student WHERE student_id='$this->studentID'";
        $result = $mysqli->query($sql);
        if ($result->num_rows == 0)
            return $response->NO_USER;
        $sql_student = $result->fetch_assoc();
        $this->studentName = $sql_student['student_name'];
        $this->studentSex = $sql_student['student_sex'];
        $this->studentBirthday = $sql_student['student_birthday'];
        return $response->RESULT_OK;
    }

    function updateInfo(mysqli $mysqli, UpdateInfoResponse $response)
    {
        $sql = "SELECT * FROM tb_student WHERE student_id='$this->studentID'";
        $result = $mysqli->query($sql);
        if ($result->num_rows == 0)
            return $response->NO_USER;
        $sql = "UPDATE tb_student SET student_name='$this->studentName',student_sex='$this->studentSex',student_birthday='$this->studentBirthday' WHERE student_id='$this->studentID'";
        $result = $mysqli->query($sql);
        if (!$result)
            return $response->UNKNOWN_ERROR;
        else
            return $response->RESULT_OK;
    }
}