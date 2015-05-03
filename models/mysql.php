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
	public function VerificationRole($role,$user)
    {

		switch($role)
		{
			case "admin":
				$SQL	    =	 "select adminpwd pwd from elective.admin where adminname='$user'";
				break;
			case "teacher":
				$SQL	    = 	 "select teapwd pwd from elective.teacher where teaid='$user'";
				break;
			case "student":
				$SQL	    =	 "select stupwd pwd from elective.student where stuid='$user'";
				break;
			default:
				break;
		}
		mysql_set_charset("utf8", $this->handle);
		$query			=	mysql_query($SQL,$this->handle);
		$result 		=	mysql_fetch_array($query);
        $RolePassword   =	$result["pwd"];
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
	*@desc:get student name by stuid
	*/
	public function GetStudentName($stuid)
	{
		$sql		=	"select stuname from elective.student where stuid=$stuid";
		mysql_set_charset("utf8", $this->handle);
		$query		= 	mysql_query($sql,$this->handle);
		$result 	= 	mysql_fetch_array($query);
		$stuname	=	$result['stuname'];
		return $stuname;
	}
	/*
	*
	*@desc:get teacher name by teaid
	*/
	public function GetTeacherName($teaid)
	{
		$sql		=	"select teaname from elective.teacher where teaid=$teaid";
		mysql_set_charset("utf8", $this->handle);
		$query		= 	mysql_query($sql,$this->handle);
		$result 	= 	mysql_fetch_array($query);
		$teaname	=	$result['stuname'];
		return $teaname;

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
	*@desc:get all courses information
	*/
	public function GetAllCourses()
	{
		$courseinfo		=	array();
		$sql			=	"select * from elective.cource";
		mysql_set_charset("utf8", $this->handle);
		$query		= 	mysql_query($sql,$this->handle);
		while($result = mysql_fetch_array($query)){
			$courseinfo[$result['courseid']]['teaid']			=	$result['teaid'];
			$courseinfo[$result['courseid']]['coursename']		=	$result['coursename'];
			$courseinfo[$result['courseid']]['coursetime']		=	$result['coursetime'];
			$courseinfo[$result['courseid']]['courseaddress']	=	$result['courseaddress'];
			$courseinfo[$result['courseid']]['courseinfo']		=	$result['courseinfo'];
		}
		return $courseinfo;
	}
	/*
	*@desc:get elective by stuid
	*/
	public function GetElectiveStuid($stuid)
	{
		$electinfo		=	array();
		$sql			=	"select c.courseid,c.coursename,c.coursetime,c.courseaddress,t.teaname,t.teaid from elective.cource c join elective.elect e join elective.teacher t where e.stuid=$stuid and c.courseid= e.courseid  and t.teaid=e.teaid;";
		mysql_set_charset("utf8", $this->handle);
		$query			= 	mysql_query($sql,$this->handle);
		while($result 	= 	mysql_fetch_array($query)){
			$electinfo[$result['courseid']]['teaname']			=	$result['teaname'];
			$electinfo[$result['courseid']]['teaid']			=	$result['teaid'];
			$electinfo[$result['courseid']]['coursename']		=	$result['coursename'];
			$electinfo[$result['courseid']]['coursetime']		=	$result['coursetime'];
			$electinfo[$result['courseid']]['courseaddress']	=	$result['courseaddress'];
		}
		return $electinfo;
	}
	/*
	*@desc: get unelective by stuid
	*/
	public function GetUnlectiveStuid($stuid)
	{
		$electinfo	=	array();
		$sql		=	"select courseid,teaid,coursename,coursetime,courseaddress,courseinfo from elective.cource where  courseid not in (select courseid from elective.elect where stuid=$stuid)";
		mysql_set_charset("utf8", $this->handle);
		$query		= 	mysql_query($sql,$this->handle);
		while($result = mysql_fetch_array($query)){
			$electinfo[$result['courseid']]['teaid']			=	$result['teaid'];
			$electinfo[$result['courseid']]['coursename']		=	$result['coursename'];
			$electinfo[$result['courseid']]['coursetime']		=	$result['coursetime'];
			$electinfo[$result['courseid']]['courseaddress']	=	$result['courseaddress'];
			$electinfo[$result['courseid']]['courseinfo']		=	$result['courseinfo'];
		}
		return $electinfo;
	}
	/*
	*@desc:get teacher courcename by teaid
	*/
	public function GetTeacherCourcename($teaid)
	{
		$courcename		=	array();
		$sql1			=	"select teaname from elective.teacher where teaid=$teaid";
		mysql_set_charset("utf8", $this->handle);
		$query1			= 	mysql_query($sql1,$this->handle);
		$result1		=	mysql_fetch_array($query1);
		$teaname		=	$result1['teaname'];
		$tea			=	$teaname.'('.$teaid.')';
		$sql2			=	"select coursename,courseid from elective.cource  where teaid =\"$tea\"";
		$query2			=	mysql_query($sql2,$this->handle);
		while($result2 	= 	mysql_fetch_array($query2)){

			$courcename[$result2['courseid']]['coursename']		=	$result2['coursename'];
		}
		return $courcename;
	}
	/*
	*@desc：get elect information by teadid and courceid
	*/
	public function GetCourceInfo($teaid,$courceid)
	{
		$info	=	array();
		$sql	=	"select s.stuid,s.stuname,s.stuGrade,s.stuClass,d.departname from elective.student s join elective.depart d where s.stuDepart=d.departid and stuid in (select stuid from elective.elect where teaid=$teaid and courseid=$courceid);";
		mysql_set_charset("utf8", $this->handle);
		$query	= mysql_query($sql,$this->handle);
		while($result = mysql_fetch_array($query)){
			$info[$result['stuid']]['stuname']		=	$result['stuname'];
			$info[$result['stuid']]['departname']	=	$result['departname'];
			$info[$result['stuid']]['stuGrade']		=	$result['stuGrade'];
			$info[$result['stuid']]['stuClass']		=	$result['stuClass'];
		}
		return $info;
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

		$sql	= "select teaname from elective.teacher where teaid=$teaid";
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
