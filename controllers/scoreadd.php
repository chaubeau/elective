<?php
/*
*录入成绩
*/
    $BASE_URL	=	$_COOKIE['url'];
    require_once('../models/mysql.php');
    $SCO  =   new MySQL(1);
    $info  =   $_POST;
    print_r($info);
    foreach($info as $stc=>$score)
    {
        $tmp        =   explode('#',$stc);
        $stuid      =   $tmp[0];
        $courseid   =   $tmp[1];
        $teaid      =   $tmp[2];
        $sql        =   "update elective.elect set score=$score where stuid=$stuid and teaid=$teaid and courseid=$courseid";
        echo $sql;echo "\n";
        if($SCO->write_db($sql))
        {
            $URL    = $BASE_URL."views/addscore.php?courceid=$courseid&teaid=$teaid";
            header("Location:$URL");
            exit;

        }
    }

?>
