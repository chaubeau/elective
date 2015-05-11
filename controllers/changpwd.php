<?php
/*
*修改密码
*/
    require_once('../models/mysql.php');
    $BASE_URL   =   $_COOKIE['url'];
    $USER       =   $_COOKIE['user'];
    $ROL        =   $_COOKIE['rol'];
    $login      =    new MySQL(1);
    $RPWD       =   $login->VerificationRole($ROL,$USER);
    $oldpwd     =   $_POST['oldpassword'];
    $newpwd     =   $_POST['newpassword'];
    $repwd      =   $_POST['rnewpassword'];
    $mpwd       =   md5($repwd);
    if($newpwd  != $repwd )
    {
        $info   =   "两次输入密码不一致";
        $URL    =   $BASE_URL."/views/changepassword.php?info=$info&rol=$ROL";
        header("Location:$URL");
        exit;
    }
    if($RPWD != md5($oldpwd ))
    {
        $info   =   "旧密码输入不正确";
        $URL    =   $BASE_URL."/views/changepassword.php?info=$info&rol=$ROL";
        header("Location:$URL");
        exit;
    }else{
        switch($ROL)
        {
            case "admin":
                $SQL    = "update elective.admin set adminpwd=\"$mpwd\" where adminname=\"$USER\"";
                break;
            case "student":
                $SQL    = "update elective.student set stupwd=\"$mpwd\" where stuid=$USER";
                break;
            case "teacher":
                $SQL    = "update elective.teacher set teapwd=\"$mpwd\" where stuid=$USER";
                break;
            default:
                break;
        }
        //echo $SQL;
        if($login->write_db($SQL))
        {

            header("refresh:5;url=$BASE_URL");
            echo "密码修改成功...<br>5秒后自动跳转至登陆页面";

        }
    }


?>
