## 项目名称
秒老鼠酒仓库APP项目
## 技术架构
* PHP >7.1.0
* MySQL >5.7.0
* Nginx >1.12.0
* Laravel > 5.5.0
* Dingo 2.0.0-alpha2
* Jwt 1.0.0-rc.1
## 安装第三方组件
> **注意：** 可以自定义 [`composer`](https://pkg.phpcomposer.com/) 镜像，加快拉取速度

```
$ composer update
```
## 目录结构及权限
##### 配置 `.env` 文件，数据库、redis 等
```
$ cp .env.example .env
```
##### 创建目录，`git clone` 从仓库拉取的代码，可能会存在 `storage` 目录缺失的问题，需要手动创建
```
$ mkdir -p storage/{app,debugbar,framework,logs}
$ mkdir -p storage/framework/{cache,sessions,testing,views}
```
##### 修改权限，必须保证 `storage`，`bootstarp/cache` 有读写权限
```
$ chmod 777 -R storage bootstrap/cache
```
## 创建 KEY
```
$ php artisan key:generate
```
## 创建 storage 到 public 的软链接
```
$ php artisan storage:link
```
## 创建 JWT 密钥
```
$ php artisan jwt:secret
```
## 运行数据库迁移
```
$ php artisan migrate
```
## 导入初始化 SQL
Sql 文件待提供
## 初始化区域专卖店记录
> 注意：此过程耗时较长，请耐心等待
``` 
$ php artisan customize:init_flagship_store_record
```
