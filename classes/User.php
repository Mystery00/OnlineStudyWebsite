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

    function register(mysqli $mysqli)
    {
        $check_result = $this->isUserExist($mysqli);
        if (!$check_result) {
            $md5Str = $this->username . date("Y-m-d H:i:s");
            $this->userID = substr(strtoupper(md5($md5Str)), 0, 20);
            $this->linkID = "";
            $sql = "INSERT INTO tb_user VALUES('$this->userID','$this->username','$this->password','$this->userType','$this->linkID')";
            $result = $mysqli->query($sql);
            if ($result == TRUE)
                return RESULT_OK;
            else
                return REGISTER_RESULT_REGISTER_ERROR;
        } else {
            return REGISTER_RESULT_EXIST_USER;
        }
    }

    function login(mysqli $mysqli)
    {
        $result = $this->isUserExist($mysqli);
        if (!$result)
            return LOGIN_RESULT_NO_USER;//用户不存在
        if ($result->num_rows > 1)
            return LOGIN_RESULT_DATABASE_ERROR;//数据库错误
        $sql_user = $result->fetch_assoc();
        $true_password = $sql_user['password'];
        if ($true_password != $this->password)
            return LOGIN_RESULT_LOGIN_ERROR;
        $this->userID = $sql_user['user_id'];
        $this->userType = $sql_user['user_type'];
        return RESULT_OK;
    }

    function isUserExist(mysqli $mysqli)
    {
        $sql = "SELECT * from tb_user WHERE username=$this->username";
        $result = $mysqli->query($sql);
        if ($result->num_rows == 0)
            return false;
        else
            return $result;
    }
}