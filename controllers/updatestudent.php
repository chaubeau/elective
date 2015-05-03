<?php
/*
*管理员修改学生相关
*/
    require_once('../models/mysql.php');
    $STU	= new MySQL(1);
    $value  = $_POST["value"];
    $text   = explode("#",$_POST["id"]);
    $stuid  = $text[0];
    $stuvol = $text[1];
    if($stuvol == "stuid")
    {
        if($value != "")
        {
            die("学生学号无法修改，只能删除该学生");
        }
    }
    switch($stuvol)
    {
        case "stuGrade":
            $sql    =   "update elective.student set stuGrade='$value' where stuid=$stuid";
            break;
        case "stuClass":
            $sql    =   "update elective.student set stuClass='$value' where stuid=$stuid";
            break;
        case "stuname":
            $sql    =   "update elective.student set stuname='$value' where stuid=$stuid";
            break;
        case "stuid":
            $sql    =   "delete from elective.student where  stuid=$stuid";
            break;
        default:
            break;
    }
    if($STU->write_db($sql))
    {
        if($stuvol == "stuid")
        {
            echo "已注销学号";

        }else{
            echo $value;
        }

    }else{
        echo "ERROR";
    }

?>
