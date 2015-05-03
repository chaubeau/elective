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
        $URL    = $BASE_URL.'views/stu.php';
        header("Location:$URL");
        exit;
    }else{
        die("退课失败");

    }



?>
