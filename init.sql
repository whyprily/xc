-- 徐霞客实验小学校车管理系统数据库初始化脚本

-- 创建学生乘车信息表
CREATE TABLE IF NOT EXISTS `stubus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `gradeid` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `batch` int(11) NOT NULL COMMENT '批次',
  `busnum` int(11) NOT NULL COMMENT '车号',
  `model` int(11) NOT NULL DEFAULT '1' COMMENT '1:早晚都乘 2:仅早上 3:仅晚上',
  `sationid` int(11) DEFAULT '0' COMMENT '站点ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 创建站点表
CREATE TABLE IF NOT EXISTS `station` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '站点名称',
  `sorder` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 插入站点数据
INSERT INTO `station` (`name`, `sorder`) VALUES
('校门口',1),
('东门',2),
('西门',3),
('南门',4),
('北门',5);

-- 创建车号表
CREATE TABLE IF NOT EXISTS `bus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL COMMENT '车号',
  `name` varchar(100) DEFAULT NULL COMMENT '车辆名称/描述',
  `capacity` int(11) DEFAULT 0 COMMENT '容量（座位数）',
  `status` int(11) DEFAULT 1 COMMENT '状态 1:正常 0:停用',
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 插入车号数据
INSERT INTO `bus` (`number`, `name`, `capacity`, `status`) VALUES
(1, '校车1号', 40, 1),
(2, '校车2号', 40, 1),
(3, '校车3号', 35, 1),
(5, '校车5号', 35, 1),
(7, '校车7号', 30, 1);

-- 创建班级表
CREATE TABLE IF NOT EXISTS `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gradeid` int(11) NOT NULL COMMENT '年级',
  `classid` int(11) NOT NULL COMMENT '班级',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 插入班级数据
INSERT INTO `class` (`gradeid`, `classid`) VALUES
(1,1),(1,2),(1,3),(1,4),
(2,1),(2,2),(2,3),(2,4),
(3,1),(3,2),(3,3),(3,4),
(4,1),(4,2),(4,3),(4,4),
(5,1),(5,2),(5,3),(5,4),
(6,1),(6,2),(6,3),(6,4);

-- 创建请假/缺勤记录表
CREATE TABLE IF NOT EXISTS `stuqj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameId` int(11) NOT NULL COMMENT '学生ID',
  `name` varchar(50) NOT NULL,
  `gradeid` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `batch` int(11) NOT NULL,
  `busnum` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  `model` int(11) NOT NULL DEFAULT '1' COMMENT '1:请假 2:缺勤',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 插入示例学生数据
INSERT INTO `stubus` (`name`, `sex`, `gradeid`, `classid`, `batch`, `busnum`, `model`, `sationid`) VALUES
('张三', '男', 1, 1, 1, 1, 1, 1),
('李四', '女', 1, 2, 1, 1, 1, 2),
('王五', '男', 2, 1, 2, 2, 1, 1),
('赵六', '女', 2, 2, 2, 2, 1, 3),
('钱七', '男', 3, 1, 1, 1, 1, 2),
('孙八', '女', 3, 2, 1, 1, 3, 4),
('周九', '男', 4, 1, 2, 2, 1, 1),
('吴十', '女', 4, 2, 2, 2, 1, 5);
