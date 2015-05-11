<?php
/*
*
*@desc:管理员添加课程
*/
    require_once('../models/mysql.php');
    $BASE_URL               =    $_COOKIE['url'];
    /*课程编号*/
    $COUID                  =    $_POST["courseid"];
    /*授课教师*/
    $COUTEA                 =    $_POST["courseteacher"];
    /*课程名称*/
    $COUNAME                =    $_POST["coursename"];
    /*上课时间*/
    $COUTIME                =    $_POST["coursetime"];
    /*上课地点*/
    $COUADDRESS             =    $_POST["courseaddress"];
    /*课程简介*/
    $COUSUMA                =    $_POST["coursesumma"];
    $COU                    =    new MySQL(1);
    $SQL                    =     "insert into elective.cource(`courseid`,`teaid`,`coursename`,`coursetime`,`courseaddress`,`courseinfo`) values($COUID,'$COUTEA','$COUNAME','$COUTIME','$COUADDRESS','$COUSUMA')";
    if($COU->write_db($SQL))
    {
        $URL    = $BASE_URL.'views/AddCourses.php';
        header("Location:$URL");
        exit;
    }else{
        header("refresh:2;url=$$URL");
        echo "添加课程失败...<br>2秒后自动跳转至添加课程页面";
        exit;
    }


?>
