#!/bin/bash

. ./setting.conf

cd /usr/local/src

tar xzf pure-ftpd-1.0.37.tar.gz
cd pure-ftpd-1.0.37
ln -s /usr/local/mariadb/lib/libmysqlclient.so /usr/lib
./configure --prefix=/usr/local/pureftpd CFLAGS=-O2 --with-mysql=/usr/local/mariadb --with-quotas --with-cookie --with-virtualhosts --with-virtualchroot --with-diraliases --with-sysquotas --with-ratios --with-altlog --with-paranoidmsg --with-shadow --with-welcomemsg  --with-throttling --with-uploadscript --with-language=english --with-rfc2640
make && make install

cp configuration-file/pure-config.pl /usr/local/pureftpd/sbin
sed -i "s@/usr/local/pureftpd@/usr/local/pureftpd@" /usr/local/pureftpd/sbin/pure-config.pl
chmod +x /usr/local/pureftpd/sbin/pure-config.pl
cp contrib/redhat.init /etc/init.d/pureftpd
cd ../
sed -i "s@fullpath=.*@fullpath=/usr/local/pureftpd/sbin/\$prog@" /etc/init.d/pureftpd
sed -i "s@pureftpwho=.*@pureftpwho=/usr/local/pureftpd/sbin/pure-ftpwho@" /etc/init.d/pureftpd
sed -i "s@/etc/pure-ftpd.conf@/usr/local/pureftpd/pure-ftpd.conf@" /etc/init.d/pureftpd
chmod +x /etc/init.d/pureftpd
sed -i 's@^. /etc/rc.d/init.d/functions@. /lib/lsb/init-functions@' /etc/init.d/pureftpd
update-rc.d pureftpd defaults

/bin/cp ftpconf/pure-ftpd.conf /usr/local/pureftpd/
sed -i "s@^MySQLConfigFile.*@MySQLConfigFile   /usr/local/pureftpd/pureftpd-mysql.conf@" /usr/local/pureftpd/pure-ftpd.conf
sed -i "s@^LimitRecursion.*@LimitRecursion  65535 8@" /usr/local/pureftpd/pure-ftpd.conf
/bin/cp ftpconf/pureftpd-mysql.conf /usr/local/pureftpd/
[ -z "$conn_ftpusers_dbpwd" ] && conn_ftpusers_dbpwd=`cat /dev/urandom | head -1 | md5sum | head -c 8`
echo "FTP Password: $conn_ftpusers_dbpwd" >> result.out
sed -i 's/tmppasswd/'$conn_ftpusers_dbpwd'/g' /usr/local/pureftpd/pureftpd-mysql.conf
sed -i 's/conn_ftpusers_dbpwd/'$conn_ftpusers_dbpwd'/g' ftpconf/script.mysql
sed -i 's/ftpmanagerpwd/'$ftpmanagerpwd'/g' ftpconf/script.mysql
ulimit -s unlimited
service mysqld restart
/usr/local/mariadb/bin/mysql -uroot -p$database_password < ftpconf/script.mysql
service pureftpd start

sed -i 's/tmppasswd/'$conn_ftpusers_dbpwd'/' ftpconfig/ftp/config.php
sed -i "s/myipaddress.com/`echo $local_IP`/" ftpconfig/ftp/config.php
sed -i "s@\$DEFUserID.*;@\$DEFUserID = `id -u $run_user`;@" ftpconfig/ftp/config.php
sed -i "s@\$DEFGroupID.*;@\$DEFGroupID = `id -g $run_user`;@" ftpconfig/ftp/config.php
sed -i 's@iso-8859-1@UTF-8@' ftpconfig/ftp/language/english.php
cp ftpconf/chinese.php ftpconf/ftp/language/
sed -i 's@\$LANG.*;@\$LANG = "chinese";@' ftpconf/ftp/config.php
rm -rf  ftpconfig/ftp/install.php
cp -R ftpconf/ftp /home/wwwroot/default/

# iptables Ftp
if [ -e '/etc/sysconfig/iptables' ];then
    if [ -z "`grep '20000:30000' /etc/sysconfig/iptables`" ];then
        iptables -I INPUT 5 -p tcp -m state --state NEW -m tcp --dport 21 -j ACCEPT
        iptables -I INPUT 6 -p tcp -m state --state NEW -m tcp --dport 20000:30000 -j ACCEPT
    fi
elif [ -e '/etc/iptables.up.rules' ];then
    if [ -z "`grep '20000:30000' /etc/iptables.up.rules`" ];then
        iptables -I INPUT 5 -p tcp -m state --state NEW -m tcp --dport 21 -j ACCEPT
        iptables -I INPUT 6 -p tcp -m state --state NEW -m tcp --dport 20000:30000 -j ACCEPT
    fi
fi
iptables-save > /etc/iptables.up.rules
