<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 03:32
 */

echo substr(strtoupper(md5(date("Y-m-d H:i:s"))),0,20);