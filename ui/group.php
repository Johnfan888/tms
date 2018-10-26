<?
require_once('inc/init.inc.php');
require_once('inc/templates.lang.php');
require_once('inc/fun.inc.php');
?>
<script type="text/javascript" src="../js/jquery.js"></script>
<?


$action = $_GET["action"];



//安全退出
if($action == "exit")
{
    $uiState = "下线";
    $LogoutTime = date("Y-m-d   H:i:s");
    $userID = $_COOKIE["{$config_cookie_head}_UserID"];
    $strsql = "update tms_sys_OnlineUser set ui_UserState = '$uiState', ui_LoginTime = NULL, ui_LogoutTime = '$LogoutTime' where ui_UserID = '$userID'";
    $query = $class_mysql_default ->my_query($strsql);
        
	setcookie("{$config_cookie_head}_UserID", "");
	setcookie("{$config_cookie_head}_UserName", "");
	setcookie("{$config_cookie_head}_UserPassword", "");
	setcookie("{$config_cookie_head}_UserGroupID", "");
	setcookie("{$config_cookie_head}_UserGroupName", "");
	setcookie("{$config_cookie_head}_UserStationID", "");
	setcookie("{$config_cookie_head}_UserStationName", "");
	funmessage("login2.php?action=login", $templang['exitsucess'], $backtime);
	exit();
}

//登陆
if($action == "login")
{       
	//清除COOKIE
	setcookie("{$config_cookie_head}_UserID", "");
	setcookie("{$config_cookie_head}_UserName", "");
	setcookie("{$config_cookie_head}_UserPassword", "");
	setcookie("{$config_cookie_head}_UserGroupID", "");
	setcookie("{$config_cookie_head}_UserGroupName", "");
	setcookie("{$config_cookie_head}_UserStationID", "");
	setcookie("{$config_cookie_head}_UserStationName", "");
	
	$userid = trim($_POST["username"]);
	$pass = trim($_POST["pass"]);
	if(strlen($userid) < 1 || strlen($pass) < 1)
	{
		funmessage("javascript:history.go(-1)", $templang['emptytype'], $backtime);
		exit();
	}
	$userpass = md5($pass);
	
	$strsql = "select * from tms_sys_UsInfor where ui_UserID = '$userid' and ui_UserPassword = '$userpass'";
	$result = $class_mysql_default ->my_query($strsql);
	if(mysqli_num_rows($result) < 1)
	{	    
		funmessage("login2.php?action=login", $templang['namepasserror'], $backtime);
		exit();
	}
	else
	{   
	    $rows = mysqli_fetch_array($result);
		$userName = $rows['ui_UserName'];
		$groupID = $rows['ui_UserGroupID'];
		$groupName = $rows['ui_UserGroup'];
		$stationID = $rows['ui_UserSationID'];
		$stationName = $rows['ui_UserSation'];
	    
		setcookie("{$config_cookie_head}_UserID", "$userid", "0", "/");
		setcookie("{$config_cookie_head}_UserName", "$userName", "0", "/");
		setcookie("{$config_cookie_head}_UserPassword", "$userpass", "0", "/");
		setcookie("{$config_cookie_head}_UserGroupID", "$groupID", "0", "/");
		setcookie("{$config_cookie_head}_UserGroupName", "$groupName", "0", "/");
		setcookie("{$config_cookie_head}_UserStationID", "$stationID", "0", "/");
		setcookie("{$config_cookie_head}_UserStationName", "$stationName", "0", "/");

		//不同用户名，同一IP登录
		$localIP = $_SERVER['REMOTE_ADDR'];
		

		/*
		
		$strsql = "select * from tms_sys_OnlineUser where ui_UserIP = '$localIP'";
		$query = $class_mysql_default ->my_query($strsql);
		$num = mysqli_num_rows($query);				
        if(mysqli_num_rows($query)!=0){
                $rows = mysqli_fetch_array($query);
                $oldID =  $rows['ui_UserID'];
                echo "<script> alert('$userid.$oldID');</script>";
                if($userid != $oldID)
                {                       
                       $groupid = $rows['ui_UserGroupID'];               
                       $ops = "login";
                       $LoginTime = date("Y-m-d   H:i:s");
                       
                      
                       echo "<script>  alert('您已在本机登录过，新用户名登录后，旧的用户将退出');     			</script>";
                       
                       $sql = "UPDATE tms_sys_OnlineUser SET ui_UserID = '$userid', ui_UserName = '$userName', ui_UserGroupID = '$groupID', ui_UserGroup = '$groupName', ui_UserSationID = '$stationID', ui_UserSation = '$stationName', ui_UserState = '在线', ui_LoginTime = '$LoginTime', ui_LogoutTime = NULL, ui_UserIP = '$localIP' , ui_UserID = '$userid' WHERE ui_UserID = '$oldID'";	
	                 
                       
                       $query=$class_mysql_default->my_query($sql);
                }
                $str1 = "Location:main.php?groupid=".$groupID;
                header($str1);
        }
        */		
	    //登录成功
	    
	    $uiState = "在线";	  
        $strsql = "select * from tms_sys_OnlineUser where ui_UserID = '$userid' and ui_UserState = '$uiState'";
        $query = $class_mysql_default ->my_query($strsql);
        if(mysqli_num_rows($query)==1)
        {      //用户已登录
               $rows = mysqli_fetch_array($query);
               $ip = $rows['ui_UserIP'];
               $groupid = $rows['ui_UserGroupID'];
               
               $ops = "login";
             
                        //是从其他主机登录的
               echo "<script>  if(confirm('您已使用IP:'+'$ip'+'登录!请确认是否重新登录')){               			
                        			window.location.href = 'ui_log_ops.php?userid=$userid&newip=$localIP&groupid=$groupid&ops=$ops';
                        		}else{                        		
                        			window.location.href = 'login.php?action=login';
        							};                        		
               </script>";
                      exit();
        }
        else {   
               
                $uiState = "下线";                
                $strsql = "select * from tms_sys_OnlineUser where ui_UserID = '$userid' and ui_UserState = '$uiState'";
                $query = $class_mysql_default ->my_query($strsql);
                if(mysqli_num_rows($query)==1)
                {//数据库中有记录，但是下线状态
                        $uiState = "在线";
                        $loginTime = date("Y-m-d   H:i:s");
                        $ip = $_SERVER['REMOTE_ADDR'];
                        $userGroupID = $groupID;
                        //UPDATE Person SET Address = 'Zhongshan 23', City = 'Nanjing' WHERE LastName = 'Wilson'
                        
                        
                        $sql = "UPDATE tms_sys_OnlineUser SET ui_LoginTime = '$loginTime' ,ui_UserState = '$uiState', ui_UserIP = '$ip' WHERE  ui_UserID ='$userid'";
                       
                        $query=$class_mysql_default->my_query($sql); 
                }
                else 
                { 
                        //属于新登录（数据库中无记录）的用户
                        $userGroupID = $groupID;
                        $userGroup = $groupName;
                        $userStationID = $stationID;
                        $userStation = $stationName;
                        $uiState = "在线";
                        $loginTime = date("Y-m-d   H:i:s");
                        $ip = $_SERVER['REMOTE_ADDR'];
                        
                        $sql = "INSERT INTO tms_sys_OnlineUser (ui_UserID, ui_UserName, ui_UserGroupID, ui_UserGroup, ui_UserSationID, ui_UserSation, ui_UserState, ui_LoginTime, ui_LogoutTime, ui_UserIP)	
                        	VALUES ('$userid', '$userName', '$userGroupID', '$userGroup', '$userStationID', '$userStation', '$uiState','$loginTime', NULL, '$ip')"; 		
                	    $query=$class_mysql_default->my_query($sql);                	      
                }
                $str1 = "Location:main.php?groupid=".$userGroupID;
                header($str1); 
        }
	}
}
?>