# CouchbaseToAmfphp
設定安裝Couchbase

建立架構圖

[AS3] ----(HTTP GET)----> [AMFPHP] ----(Binary Protocl)----> [couchbase]

[AS3] ----(HTTP GET)----> [AMFPHP] ----(Binary Protocl)----> [couchbase]

###Installing
```shell
rpm --install couchbase-server-enterprise-3.0.2-centos6.x86_64.rpm

#手動設定
iUSR=你的帳號
iPWD=你的密碼
iBucket=你的DB名稱
iRamsize=伺服器給Cluster大小(mb)
iBucketRamsize=couchbase給Bucket大小(mb)
#
#初始化couchbase參數
#
/opt/couchbase/bin/couchbase-cli cluster-init -c 127.0.0.1:8091 --cluster-init-username=$iUSR --cluster-init-password=$iPWD --cluster-init-ramsize=$iRamsize
#
#建立一個新的bucket
#
/opt/couchbase/bin/couchbase-cli bucket-create -c 127.0.0.1:8091 --user=$iUSR --password=$iPWD --bucket=$iBucket --bucket-type=couchbase --bucket-port=11222 --bucket-ramsize=200 --bucket-replica=1

#
#create group
#
/opt/couchbase/bin/couchbase-cli group-manage -c <localhost>:8091 --create --group-name=fxgroup -u $iUSR -p $iPWD

#
#建立伺服器
#
/opt/couchbase/bin/couchbase-cli server-add -c <localhost>:8091 --server-add=<add_server_ip>:8091 --server-add-username=$iUSR --server-add-password=$iPWD --group-name=fxgroup -u $iUSR -p $iPWD

#
# 刪除伺服器
#
/opt/couchbase/bin/couchbase-cli rebalance -u $iUSR -p $iPWD -c <localhost>:8091 --server-remove=<Server_IP>:8091

#
#XDCR
#
/opt/couchbase/bin/couchbase-cli xdcr-setup -c 127.0.0.1:8091 --user=$iUSR --password=$iPWD --create --xdcr-cluster-name=cluster1 --xdcr-hostname=127.0.0.1:8091 --xdcr-username=$iUSR --xdcr-password=$iPWD
```

```shell
#uninstall
sudo rpm -e couchbase-server

copy
scp couchbase-server-enterprise-3.0.3-centos6.x86_64.rpm name@ip:/tmp

# Disable Transparent Huge Pages (THP)
sudo echo never > /sys/kernel/mm/transparent_hugepage/enabled
sudo echo never > /sys/kernel/mm/transparent_hugepage/defrag
sudo cp -p /etc/rc.local /etc/rc.local.`date +%Y%m%d-%H:%M`


#Swappiness should to be turned off
# Set the value for the running system
sudo echo 0 > /proc/sys/vm/swappiness

# Backup sysctl.conf
sudo cp -p /etc/sysctl.conf /etc/sysctl.conf.`date +%Y%m%d-%H:%M`

# Set the value in /etc/sysctl.conf so it stays after reboot.
sudo echo '' >> /etc/sysctl.conf
sudo echo '#Set swappiness to 0 to avoid swapping' >> /etc/sysctl.conf
sudo echo 'vm.swappiness = 0' >> /etc/sysctl.conf

```


##CentOS編譯安裝NodeJS+Express

###setup 1.下載NODE.js 
http://nodejs.org/download/

```shell
#設定HOME位置
export NODE_HOME=/opt/node-v0.10.35-linux-x64
#Bin加入到PATH裡面
export PATH=$NODE_HOME/bin:$PATH
#加入Node path
export NODE_PATH=$NODE_HOME/lib/node_modules:$PATH
````

###setup 3.安裝express framework 
```shell 
npm install experss -gd
```

###setup 4.執行初始化
```shell 
npm install -g express-generator
```

###setup 5.建立專案
在網頁目錄輸入指令
```shell
experss [專案名稱]
```

##CentOS編譯安裝PHP Extension

###setup 0.必須先安裝Couchbse Client C SDK 
下載version 2.4:http://packages.couchbase.com/clients/c/libcouchbase-2.4.6_centos62_x86_64.tar
```shell
$ tar xf libcouchbase-2.4.0.tar.gz
$ cd libcouchbase-2.4.0
$ ./configure
$ sudo make install
```
###setup 1.安裝Couchbse Client SDK 

透過 Pecl是PHP擴展庫路徑在/php/bin/pecl

```shell
#搜尋是否有couchbase
#http://pecl.php.net/package/couchbase
sudo pecl search couchbase
#執行安裝
sudo pecl install couchbase
```
自己編譯檔案Downlod: <https://github.com/couchbase/php-ext-couchbase>
```shell
#https://github.com/couchbase/php-ext-couchbase

$ phpize
$ ./configure
$ make
$ make test

```
###setup 2.設定php.ini
設定完成後服務需要重開。(service httpd stop;service httpd start;)

```ini

extension=couchbase.so;

```

### Setup php extension Error

Fault-1 : `make: *** [bucket.lo] Error 1`

Asnwer  : 需要更新c sdk (Get and install the C Library. The C SDK is a requirement for the PHP library.)

http://docs.couchbase.com/couchbase-sdk-c-2.3/

RHEL/CentOS 6.2

```shell
#下載自動安裝工具的couchbase網址
sudo wget -O/etc/yum.repos.d/couchbase.repo \
           http://packages.couchbase.com/rpm/couchbase-centos62-x86_64.repo
#下載自動安裝工具更新
sudo yum check-update
#下載自動安裝工安裝下面兩個元件
sudo yum install -y  libcouchbase2-libevent libcouchbase-devel
```

#YCSB 安裝經驗
```shell
#先設定JAVA_HOME
#In this example /usr/java/jdk1.6.0_19 is the JDK installation directory.
export JAVA_HOME=/usr/java/jdk1.6.0_19
export PATH=$PATH:$JAVA_HOME/bin

#安裝Maven
http://maven.apache.org/install.html

./bin/ycsb load redis -p redis.host=localhost -p redis.port=6379 -P workloads/workloada -p recordcount=200000 -s > d.dat


```

# Install perfrunner
```shell
#url:https://github.com/couchbase/perfrunner

#rpm 安裝問題
rpm -ivh --force --nodeps --install *.rpm


```
