<?php
class Class_Mysql_conn
{
	var $dbhost;
	var $dbuser;
	var $dbpass;
	var $dbname;
	var $DefaultLang;
	var $mysql_conn_type;
	var $mysqlinfo;
	var $db_result;

	function Class_Mysql_conn($dbhost,$dbuser,$dbpass,$dbname,$DefaultLang,$mysql_conn_type)
	{
		$this -> dbhost = $dbhost;
		$this -> dbuser = $dbuser;
		$this -> dbpass = $dbpass;
		$this -> dbname = $dbname;
		$this -> DefaultLang = $DefaultLang;
		$this -> mysql_conn_type = $mysql_conn_type;
	}
	
	function check_mysql_conn_type()
	{
		if($this->mysql_conn_type != "mysql" && $this->mysql_conn_type != "mysqli")
		{
			echo "请注意在dbClass.php文件中设置mysql连接的类型！";
			exit;
		}
	}
	
	function my_conn()
	{
		if($this->mysql_conn_type == "mysqli")
		{
			$this->myconn = mysqli_connect($this->dbhost,$this->dbuser,$this->dbpass) or die("连接数据库出错！可能是以下的原因：<p>&nbsp;1、数据库连接参数没有设置正确！<br>2、请注意你的MYSQL数据库版本是否过低，不能支持mysqli的连接与查询方式，请在主配置文件中进行更改！");
		} else {
			$this->myconn = mysql_connect($this->dbhost,$this->dbuser,$this->dbpass) or die("数据库连接失败，请检查！");
		}
	}

	function select_db()
	{
		if($this->mysql_conn_type == "mysqli")
		{
			mysqli_select_db($this->myconn,$this->dbname) or die("没有设置的数据库！请检查！");
		
		} else {
			mysql_select_db($this->dbname)  or die("没有设置的数据库！请检查！");
		}
	}

	function getmysqlinfo()
	{
		if($this->mysql_conn_type == "mysqli") {
            $this -> mysqlinfo = mysqli_get_server_info($this->myconn);
            $this -> mysqlinfo = substr($this->mysqlinfo,0,2);
		
		} else {
            $this -> mysqlinfo = mysql_get_server_info($this->myconn);
            $this -> mysqlinfo = substr($this->mysqlinfo,0,2);
		}
    }

	function mysql_DefaultLang()
	{
		if($this -> mysqlinfo > 4)
		{
			if($this->mysql_conn_type == "mysqli")
			{
				@mysqli_query($this->myconn,"SET NAMES '$this->DefaultLang'") or die("你设置的数据库字符集不正确！请检查！");
			
			} else {
				@mysql_query("SET NAMES '$this->DefaultLang'",$this->myconn) or die("你设置的数据库字符集不正确！请检查！");
			}
		}
	}

	function my_query($strsql)
	{
		if($this->mysql_conn_type == "mysqli")
		{
			return $this->db_result = mysqli_query($this->myconn,$strsql);
		} else {
			return $this->db_result = mysql_query($strsql,$this->myconn);
		}
	}

	function my_error()
	{
		if($this->mysql_conn_type == "mysqli")
		{
			mysqli_error($this->myconn);
		} else {
			mysql_error();
		}
	}

	function my_close()
	{
		if($this->mysql_conn_type == "mysqli")
		{
			mysqli_close($this->myconn);
		} else {
			mysql_close($this->myconn);
		}
	}
}
?>
