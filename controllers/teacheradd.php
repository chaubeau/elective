<?php
    /*
    * 管理员添加教师
    */

    require_once('../models/mysql.php');
    $BASE_URL           = $_COOKIE['url'];
    $TEAID              = $_POST["teaid"];
    $TEANAME            = $_POST["teaname"];
    $DEPID              = $_POST["departid"];
    $TEAPASSWORD        = md5('888888');
    $TEA                = new MySQL(1);
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
            header("refresh:2;url=$URL");
            echo "添加失败，已存在该ID的教师...<br>2秒后自动跳转至添加教师页面";
            exit;
        }


    }else{
        header("refresh:2;url=$URL");
        echo "院系输入有误...<br>2秒后自动跳转至添加教师页面";
        exit;

    }

?>
