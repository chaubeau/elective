<?php
/*
*退课
*/
    $BASE_URL	=	$_COOKIE['url'];
    $STU        =   $_GET['stuid'];
    $COU        =   $_GET['courseid'];
    $TEA        =   $_GET['tea'];
    require_once('../models/mysql.php');
    $ELECT  =   new MySQL(1);
    $sql    =   "delete from elective.elect where `stuid`=$STU and `courseid`=$COU and  `teaid`=$TEA";
    if($ELECT->write_db($sql))
    {
        $URL    = $BASE_URL."views/stu.php?user=$STU";
        header("Location:$URL");
        exit;
    }else{
        header("refresh:2;url=$$URL");
        echo "退课失败...<br>2秒后自动跳转至退课页面";
        exit;

    }



?>
