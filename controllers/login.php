<?php
	$BASE_URL="http://127.0.0.1:8000/elective/"

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
				$URL	= $BASE_URL.'/views/admin.php';
				break;
			case "student":
				$URL	= $BASE_URL.'/views/stu.php';
				break;
			case "teacher":
				$URL	= $BASE_URL.'/views/tea.php';
				break;
			default:
				$URL	= $BASE_URL.'/views/error.php';
		}

		header("Location:$URL");
		exit;
    }else{
        require_once($BASE_URL.'/views/error.php');
    }


?>
