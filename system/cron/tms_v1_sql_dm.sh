#!/bin/sh

/bin/echo `date` >> /srv/www/htdocs/tms/tms10/tms20131006/system/cron/log.txt
/usr/bin/mysql -u root -p111111 < /srv/www/htdocs/tms/tms10/tms20131006/system/cron/tms_v1_sql_dm.sql 

