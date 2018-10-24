<?php
		header("Content-Type:text/html;charset=utf-8");
		define("ROOT_PATH", str_replace("install/ajax.php", "", str_replace("\\", "/", __FILE__)));
		$t = $_GET["t"];

        $sqlIp = $_GET["ip"];
        $sqlLoginName = $_GET["loginname"];
        $sqlLoginAuth = $_GET["loginpwd"];
        $dbName = $_GET["dbname"];

        switch ($t)
        {
            case "checkdbconnection"://检查数据库连接
                CheckDBConnection($sqlIp, $sqlLoginName, $sqlLoginAuth);
                break;
            case "createdb"://创建新的数据库
                CreateDatabase($sqlIp, $sqlLoginName, $sqlLoginAuth, $dbName);
                break;
            case "dbsourceexist":
                DBSourceExist($sqlIp, $sqlLoginName, $sqlLoginAuth, $dbName);
                break;
            case "createtable"://创建数据库表
                CreateTable($sqlIp, $sqlLoginName, $sqlLoginAuth, $dbName);
                break;
        }

		function CheckDBConnection($sqlIp, $sqlUsername, $sqlPassword)
		{
			 @$conn = mysqli_connect($sqlIp,$sqlUsername,$sqlPassword) or die('{result:false,message:"'.mysqli_connect_error().'",code:"' . mysqli_errno($conn) . '"}');
			 echo '{result:true,message:"连接成功"}';
		}

		function DBSourceExist($sqlIp, $sqlUsername, $sqlPassword, $databaseName)
		{
			$conn = mysqli_connect($sqlIp,$sqlUsername,$sqlPassword) or die('{result:false,code:"' . mysqli_connect_error() . '"}');

			mysqli_select_db($conn,$databaseName) or die('{result:false,code:"' . mysqli_errno($conn) . '"}');
			
			echo "{result:true,message:\"数据库已存在\",code:0}";
		}

		function CreateDatabase($sqlIp, $sqlUsername, $sqlPassword, $databaseName)
		{
			$conn = mysqli_connect($sqlIp,$sqlUsername,$sqlPassword) or die('{result:false,code:"' . mysqli_connect_error() . '"}');
			mysqli_query($conn,"CREATE DATABASE IF NOT EXISTS {$databaseName}") or die('{result:false,code:"' . mysqli_errno($conn) . '"}');
			echo "{result:true,message:\"数据库创建成功\"}";
		}

		function CreateTable($sqlIp, $sqlUsername, $sqlPassword, $databaseName)
		{
			$conn = mysqli_connect($sqlIp,$sqlUsername,$sqlPassword) or die('{result:false,code:"' . mysqli_connect_error() . '"}');
			mysqli_select_db($conn,$databaseName) or die('{result:false,code:"' . mysqli_errno($conn) . '"}');

			mysqli_query($conn,"SET NAMES 'utf8'");
			$sql=file_get_contents("tms_v1_sql_tables.sql");
			foreach(explode(";", trim($sql)) as $query)
			{
				mysqli_query($conn,$query) or die('{result:false(creating tables),code:"' . mysqli_errno($conn) . '"}');
			}
			/* no storage procedures needed any more
			$sql=file_get_contents("tms_v1_sql_sps.sql");
			foreach(explode("//", trim($sql)) as $query)
			{
				mysqli_query($conn,$query) or die('{result:false(creating storage procedures),code:"' . mysqli_errno($conn) . '"}');
			}*/
			$config = file_get_contents("config.db.txt");
			$config = str_replace("@HOST", $sqlIp, $config);
			$config = str_replace("@USER", $sqlUsername, $config);
			$config = str_replace("@PWD", $sqlPassword, $config);
			$config = str_replace("@NAME", $databaseName, $config);
			$file = fopen(ROOT_PATH . '/ui/inc/config.db.php', 'w');
			fwrite($file, $config);
			fclose($file);
			echo "{result:true,message:\"数据库及表创建成功\"}";
		}
?>