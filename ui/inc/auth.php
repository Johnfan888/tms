<?php
$userID = $_COOKIE["{$config_cookie_head}_UserID"];
$userName = $_COOKIE["{$config_cookie_head}_UserName"];
$userPass = $_COOKIE["{$config_cookie_head}_UserPassword"];
$userGroupID = $_COOKIE["{$config_cookie_head}_UserGroupID"];
$userGroupName = $_COOKIE["{$config_cookie_head}_UserGroupName"];
$userStationID = $_COOKIE["{$config_cookie_head}_UserStationID"];
$userStationName = $_COOKIE["{$config_cookie_head}_UserStationName"];


$strsql = "select ui_UserGroupID from tms_sys_UsInfor where ui_UserID = '$userID' and ui_UserPassword = '$userPass' and ui_UserGroupID = '$userGroupID'";
$result = $class_mysql_default ->my_query($strsql);
if(mysqli_num_rows($result) != 1)
{
	echo "<script>alert('您无权访问此页面!请检查是否正确登录。');history.back();</script>";
}


$userIP = $_SERVER['REMOTE_ADDR'];
$userState = "在线";
$str = "select * from tms_sys_OnlineUser where ui_UserID = '$userID'";//";//'$userID'";
$query = $class_mysql_default ->my_query($str);
if(mysqli_num_rows($result)!=1)
{
        echo "<script>alert('您无权访问此页面!请检查是否正确登录。');
        top.location.href = '../ui/login.php?action=login';
        </script>";        
}

$rows = mysqli_fetch_array($query);
$ip = $rows['ui_UserIP'];
$status = $rows['ui_UserState'];
   
if($userIP != $ip) 
{
        $ip = $rows['ui_UserIP'];
        $ops = "login"; 
        echo "<script>  if(confirm('您已使用IP:'+'$ip'+'登录!请确认是否重新登录')){                               			               
                        			top.location.href = '../ui/ui_log_ops.php?userid=$userID&newip=$userIP&groupid=$userGroupID&ops=$ops';
                        		}else{                        			
                        			top.location.href = '../ui/login.php?action=login';
        							};                        		
                		</script>";  
}


if($userIP == $ip && $status == "下线") 
{         
        echo "<script> alert('您已退出登录');
        	top.location.href = '../ui/login.php?action=login'; 	
        	</script>";                  
}

?>
