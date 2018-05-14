<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/15/2018
 * Time: 01:29
 */

require '../common/common.php';

// 创建连接
$conn = new mysqli(SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
echo "连接成功";