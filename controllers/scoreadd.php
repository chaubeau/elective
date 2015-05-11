<?php
/*
*录入成绩
*/
    require_once('../models/mysql.php');
    $BASE_URL   =    $_COOKIE['url'];
    $SCO        =   new MySQL(1);
    $info       =   $_POST;
    print_r($info);
    foreach($info as $stc=>$score)
    {
        $tmp        =   explode('#',$stc);
        $stuid      =   $tmp[0];
        $courseid   =   $tmp[1];
        $teaid      =   $tmp[2];
        $sql        =   "update elective.elect set score=$score where stuid=$stuid and teaid=$teaid and courseid=$courseid";
        if($SCO->write_db($sql))
        {
            $URL    = $BASE_URL."views/addscore.php?courceid=$courseid&teaid=$teaid";
            header("Location:$URL");
            exit;

        }else{
            header("refresh:2;url=$URL");
            echo "录入成绩失败...<br>2秒后自动跳转至录入成绩页面";
            exit;
        }

    }

?>
