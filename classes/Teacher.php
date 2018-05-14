<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/13/2018
 * Time: 18:24
 */

class Teacher
{
    var $teacherID;
    var $teacherName;
    var $teacherSex;
    var $teacherBirthday;

    function register(mysqli $mysqli, RegisterResponse $response)
    {
        $date = date("Y-m-d H:i:s");
        $md5Str = $this->teacherName . $date;
        $this->teacherID = substr(strtoupper(md5($md5Str)), 0, 20);
        $this->teacherName = '';
        $this->teacherSex = '';
        $this->teacherBirthday = $date;
        $sql = "insert into tb_teacher(teacher_id, teacher_name, teacher_sex, teacher_birthday) VALUES('$this->teacherID','$this->teacherName','$this->teacherSex','$this->teacherBirthday')";
        $result = $mysqli->query($sql);
        if ($result == TRUE)
            return $response->RESULT_OK;
        else
            return $response->UNKNOWN_ERROR;
    }

    function getInfo(mysqli $mysqli, GetInfoResponse $response)
    {
        $sql = "SELECT * FROM tb_teacher WHERE teacher_id='$this->teacherID'";
        $result = $mysqli->query($sql);
        if ($result->num_rows == 0)
            return $response->NO_USER;
        $sql_student = $result->fetch_assoc();
        $this->teacherName = $sql_student['teacher_name'];
        $this->teacherSex = $sql_student['teacher_sex'];
        $this->teacherBirthday = $sql_student['teacher_birthday'];
        return $response->RESULT_OK;
    }

    function updateInfo(mysqli $mysqli, UpdateInfoResponse $response)
    {
        $sql = "SELECT * FROM tb_teacher WHERE teacher_id='$this->teacherID'";
        $result = $mysqli->query($sql);
        if ($result->num_rows == 0)
            return $response->NO_USER;
        $sql = "UPDATE tb_teacher SET ";
        if ($this->teacherName != '') {
            $sql = $sql . "teacher_name='$this->teacherName',";
        }
        if ($this->teacherSex != '') {
            $sql = $sql . "teacher_sex='$this->teacherSex',";
        }
        if ($this->teacherBirthday != '') {
            $sql = $sql . "teacher_birthday='$this->teacherName',";
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql = $sql . " WHERE teacher_id='$this->teacherID'";
        $result = $mysqli->query($sql);
        if (!$result)
            return $response->UNKNOWN_ERROR;
        else
            return $response->RESULT_OK;
    }
}