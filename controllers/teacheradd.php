<?php
    session_start();
    $BASE_URL="http://127.0.0.1:8000/elective/";
    /*
    * 管理员添加教师
    */
	$TEAID              = $_POST["teaid"];
	$TEANAME            = $_POST["teaname"];
    $DEPID              = $_POST["departid"];

	require_once('../models/mysql.php');
    $TEAPASSWORD        = md5('888888');
	$TEA	= new MySQL(1);
    /*
    * 验证输入的院系ID是否正确
    */

    $CheckDepartid  = $TEA->CheckDepartid($DEPID);
    if($CheckDepartid){
        /*
        *验证输入的教师ID是否已存在
        */
        $CheckTeacherId = $TEA->CheckTeacherid($TEAID);
        if(! $CheckTeacherId){

            $SQL    =   "insert into elective.teacher(`teaid`,`teapwd`,`teaname`,`teadepart`) values($TEAID,'$TEAPASSWORD','$TEANAME',$DEPID)";
            $TEA->write_db($SQL);
            $URL    = $BASE_URL.'views/AddTeacher.php';

            header("Location:$URL");
            exit;

        }else{
            die("系统已存在该学号的学生，学号冲突");
        }


    }else{
        die("院系号输入有误");

    }

?>
