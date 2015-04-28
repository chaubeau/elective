<?php
	$USER	= $_POST["username"];
	$PWD	= $_POST["password"];
	$ROL	= $_POST["role"];
	require_once('../models/mysql.php');
	$login	= new MySQL(1);
	$login->set_role($ROL);
	$login->set_username($USER);
    $RPWD	= $login->VerificationRole();
	if($RPWD == md5($PWD))
	{
		switch($ROL)
		{
			case "admin":
				require_once("../views/admin.php");
				break;
			case "student":
				require_once("../views/stu.php");
				break;
			case "teacher":
				require_once("../views/tea.php");
				break;
			default:
				require_once("../views/error.php");
		}
    }else{
        require_once("../views/error.php");
    }


?>
