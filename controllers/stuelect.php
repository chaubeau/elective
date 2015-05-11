<?php
/*
*学生选课
*/
    $BASE_URL	=	$_COOKIE['url'];
    $stuid      =   $_COOKIE['user'];
    $STU        =   $_GET['stuid'];
    $COU        =   $_GET['courseid'];
    $TEA        =   $_GET['tea'];
    $tmp        =   array();
    preg_match_all("/(?:\()(.*)(?:\))/i",$TEA, $tmp);
    $TEAID      =   $tmp[1][0];
    $SCORE      =   0;

    require_once('../models/mysql.php');
    $ELECT      =   new MySQL(1);
    $sql        =   "insert into elective.elect(`stuid`,`courseid`,`teaid`,`score`) values($STU,$COU,$TEAID,$SCORE)";
    if($ELECT->write_db($sql))
    {
        $URL    =$BASE_URL."views/stu.php?user=$stuid";
        header("Location:$URL");
        exit;
    }else{
        header("refresh:2;url=$URL");
        echo "选课失败...<br>2秒后自动跳转至选课页面";
        exit;
    }



?>
