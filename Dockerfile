########################################
# Dockerfile - Laravel dev environment #
# ------------------------------------ #
# Created on 09/28/2016                #
########################################

# Base image - Ubuntu
FROM ubuntu:16.04

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
RUN apt-get -y install nginx php-fpm php-cli php-mcrypt git mysql-server



# Create directories
RUN mkdir -p /var/www/laravel

# Import the nginx config
ADD ./configs/nginx /etc/nginx/sites-available/default

RUN mkdir -p /opt/scripts

ADD ./configs/start.sh /opt/scripts/start.sh

# Import the project
ADD ./code /var/www/laravel

# Fix permissions
RUN chgrp -R www-data /var/www/laravel
RUN chmod -R ug+rwx /var/www/laravel/storage /var/www/laravel/bootstrap/cache
