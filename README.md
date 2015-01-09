# CouchbaseSetup
設定安裝Couchbase

###CentOS編譯安裝NodeJS+Express

###setup 1.下載NODE.js 
http://nodejs.org/download/

```linux
#設定HOME位置
export NODE_HOME=/opt/node-v0.10.35-linux-x64
#Bin加入到PATH裡面
export PATH=$NODE_HOME/bin:$PATH
#加入Node path
export NODE_PATH=$NODE_HOME/lib/node_modules:$PATH
````
