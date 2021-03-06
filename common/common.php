<?php
/**
 * Created by IntelliJ IDEA.
 * User: myste
 * Date: 05/14/2018
 * Time: 01:31
 */

define('DIR', $_SERVER['DOCUMENT_ROOT']);
require DIR . '/config/config.php';
require DIR . '/config/database.php';

require DIR . '/classes/Choose.php';
require DIR . '/classes/Course.php';
require DIR . '/classes/Resource.php';
require DIR . '/classes/Response.php';
require DIR . '/classes/Student.php';
require DIR . '/classes/Teacher.php';
require DIR . '/classes/User.php';
require DIR . '/classes/ListCourse.php';
require DIR . '/classes/CourseGrade.php';

require DIR . '/classes/response/ReturnResponse.php';
require DIR . '/classes/response/LoginResponse.php';
require DIR . '/classes/response/RegisterResponse.php';
require DIR . '/classes/response/UpdatePasswordResponse.php';
require DIR . '/classes/response/GetInfoResponse.php';
require DIR . '/classes/response/UpdateInfoResponse.php';
require DIR . '/classes/response/NewCourseResponse.php';
require DIR . '/classes/response/ChooseCourseResponse.php';
require DIR . '/classes/response/DeleteCourseResponse.php';
require DIR . '/classes/response/SearchCourseResponse.php';
require DIR . '/classes/response/NewCourseResourceResponse.php';
require DIR . '/classes/response/ListCourseResourcesResponse.php';
require DIR . '/classes/response/DeleteCourseResourceResponse.php';
require DIR . '/classes/response/UpdateStudentCourseResponse.php';

require DIR . '/helpers/func.php';

require DIR . '/util/MysqlUtil.php';
require DIR . '/util/ResponseUtil.php';
