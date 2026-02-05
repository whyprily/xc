
# 徐霞客实验小学校车管理系统

## 环境要求

- PHP 7.0+
- MySQL 5.7+
- Composer (可选)

## 数据库部署 (Docker)

### 1. 启动数据库

```bash
docker compose up -d
```

### 2. 验证部署

```bash
docker ps                          # 查看容器状态
docker exec xckxx_mysql mysql -uroot -proot data -e "SELECT * FROM stubus;"
```

### 3. 常用命令

```bash
docker compose up -d     # 启动数据库
docker compose down       # 停止数据库
docker logs xckxx_mysql   # 查看日志
```

### 数据库信息

- **容器名**: `xckxx_mysql`
- **数据库名**: `data`
- **用户名**: `root`
- **密码**: `root`
- **端口**: `3306`

### 数据库表结构

| 表名 | 说明 |
|------|------|
| `stubus` | 学生乘车信息表 |
| `station` | 站点表 |
| `class` | 班级表 |
| `bus` | 车号表 |
| `stuqj` | 请假/缺勤记录表 |

## 本地运行

### 方式一：PHP内置服务器

```bash
php -S localhost:8080
```

然后浏览器访问: http://localhost:8080

### 方式二：Apache/Nginx

配置虚拟域名指向项目目录即可。

## 功能模块

| 页面 | 路径 | 说明 |
|------|------|------|
| 首页 | `index.php` | 显示今日请假/缺勤名单 |
| 查询 | `index.php?c=cx&a=cx` | 按年级、班级、车次、批次筛选 |
| 请假 | `index.php?c=qj&a=qj` | 学生请假登记 (7:00-17:40) |
| 点名 | `index.php?c=dm&a=dm` | 晚间乘车点名 (17:00-18:00) |

## 后台管理

访问: http://localhost:8080/index.php?c=admin&a=index

### 管理功能

- **学生管理**: 添加、编辑、删除学生信息
- **班级管理**: 添加、删除年级班级
- **站点管理**: 添加、删除乘车站点
- **车号管理**: 添加、编辑、删除车辆信息

### 学生字段说明

| 字段 | 说明 |
|------|------|
| name | 学生姓名 |
| sex | 性别 |
| gradeid | 年级 (1-6) |
| classid | 班级 (1-7) |
| batch | 批次 (1-3) |
| busnum | 车号 (1-10) |
| model | 乘车类型 (1:早晚都乘, 2:仅早上, 3:仅晚上) |
| sationid | 站点ID |
