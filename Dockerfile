########################################
# Dockerfile - Laravel dev environment #
# ------------------------------------ #
# Created on 09/28/2016                #
########################################

# Base image - Ubuntu 12.04 LTS
FROM ubuntu:12.04

# Maintainer
MAINTAINER Guillaume Petitpierre

#######################################

ENV DEBIAN_FRONTEND "noninteractive"

# Update repositories
RUN apt-get update

# Environment will run on port 50000, let's expose it
EXPOSE 5000
EXPOSE 3306

# MySQL password
RUN sh -c 'echo "mysql-server mysql-server/root_password password t00r" | debconf-set-selections'
RUN sh -c 'echo "mysql-server mysql-server/root_password_again password t00r" | debconf-set-selections'

# Install nginx + required packages
RUN apt-get -y install nginx php5-fpm php5-cli php5-mcrypt git mysql-server

# Create directories
RUN mkdir -p /var/www/laravel

# Import the nginx config
ADD ./configs/nginx /etc/nginx/sites-available/default

# Modifying the php config.
# Really hope that works...
RUN sed -i -e 's/;cgi.fix_pathinfo=0/cgi.fix_pathinfo=1/g' /etc/php5/fpm/php.ini
# That one too...
RUN sed -i -e 's/listen = 127.0.0.1:9000/listen = \/var\/run\/php5-fpm.sock/g' /etc/php5/fpm/pool.d/www.conf

RUN mkdir -p /opt/scripts

ADD ./configs/start.sh /opt/scripts/start.sh

# Import the project
ADD ./code /var/www/laravel
