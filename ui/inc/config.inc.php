<?php
if(!defined('INC')) exit('Bad Request');

//设置所有页面以utf-8编码显示
//header("Content-type: text/html;charset=utf-8");

// 设置网站使用的默认字符集
$DefaultLang = 'utf8';

// 设置网站标题
$config_web_title = '运输管理系统';

// 设置公司名称
//$config_company_name = '湖南郴汽集团';
$config_company_name = '汽车运输集团';

// 设置COOKIE前缀
$config_cookie_head = 'isbtc';

// UI绝对路径 (/.../ui/)
$php_self = $_SERVER['PHP_SELF'];
define('CONFIG_WEB_ROOT', substr(dirname(__FILE__), 0, -3)); 

///获取ui目录的绝对URL (http://host/.../ui/)
$dummydir = substr(CONFIG_WEB_ROOT, strlen($_SERVER['DOCUMENT_ROOT']), strlen(CONFIG_WEB_ROOT)-strlen($_SERVER['DOCUMENT_ROOT']));
$hosturl = $_SERVER['HTTP_HOST'];
define("CONFIG_WEB_URL", str_replace("\\","/", "http://$hosturl/$dummydir"));

//设置页面跳转时间（秒）
$backtime = 2;

//设置程序版本号
$version = "1.0";
?>
