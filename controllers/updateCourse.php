<?php
/*
*管理员修改课程相关
*/
    require_once('../models/mysql.php');
    $COU	        = new MySQL(1);
    $value          = $_POST["value"];
    $text           = explode("#",$_POST["id"]);
    $courseid       = $text[0];
    $couvol         = $text[1];
    if($couvol == "courseid")
    {
        if($value != "")
        {
            die("课程编号无法修改，只能删除该课程");
        }
    }
    if($couvol == "teaid")
    {
        $tmp     = array();
        preg_match_all("/(?:\()(.*)(?:\))/i",$value, $tmp);
        $id      = $tmp[1][0];
        if(! $COU->CheckTeacherid($id))
        {
            //echo $id;
            die("教师ID不存在");
        }
    }
    switch($couvol)
    {
        case "coursename":
            $sql    =   "update elective.cource set coursename='$value' where courseid=$courseid";
            break;
        case "teaid":
            $sql    =   "update elective.cource set teaid='$value' where courseid=$courseid";
            break;
        case "coursetime":
            $sql    =   "update elective.cource set coursetime='$value' where courseid=$courseid";
            break;
        case "courseaddress":
            $sql    =   "update elective.cource set courseaddress='$value' where courseid=$courseid";
            break;
        case "courseinfo":
            $sql    =   "update elective.cource set courseinfo='$value' where courseid=$courseid";
            break;
        case "courseid":
            $sql    =   "delete from elective.cource where  courseid=$courseid";
            break;
        default:
            break;
    }

    if($COU->write_db($sql))
    {
        if($couvol == "courseid")
        {
            echo "已删除该课程";

        }else{
            echo $value;
        }

    }else{
        echo "ERROR";
    }

?>
