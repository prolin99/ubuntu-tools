FROM ubuntu:latest
MAINTAINER prolin99@gmail.com
ARG DEBIAN_FRONTEND=noninteractive 
RUN   apt-get update  
RUN   apt-get install -y software-properties-common    language-pack-en-base sed
RUN   LC_ALL=en_US.UTF-8 add-apt-repository  -y  -u  ppa:ondrej/php  

RUN  apt-get update && \
     apt-get install -y  apache2  libapache2-mod-php7.2 php7.2-bcmath php7.2-bz2 php7.2-cli php7.2-common php7.2-curl php7.2-dba php7.2-gd php7.2-gmp php7.2-imap php7.2-intl php7.2-ldap php7.2-mbstring php7.1-mcrypt php7.2-mysql php7.2-odbc php7.2-pgsql php7.2-recode php7.2-snmp php7.2-soap php7.2-sqlite php7.2-tidy php7.2-xml php7.2-xmlrpc php7.2-xsl php7.2-zip   
     

RUN ln -s /etc/php/7.1/mods-available/mcrypt.ini /etc/php/7.2/mods-available

RUN sed -i -e 's/max_execution_time = 30/max_execution_time = 300/g' /etc/php/7.2/apache2/php.ini && \
    sed -i -e 's/upload_max_filesize = 2M/upload_max_filesize = 256M/g' /etc/php/7.2/apache2/php.ini && \
    sed -i -e 's/post_max_size = 8M/post_max_size = 512M/g' /etc/php/7.2/apache2/php.ini && \
    sed -i -e 's/memory_limit = 128M/memory_limit = 512M/g' /etc/php/7.2/apache2/php.ini && \
    sed -i -e 's/;date.timezone =/date.timezone = Asia\/Taipei/g' /etc/php/7.2/apache2/php.ini && \
    sed -i -e 's/display_errors = Off/display_errors = On/g' /etc/php/7.2/apache2/php.ini && \
    sed -i -e 's/max_file_uploads = 20/max_file_uploads = 300/g' /etc/php/7.2/apache2/php.ini && \
    sed -i -e 's/max_input_time = 60/max_input_time = 120/g' /etc/php/7.2/apache2/php.ini && \
    sed -i -e 's/; max_input_vars = 1000/max_input_vars = 5000/g' /etc/php/7.2/apache2/php.ini && \
    sed -i -e 's/DirectoryIndex index.html index.cgi index.pl index.php index.xhtml index.htm/DirectoryIndex index.php index.html index.cgi index.pl index.xhtml index.htm/g' /etc/apache2/mods-available/dir.conf 
 

# Enable apache mods.
RUN a2enmod php7.2
RUN a2enmod rewrite

# Manually set up the apache environment variables
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

# Expose apache.
EXPOSE 80


# Update the default apache site with the config we created.
#ADD apache-config.conf /etc/apache2/sites-enabled/000-default.conf

# By default start up apache in the foreground, override with /bin/bash for interative.
CMD /usr/sbin/apache2ctl -D FOREGROUND
