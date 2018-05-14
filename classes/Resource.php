<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/13/2018
 * Time: 18:23
 */

class Resource
{
    var $resourceID;
    var $resourceName;
    var $resourcePath;
    var $courseID;

    function new_resource(mysqli $mysqli, NewCourseResourceResponse $response)
    {
        $date = date("Y-m-d H:i:s");
        $md5Str = $this->resourceName . $date;
        $this->resourceID = substr(strtoupper(md5($md5Str)), 0, 20);
        $sql = "insert into tb_resource(resource_id, resource_name, resource_path, course_id) VALUES('$this->resourceID','$this->resourceName','$this->resourcePath','$this->courseID')";
        $result = $mysqli->query($sql);
        if ($result == TRUE)
            return $response->RESULT_OK;
        else
            return $response->UNKNOWN_ERROR;
    }
}