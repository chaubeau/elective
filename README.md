
# 学生选课系统

---

## 使用方法

### Nginx服务

安装部署nginx服务
### php-fpm
部署php-fpm服务

### MySQL
* 安装MySQL
* 修改`models/mysql.php` 14行的MySQL链接参数
* 导入表创建语句

>* `mysql>source  config/create.sql`

* 插入管理员登陆数据(username:admin,password:admin)

>* `mysql> insert into admin(adminname,adminpwd) values('admin','21232f297a57a5a743894a0e4a801fc3');`

### 其他使用方法
下载docker 镜像并启动，浏览器直接访问

```
    docker run -d -P index.alauda.cn/chaubeau/91606cc1fef1:1.5
    
```


