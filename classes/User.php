<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/13/2018
 * Time: 18:27
 */

class User
{
    var $userID;
    var $username;
    var $password;
    var $userType;
    var $linkID;

    function register(mysqli $mysqli, RegisterResponse $response)
    {
        $check_result = $this->isUserExist($mysqli);
        if (!$check_result) {
            switch ($this->userType) {
                case 'student':
                    $student = new Student();
                    $register_student_result = $student->register($mysqli, $response);
                    if ($register_student_result == $response->REGISTER_ERROR)
                        return $response->REGISTER_ERROR;
                    $this->linkID = $student->studentID;
                    break;
                case 'teacher':
                    $teacher = new Teacher();
                    $register_teacher_result = $teacher->register($mysqli, $response);
                    if ($register_teacher_result == $response->REGISTER_ERROR)
                        return $response->REGISTER_ERROR;
                    $this->linkID = $teacher->teacherID;
                    break;
                default:
                    return $response->USER_TYPE_ERROR;
                    break;
            }
            $md5Str = $this->username . date("Y-m-d H:i:s");
            $this->userID = substr(strtoupper(md5($md5Str)), 0, 20);
            $sql = "INSERT INTO tb_user VALUES('$this->userID','$this->username','$this->password','$this->userType','$this->linkID')";
            $result = $mysqli->query($sql);
            if ($result == TRUE)
                return $response->RESULT_OK;
            else
                return $response->REGISTER_ERROR;
        } else {
            return $response->EXIST_USER;
        }
    }

    function login(mysqli $mysqli, LoginResponse $response)
    {
        $result = $this->isUserExist($mysqli);
        if (!$result)
            return $response->NO_USER;//用户不存在
        if ($result->num_rows > 1)
            return $response->DATABASE_ERROR;//数据库错误
        $sql_user = $result->fetch_assoc();
        $true_password = $sql_user['password'];
        if ($true_password != $this->password)
            return $response->LOGIN_ERROR;
        $this->userID = $sql_user['user_id'];
        $this->userType = $sql_user['user_type'];
        return $response->RESULT_OK;
    }

    function getInfo(mysqli $mysqli)
    {
        $sql = "SELECT link_id FROM tb_user WHERE user_id='$this->userID'";
        $result = $mysqli->query($sql);
        if ($result->num_rows == 0)
            return GET_INFO_NO_USER;
        $sql_user = $result->fetch_assoc();
        $this->linkID = $sql_user['link_id'];
        switch ($this->userType) {
            case 'student':
                $student = new Student();
                $student->studentID = $this->linkID;
                $get_info_result = $student->getInfo($mysqli);
                if ($get_info_result == RESULT_OK) {
                    echo get_info_format(RESULT_OK, $student);
                    return true;
                }
                break;
            case 'teacher':
                $teacher = new Teacher();
                $teacher->teacherID = $this->linkID;
                $get_info_result = $teacher->getInfo($mysqli);
                if ($get_info_result == RESULT_OK) {
                    echo get_info_format(RESULT_OK, $teacher);
                    return true;
                }
                break;
            default:
                return USER_TYPE_ERROR;
                break;
        }
        return GET_INFO_NO_USER;
    }

    function updatePassword(mysqli $mysqli, $newPassword)
    {
        $login_result = $this->login($mysqli);
        if ($login_result == RESULT_OK) {
            $sql = "UPDATE tb_user SET password='$newPassword' WHERE user_id='$this->userID'";
            $mysqli->query($sql);
            return RESULT_OK;
        } else
            return $login_result;
    }

    private function isUserExist(mysqli $mysqli)
    {
        $sql = "SELECT * from tb_user WHERE username='$this->username'";
        $result = $mysqli->query($sql);
        if ($result->num_rows == 0)
            return false;
        else
            return $result;
    }
}