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
			echo "��ע����dbClass.php�ļ�������mysql���ӵ����ͣ�";
			exit;
		}
	}
	
	function my_conn()
	{
		if($this->mysql_conn_type == "mysqli")
		{
			$this->myconn = mysqli_connect($this->dbhost,$this->dbuser,$this->dbpass) or die("�������ݿ�������������µ�ԭ��<p>&nbsp;1�����ݿ����Ӳ���û��������ȷ��<br>2����ע�����MYSQL���ݿ�汾�Ƿ���ͣ�����֧��mysqli���������ѯ��ʽ�������������ļ��н��и��ģ�");
		} else {
			$this->myconn = mysql_connect($this->dbhost,$this->dbuser,$this->dbpass) or die("���ݿ�����ʧ�ܣ����飡");
		}
	}

	function select_db()
	{
		if($this->mysql_conn_type == "mysqli")
		{
			mysqli_select_db($this->myconn,$this->dbname) or die("û�����õ����ݿ⣡���飡");
		
		} else {
			mysql_select_db($this->dbname)  or die("û�����õ����ݿ⣡���飡");
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
				@mysqli_query($this->myconn,"SET NAMES '$this->DefaultLang'") or die("�����õ����ݿ��ַ�������ȷ�����飡");
			
			} else {
				@mysql_query("SET NAMES '$this->DefaultLang'",$this->myconn) or die("�����õ����ݿ��ַ�������ȷ�����飡");
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
