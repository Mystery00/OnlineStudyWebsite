<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/13/2018
 * Time: 18:40
 */

function connect()
{
    $mysqli = new mysqli(SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($mysqli->connect_errno) {
        return false;
    }
    return $mysqli;
}


