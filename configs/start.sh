#!/bin/sh
service php5-fpm start
service nginx start
/usr/bin/mysqld_safe &
tail -f /dev/null
