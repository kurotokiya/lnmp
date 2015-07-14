#!/bin/bash

cd /usr/local/src

tar xzf nginx-1.9.2.tar.gz
cd nginx-1.9.2

# close debug
sed -i 's@CFLAGS="$CFLAGS -g"@#CFLAGS="$CFLAGS -g"@' auto/cc/gcc

./configure --prefix=/usr/local/nginx --user=www --group=www --with-http_stub_status_module --with-http_spdy_module --with-http_ssl_module --with-ipv6 --with-http_gzip_static_module --with-http_flv_module
make && make install

[ -n "`cat /etc/profile | grep 'export PATH='`" -a -z "`cat /etc/profile | grep /usr/local/nginx`" ] && sed -i "s@^export PATH=\(.*\)@export PATH=/usr/local/nginx/sbin:\1@" /etc/profile
. /etc/profile

cd ../

cp Nginx-Init /etc/init.d/nginx
update-rc.d nginx defaults

mv /usr/local/nginx/conf/nginx.conf{,_bk}
cp conf/*.conf /usr/local/nginx/conf/

# logrotate nginx log
cat > /etc/logrotate.d/nginx << EOF
/home/wwwlogs/*nginx.log {
daily
rotate 5
missingok
dateext
compress
notifempty
sharedscripts
postrotate
    [ -e /var/run/nginx.pid ] && kill -USR1 \`cat /var/run/nginx.pid\`
endscript
}
EOF

cp -R src/* /home/wwwroot/default/
