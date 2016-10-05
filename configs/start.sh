#!/bin/sh
service php5-fpm start
service nginx start
tail -f /dev/null
