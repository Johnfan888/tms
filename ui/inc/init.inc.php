<?php
/**
 * �����ļ���ÿһ��ҳ�涼Ӧ�ð�����ҳ��
*/

//������վ������NOTICE���棬�ڿ�����DEBUGʱ�趨Ϊ��һ�����ڷ���ʱ���趨Ϊ�ڶ����������
//error_reporting(E_ALL);
error_reporting(E_ALL^E_NOTICE);
//error_reporting(E_ALL^E_NOTICE^E_WARNING);
//ini_set("display_errors", "off");

//�趨ʱ��
date_default_timezone_set('Asia/Shanghai');

//������԰��������ļ�
define('INC', 'TRUE');

//������վ�İ����ļ���Ŀ¼
define('INC_PATH', str_replace('\\', '/', dirname(__FILE__)));

//����ҳ�������ļ�
require_once(INC_PATH . '/config.inc.php');

// �������ݿ����������ļ�
require_once(INC_PATH . '/config.db.php');

// ����MYSQL��������ķ�ʽ��ֵ��ѡ"mysql"����"mysqli"
//$mysql_conn_type = 'mysql';	
$mysql_conn_type = 'mysqli';	

// ����MYSQLʹ�õ�Ĭ���ַ���
$DefaultDBLang = 'utf8';

//��ʼ�����ݿ��࣬��ʹ��ʱ��ֱ�ӵ���$class_mysql_default
require_once(INC_PATH . '/dbClass.php');
$class_mysql_default = new Class_Mysql_conn($dbhost,$dbuser,$dbpass,$dbname,$DefaultDBLang,$mysql_conn_type);
$class_mysql_default -> check_mysql_conn_type();
$class_mysql_default -> my_conn();  //����ֵclass -> myconn;
$class_mysql_default -> select_db();  //ѡ�����ݿ�
$class_mysql_default -> getmysqlinfo(); //��ȡ�汾��
$class_mysql_default -> mysql_DefaultLang();  //ǿ���ַ���

//��ҳ��ָ������Ҫ���е�¼��֤ʱ
if(defined("AUTH"))
{
	require_once(INC_PATH . '/auth.php');
}
if(defined("WEBAUTH"))
{
	require_once(INC_PATH . '/webauth.php');
}

//���ð�������
require_once(INC_PATH . '/helper.inc.php');

//����ҳ�氲ȫ����
//require_once(INC_PATH . '/safe.inc.php');
?>
