<?php
/*
*
*@desc:管理员添加课程
*/
    session_start();
    $BASE_URL="http://127.0.0.1:8000/elective/";


    /*课程编号*/
	$COUID                 =   $_POST["courseid"];
    /*授课教师*/
	$COUTEA            =   $_POST["courseteacher"];
    /*课程名称*/
    $COUNAME               =   $_POST["coursename"];
    /*上课时间*/
    $COUTIME               =   $_POST["coursetime"];
    /*上课地点*/
    $COUADDRESS            =   $_POST["courseaddress"];
    /*课程简介*/
    $COUSUMA               =   $_POST["coursesumma"];

	require_once('../models/mysql.php');
	$COU	=     new MySQL(1);
    $SQL    =     "insert into elective.cource(`courseid`,`teaid`,`coursename`,`coursetime`,`courseaddress`,`courseinfo`) values($COUID,'$COUTEA','$COUNAME','$COUTIME','$COUADDRESS','$COUSUMA')";
    if($COU->write_db($SQL))
    {
        $URL    = $BASE_URL.'views/AddCourses.php';
        header("Location:$URL");
        exit;
    }else{
        echo $SQL;
    }


?>
