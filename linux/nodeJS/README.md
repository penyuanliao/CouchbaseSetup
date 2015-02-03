### nodeJS升級v0.11.x時候出現/usr/lib/libstdc++.so.6: version `GLIBCXX_3.4.15' not found

查詢目前支援版本
```shell
strings /usr/lib64/libstdc++.so.6 | grep GLIBC
```
解法:
1.下載
```shell
wget http://ftp.de.debian.org/debian/pool/main/g/gcc-4.7/libstdc++6_4.7.2-5_amd64.deb
```
2.解壓縮
```shell
ar -x libstdc++6_4.7.2-5_amd64.deb
```
3.解壓縮
```shell
tar xvf data.tar.gz
```
4.拷貝到x86路徑:/usr/lib x64路徑:/usr/lib64
```shell
cd /[檔案路徑]/usr/lib/x86_64-linux-gnu

cp libstdc++.so.6.0.17 /usr/lib64
```
5.修改libstdc++.so.6 link檔案
```shell
#刪除
rm libstdc++.so.6
#增加
ln libstdc++.so.6.0.17 libstdc++.so.6
```
