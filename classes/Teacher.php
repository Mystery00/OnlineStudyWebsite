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
            return $response->REGISTER_ERROR;
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
}