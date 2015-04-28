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
        mysql_query($sql,$this->handle);
    }
    /*
     *@desc: get all student infomation
     */
    public function GetAllStudent()
    {
        $sql    =   "select * from elective.student";
        $query  = mysql_query($sql,$this-handle);
        while($result = mysql_fetch_array($query)

    }
     
}
?>
