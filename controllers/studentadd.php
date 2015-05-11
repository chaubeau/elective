<?php
/*
*管理员添加学生
*/
    $BASE_URL           = $_COOKIE['url'];
    $STUID              = $_POST["stuid"];
    $STUNAME            = $_POST["stuname"];
    $DEPID              = $_POST["departid"];
    $STUGRADE           = $_POST["stugrade"];
    $STUCLASS           = $_POST["stuclass"];

    require_once('../models/mysql.php');
    $STUPASSWORD        = md5('000000');
    $STU                = new MySQL(1);
    /*
    * 验证输入的院系ID是否正确
    */


    $CheckDepartid  = $STU->CheckDepartid($DEPID);
    if($CheckDepartid){
        /*
        *验证输入的学生ID是否已存在
        */
        $CheckStudentId = $STU->CheckStudentid($STUID);
        if(! $CheckStudentId){

            $SQL    =   "insert into elective.student(`stuid`,`stupwd`,`stuname`,`stuDepart`,`stuGrade`,`stuClass`)   values($STUID,'$STUPASSWORD','$STUNAME',$DEPID,$STUGRADE,$STUCLASS)";
            $STU->write_db($SQL);
            $URL    = $BASE_URL.'views/AddStu.php';

            header("Location:$URL");
            exit;

        }else{
            header("refresh:2;url=$URL");
            echo "学号有冲突...<br>2秒后自动跳转至添加学生页面";
            exit;
        }


    }else{
        header("refresh:2;url=$URL");
        echo "所输入的院系号不存在...<br>2秒后自动跳转至添加学生页面";
        exit;

    }

?>
