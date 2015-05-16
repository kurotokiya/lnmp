# LNMP Stack

一个简单的 LNMP 一键安装包，包含多个 PHP 版本。

Only for Ubuntu Linux

# 安装

安装 git

    apt-get install git

将本项目克隆到 `/usr/local/src`

    git clone https://github.com/kurotokiya/lnmp.git /usr/local/src

进入 `/usr/local/src` 目录

    cd /usr/local/src

编辑 `setting.conf` 文件配置数据库及 FTP 在线管理密码

    nano setting.conf

按照下面的顺序安装：

    ./down.sh
    ./init.sh
    ./php-5.6.sh
    ./php-5.5.sh (可选)
    ./php-5.4.sh (可选)
    ./php-5.3.sh (可选)
    ./nginx.sh
    ./mariadb.sh
    ./pureftpd.sh (可选)

# 联系方式

Blog: [時やのメモ帳](http://tokiya.me/)
