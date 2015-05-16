#!/bin/bash

cd /usr/local/src

apt-get -y remove --purge apache2 apache2-doc apache2-utils apache2.2-common apache2.2-bin apache2-mpm-prefork apache2-doc apache2-mpm-worker mysql-client mysql-server mysql-common libmysqlclient18 php5 php5-common php5-cgi php5-mysql php5-curl php5-gd libmysql* mysql-*

apt-get -y update

apt-get -y install gcc g++ make cmake autoconf libjpeg8 libjpeg8-dev libpng12-0 libpng12-dev libpng3 libfreetype6 libfreetype6-dev libxml2 libxml2-dev zlib1g zlib1g-dev libc6 libc6-dev libglib2.0-0 libglib2.0-dev bzip2 libzip-dev libbz2-1.0 libncurses5 libncurses5-dev curl libcurl3 libcurl4-openssl-dev e2fsprogs libkrb5-3 libkrb5-dev libltdl-dev libidn11 libidn11-dev openssl libssl-dev libtool libevent-dev re2c libsasl2-dev libxslt1-dev patch vim zip unzip tmux htop wget bc expect rsync git sendmail

apt-get -y install libaio-dev

mkdir -p /home/wwwroot/default
mkdir -p /home/wwwlogs

if [ -n "`cat /etc/issue | grep -E 14`" ];then
    apt-get -y install libcloog-ppl1
    apt-get -y remove bison
    tar xzf bison-2.7.1.tar.gz
    cd bison-2.7.1
    ./configure
    make && make install
    cd ..
    rm -rf bison-2.7.1
elif [ -n "`cat /etc/issue | grep -E 13`" ];then
    apt-get -y install bison libcloog-ppl1
elif [ -n "`cat /etc/issue | grep -E 12`" ];then
    apt-get -y install bison libcloog-ppl0
fi

# /etc/security/limits.conf
[ -z "`cat /etc/security/limits.conf | grep 'nproc 65535'`" ] && cat >> /etc/security/limits.conf <<EOF
* soft nproc 65535
* hard nproc 65535
* soft nofile 65535
* hard nofile 65535
EOF
[ -z "`cat /etc/rc.local | grep 'ulimit -SH 65535'`" ] && echo "ulimit -SH 65535" >> /etc/rc.local

rm -rf /etc/localtime
ln -s /usr/share/zoneinfo/Asia/Shanghai /etc/localtime

# Set DNS
#cat > /etc/resolv.conf << EOF
#nameserver 114.114.114.114
#nameserver 8.8.8.8
#EOF

# /etc/sysctl.conf
[ -z "`cat /etc/sysctl.conf | grep 'fs.file-max'`" ] && cat >> /etc/sysctl.conf << EOF
fs.file-max=65535
net.ipv4.tcp_syncookies = 1
net.ipv4.tcp_fin_timeout = 30 
net.ipv4.tcp_tw_reuse = 1
net.ipv4.tcp_tw_recycle = 1
net.ipv4.ip_local_port_range = 1024 65000
net.ipv4.tcp_max_syn_backlog = 65536 
net.ipv4.tcp_max_tw_buckets = 6000
net.ipv4.route.gc_timeout = 100
net.ipv4.tcp_syn_retries = 1
net.ipv4.tcp_synack_retries = 1
net.core.somaxconn = 65535 
net.core.netdev_max_backlog = 262144
net.ipv4.tcp_timestamps = 0
net.ipv4.tcp_max_orphans = 262144
EOF
sysctl -p

# Update time
ntpdate pool.ntp.org 
[ -z "`grep 'pool.ntp.org' /var/spool/cron/root`" ] && { echo "*/20 * * * * `which ntpdate` pool.ntp.org > /dev/null 2>&1" >> /var/spool/cron/crontabs/root;chmod 600 /var/spool/cron/crontabs/root; } 
service cron restart

tar xzf libiconv-1.14.tar.gz
cd libiconv-1.14
./configure --prefix=/usr/local
[ -n "`cat /etc/issue | grep 'Ubuntu 13'`" ] && sed -i 's@_GL_WARN_ON_USE (gets@//_GL_WARN_ON_USE (gets@' srclib/stdio.h 
[ -n "`cat /etc/issue | grep 'Ubuntu 14'`" ] && sed -i 's@gets is a security@@' srclib/stdio.h 
make && make install
cd ../

tar xzf libmcrypt-2.5.8.tar.gz
cd libmcrypt-2.5.8
./configure
make && make install
ldconfig
cd libltdl/
./configure --enable-ltdl-install
make && make install
cd ../../

tar xzf mhash-0.9.9.9.tar.gz
cd mhash-0.9.9.9
./configure
make && make install
cd ../

tar xzf mcrypt-2.6.8.tar.gz
cd mcrypt-2.6.8
ldconfig
./configure
make && make install
cd ../

tar xzf pcre-8.36.tar.gz
cd pcre-8.36
./configure
make && make install
cd ../

useradd -M -s /sbin/nologin www
