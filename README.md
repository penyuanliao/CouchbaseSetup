# CouchbaseSetup
設定安裝Couchbase




建立架構圖


[AS3] ----(HTTP GET)----> [AMFPHP] ----(HTTP GET)----> [couchbase]
[AS3] ----(HTTP GET)----> [AMFPHP] ----(Socket)----> [couchbase]

###CentOS編譯安裝NodeJS+Express

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




### Setup php extension error

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
