<?php
function funmessage($backurl, $messagelang, $waittime)
{
	header("refresh:$waittime;url=$backurl");
?>
<table width="600" border="0" align="center" cellpadding="3" cellspacing="0" style="border:#C4EAFB 1px solid;">
	<tr>
		<td width="407" height="18" bgcolor="#f3f3f3">提示信息</td>
	</tr>
	<tr>
		<td height="88" bgcolor="#f9f9f9">
			<? echo "$messagelang";echo "<br>页面正在跳转，请等待........<br><br><br><a  href='"."$backurl"."'>如果页面没有自动跳转请点击这里</a>";	?>
    	</td>
    </tr>
</table>
<?
}

//从生日获取年龄函数
function bdayage($birthday)
{
	$bday = $birthday;
	if ($bday == "0000-00-00" || $bday == "")
	{
		$age = "未知";
	}
	else
	{
		$tday = date("Y-m-d");
		$tempb1 = intval(substr($bday,0,4));
		$tempt1 = intval(substr($tday,0,4));
		$agetemp = $tempt1 - $tempb1;
		$tempb2 = intval(substr($bday,5,2));
		$tempt2 = intval(substr($tday,5,2));
		if($tempt2 > $tempb2)
		{//判断月份的
			$age = $agetemp + 1;
		}//判断月份的
		elseif($tempt2 < $tempb2)
		{//判断月份的
			$age = $agetemp;
		}//判断月份的
		else
		{//判断月份的
			$tempb3 = intval(substr($bday,8,2));
			$tempt3 = intval(substr($tday,8,2));
			if($tempt3 > $tempb3)
			{//判断日
				$age = $agetemp + 1;
			}
			else
			{
				$age = $agetemp;
			}//判断日
		}//判断月份的
	}
	echo "$age";
}

//检测性别
function checksex($sex)
{
	if($sex == 1)
	{
		return "男";
	}	elseif ($sex == 2) {
		return "女";
	} else {
		return "未知";
	}
}

// 判断ID
function judgeid($id)
{
	if(empty($id) || !ereg("^[1-9][0-9]*",$id))
	{
		funmessage("javascript:history.go(-1)", $templang['emptytype'], $backtime);
		exit();
	}
}

function getip()
{
	if (isset($HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"]))
	{
		$ip = $HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"];
	}
	elseif (isset($HTTP_SERVER_VARS["HTTP_CLIENT_IP"]))
	{
		$ip = $HTTP_SERVER_VARS["HTTP_CLIENT_IP"];
	}
	elseif (isset($HTTP_SERVER_VARS["REMOTE_ADDR"]))
	{
		$ip = $HTTP_SERVER_VARS["REMOTE_ADDR"];
	}
	elseif (getenv("HTTP_X_FORWARDED_FOR"))
	{
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	}
	elseif (getenv("HTTP_CLIENT_IP"))
	{
		$ip = getenv("HTTP_CLIENT_IP");
	}
	elseif (getenv("REMOTE_ADDR"))
	{
		$ip = getenv("REMOTE_ADDR");
	}
	else
	{
		$ip = "Unknown";
	}
	return $ip ;
}

//判断当数据为空的时候，输出空格，防止表格不打印单元格
function tableempty($data)
{
	if(empty($data))
	{
		echo "&nbsp;";
	} else {
		echo $data;
	}
}

function compare_date( $DATE1, $DATE2 )
{
    $STR = strtok( $DATE1, "-" );
    $YEAR1 = $STR;
    $STR = strtok( "-" );
    $MON1 = $STR;
    $STR = strtok( "-" );
    $DAY1 = $STR;
    $STR = strtok( $DATE2, "-" );
    $YEAR2 = $STR;
    $STR = strtok( "-" );
    $MON2 = $STR;
    $STR = strtok( "-" );
    $DAY2 = $STR;
    if (($YEAR1 >= $YEAR2) && ($MON1 >= $MON2) && ($DAY1 >= $DAY2))
    {  
        return 1;
    }
    return 0;
}
?>