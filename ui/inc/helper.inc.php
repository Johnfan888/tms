<?php
	//记录日志
	function writeLog($msg, $logFileName="tms.log")
	{
		$basepath =  '/var/log/isbtc';
		if(!file_exists($basepath))
			mkdir($basepath);

		$logFullPath = $basepath . "/{$logFileName}";
		if(file_exists($logFullPath) && (filesize($logFullPath) > 1024 * 1024 * 10)) {
			$newLogFullPath = $logFullPath . "-" . date('Ymd');
			rename($logFullPath, $newLogFullPath);
		}
		
		$fp = fopen($logFullPath, 'ab');
		fwrite($fp, date('Y-m-d H:i:s') . ": $msg\n");
		fclose($fp);
	}
?>
