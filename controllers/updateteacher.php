<?php
/*
*管理员修改教师相关
*/
    require_once('../models/mysql.php');
    $TEA    = new MySQL(1);
    $value  = $_POST["value"];
    $text   = explode("#",$_POST["id"]);
    $teaid  = $text[0];
    $teavol = $text[1];
    if($teavol == "teaid")
    {
        if($value != "")
        {
            die("教师号无法修改，只能删除该教师");
        }
    }
    switch($teavol)
    {
        case "teaname":
            $sql    =   "update elective.teacher set teaname='$value' where teaid=$teaid";
            break;
        case "teaid":
            $sql    =   "delete from elective.teacher where  teaid=$teaid";
            break;
        default:
            break;
    }
    if($TEA->write_db($sql))
    {
        if($teavol == "teaid")
        {
            echo "已注销教师号";

        }else{
            echo $value;
        }

    }else{
        echo "ERROR";
    }

?>
