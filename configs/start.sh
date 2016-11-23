#!/bin/sh
service php7.0-fpm start
service nginx start
/usr/bin/mysqld_safe &
tail -f /dev/null
