<?php
	//定义页面必须验证是否登录
	define("AUTH", "TRUE");

	//载入初始化文件
	require_once("../ui/inc/init.inc.php");
	
	$fileName = $_REQUEST['filename'];
	$scanPath = $_REQUEST['scanpath'];
	echo $scanPath;
	if($scanPath == NULL) {
		echo"<script>alert('该车辆未保存扫描件信息!');history.back();</script>";
	}
	else{
		header("location:$scanPath");
	}
/*	else {
		clearstatcache();
		//header("location:$scanPath");
		download($scanPath, $fileName);
	}

	function download($scanPath, $fileName)
	{
		if(!file_exists($scanPath))  
	    { 
			header("Content-type:text/html; Charset=utf-8");
			echo"<script>alert('对不起,你要下载的文件不存在。');history.back();</script>";
	    }
		else
		{
			header('Expires: 0');
			header('Content-type: application/octet-stream');
			header("Content-Disposition: attachment; filename={$fileName}");
			header('Content-Transfer-Encoding: binary');
			@readfile($scanPath);
		}
	}*/
?>