<?php
/**
 * 公用文件，每一张页面都应该包含本页面
*/

//设置网站不进行NOTICE警告，在开发和DEBUG时设定为第一个，在发布时，设定为第二个或第三个
//error_reporting(E_ALL);
error_reporting(E_ALL^E_NOTICE);
//error_reporting(E_ALL^E_NOTICE^E_WARNING);
//ini_set("display_errors", "off");

//设定时区
date_default_timezone_set('Asia/Shanghai');

//定义可以包含其他文件
define('INC', 'TRUE');

//定义网站的包含文件夹目录
define('INC_PATH', str_replace('\\', '/', dirname(__FILE__)));

//包含页面配置文件
require_once(INC_PATH . '/config.inc.php');

// 包含数据库连接配置文件
require_once(INC_PATH . '/config.db.php');

// 设置MYSQL连接请求的方式，值可选"mysql"或者"mysqli"
//$mysql_conn_type = 'mysql';	
$mysql_conn_type = 'mysqli';	

// 设置MYSQL使用的默认字符集
$DefaultDBLang = 'utf8';

//初始化数据库类，在使用时，直接调用$class_mysql_default
require_once(INC_PATH . '/dbClass.php');
$class_mysql_default = new Class_Mysql_conn($dbhost,$dbuser,$dbpass,$dbname,$DefaultDBLang,$mysql_conn_type);
$class_mysql_default -> check_mysql_conn_type();
$class_mysql_default -> my_conn();  //返回值class -> myconn;
$class_mysql_default -> select_db();  //选择数据库
$class_mysql_default -> getmysqlinfo(); //获取版本号
$class_mysql_default -> mysql_DefaultLang();  //强制字符集

//当页面指定必须要进行登录验证时
if(defined("AUTH"))
{
	require_once(INC_PATH . '/auth.php');
}
if(defined("WEBAUTH"))
{
	require_once(INC_PATH . '/webauth.php');
}

//调用帮助函数
require_once(INC_PATH . '/helper.inc.php');

//调用页面安全处理
//require_once(INC_PATH . '/safe.inc.php');
?>
