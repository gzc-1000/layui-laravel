---
typora-root-url: img
---

### 1.配置要求

- PHP>7
- laravel版本为5.5
- composer版本为1.10



### 2.运行项目

1. 运行`php artisan key:generate`生成key

2. 修改.env.example为.env，将生成的key放在APP_KEY位置，修改本地数据库、用户名和密码

   ![env](/.env.png)

3. 导入根目录下的school.sql文件到本地数据库

4. 运行composer i，下载依赖

5. 输入` php artisan run`，运行项目



### 3.页面功能

1. 登录界面，用户名为admin，密码为1234，使用验证码插件

![登录界面](/登录界面.png)

2.首页

![首页](/首页.png)



3.管理用户界面，增删改查

![用户增删改查](/用户增删改查.png)