#!/bin/bash

cd /usr/local/src

wget http://ftp.gnu.org/pub/gnu/libiconv/libiconv-1.14.tar.gz
wget http://downloads.sourceforge.net/project/mcrypt/Libmcrypt/2.5.8/libmcrypt-2.5.8.tar.gz
wget http://downloads.sourceforge.net/project/mhash/mhash/0.9.9.9/mhash-0.9.9.9.tar.gz
wget http://downloads.sourceforge.net/project/mcrypt/MCrypt/2.6.8/mcrypt-2.6.8.tar.gz
wget http://www.php.net/distributions/php-5.3.29.tar.gz
wget http://www.php.net/distributions/php-5.4.40.tar.gz
wget http://www.php.net/distributions/php-5.5.24.tar.gz
wget http://www.php.net/distributions/php-5.6.8.tar.gz
wget http://downloads.sourceforge.net/project/pcre/pcre/8.36/pcre-8.36.tar.gz
wget http://nginx.org/download/nginx-1.8.0.tar.gz
wget http://ftp.gnu.org/gnu/bison/bison-2.7.1.tar.gz
wget http://download.pureftpd.org/pub/pure-ftpd/releases/pure-ftpd-1.0.37.tar.gz

DOWN_ADDR=https://downloads.mariadb.org/f
[ -d "/lib64" ] && { SYS_BIT_a=x86_64;SYS_BIT_b=x86_64; } || { SYS_BIT_a=x86;SYS_BIT_b=i686; }
LIBC_VERSION=`getconf -a | grep GNU_LIBC_VERSION | awk '{print $NF}'`
LIBC_YN=`echo "$LIBC_VERSION < 2.14" | bc`
[ $LIBC_YN == '1' ] && GLIBC_FLAG=linux || GLIBC_FLAG=linux-glibc_214 

src_url=$DOWN_ADDR/mariadb-10.0.17/bintar-${GLIBC_FLAG}-$SYS_BIT_a/mariadb-10.0.17-${GLIBC_FLAG}-${SYS_BIT_b}.tar.gz
wget $src_url
