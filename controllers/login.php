<?php
/*
*登录验证模块
*/
	$BASE_URL	=	$_COOKIE['url'];
	$USER		= 	$_POST["username"];
	$PWD		= 	$_POST["password"];
	$ROL		= 	$_POST["role"];
	require_once('../models/mysql.php');
	$login	= new MySQL(1);
    $RPWD	= $login->VerificationRole($ROL,$USER);
	$URL	= $BASE_URL.'/views/error.php';
	if("$RPWD" == md5($PWD))
	{
		switch($ROL)
		{
			case "admin":
				$URL				=	$BASE_URL."/views/admin.php?user=$USER";
				break;
			case "student":
				$URL				=	$BASE_URL."/views/stu.php?user=$USER";
				break;
			case "teacher":
				$URL				=	$BASE_URL."/views/tea.php?user=$USER";
				break;
			default:
				$URL				= 	$BASE_URL.'/views/error.php';
		}
		header("Location:$URL");
		exit;
    }else{
		header("Location:$URL");
		exit;
    }


?>
