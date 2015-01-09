# CouchbaseSetup
設定安裝Couchbase

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
