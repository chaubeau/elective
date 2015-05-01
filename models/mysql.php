<?php
/***************************
* 数据库相关的操作类
* @author xiaobo
* @version V1
**************************/

class MySQL
{
	private $handle;

	public function __construct()
	{
		$this->handle = mysql_connect("127.0.0.1:3306","homestead","secret");

	}
	public function __destruct()
	{
		if(isset($this->handle))
       	{
            		mysql_close($this->handle);
        	}
	}
	public function set_username($username)
    	{
        	$this->username = $username;
    	}

	public function set_role($role)
    	{
        	$this->role 	= $role;
    	}
	/*
	* @desc:Get password
	*/
	public function VerificationRole()
    {
        $RolePassword="FUCK";
		switch($this->role)
		{
			case 'admin':
				$SQL	    =	 "select adminpwd pwd from elective.admin where adminname='$this->username';";
				break;
			case 'teacher':
				$SQL	    = 	 "select teapwd pwd from elective.teacher where tename='$this->username';";
				break;
			case 'student':
				$SQL	    =	 "select stupwd pwd from elective.student where stuname='$this->username';";
				break;
			default:
				return FALSE;
		}
		$query	= mysql_query($SQL,$this->handle);
		while( $result = mysql_fetch_array($query) )
        {
            $RolePassword   =       $result["pwd"];
        }
        return    $RolePassword;
    }

    /*
     * @desc:write data to DB
     */
    public function write_db($sql)
    {
		mysql_set_charset("utf8", $this->handle);
        if(mysql_query($sql,$this->handle))
		{
			return true;
		}else{
			return false;
		}
    }
    /*
     *@desc: get all student infomation
     */
    public function GetAllStudent()
    {
		$stuinfo	= 	array();
        $sql    	=   "select * from elective.student";
		mysql_set_charset("utf8", $this->handle);
        $query		= 	mysql_query($sql,$this->handle);
        while($result = mysql_fetch_array($query)){
			$stuinfo[$result['stuid']]['name']			=	$result['stuname'];
			$stuinfo[$result['stuid']]['stuDepart']		=	$result['stuDepart'];
			$stuinfo[$result['stuid']]['stuGrade']		=	$result['stuGrade'];
			$stuinfo[$result['stuid']]['stuClass']		=	$result['stuClass'];
		}

		return $stuinfo;

    }
	/*
	*@desc:get all teacher information
	*/
	public function GetAllTeacher()
	{
		$teainfo	= array();
		$sql		= "select * from elective.teacher";
		mysql_set_charset("utf8", $this->handle);
		$query		= 	mysql_query($sql,$this->handle);
		while($result = mysql_fetch_array($query)){
			$teainfo[$result['teaid']]['name']			=	$result['teaname'];
			$teainfo[$result['teaid']]['teadepart']		=	$result['teadepart'];
		}

		return $teainfo;
	}
	/*
	*@desc: check departid
	*/
	public function CheckDepartid($depid)
	{
		$sql	= "select departname from elective.depart where departid=$depid";
		$query	= mysql_query($sql,$this->handle);
		while($result = mysql_fetch_array($query)){
				$departname	= $result['departname'];
		}
		if($departname == '')
		{
			return false;
		}else{
			return true;
		}
	}
	/*
	*@desc: check student id
	*/
	public function CheckStudentid($stuid)
	{
		$sql	= "select stuname from elective.student where stuid=$stuid";
		$query	= mysql_query($sql,$this->handle);
		while($result = mysql_fetch_array($query)){
				$stuname	= $result['stuname'];
		}
		if($stuname == '')
		{
			return false;
		}else{
			return true;
		}
	}
	/*
	*@desc: check teacher id
	*/
	public function CheckTeacherid($teaid)
	{

		$sql	= "select teaname from elective.student where teaid=$teaid";
		$query	= mysql_query($sql,$this->handle);
		while($result = mysql_fetch_array($query)){
				$teaname	= $result['teaname'];
		}
		if($teaname == '')
		{
			return false;
		}else{
			return true;
		}
	}
	/*
	*@desc:get departname by departid
	*/
	public function GetDepartName($departid)
	{
		$sql			=	"select departname from elective.depart where departid=$departid";
		$departname		=	"NULL";
		mysql_set_charset("utf8", $this->handle);
		$query			= 	mysql_query($sql,$this->handle);
		if($result 	= 	mysql_fetch_array($query)){
			$departname	=	$result['departname'];
		}

		return $departname;
	}

}
?>
