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
  `model` int(11) NOT NULL DEFAULT '1' COMMENT '1:乘车 2:单程 3:不乘车',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- 插入示例数据
INSERT INTO `stubus` (`name`, `sex`, `gradeid`, `classid`, `batch`, `busnum`, `model`) VALUES
('张三', '男', 1, 1, 1, 1, 1),
('李四', '女', 1, 2, 1, 1, 1),
('王五', '男', 2, 1, 2, 2, 1),
('赵六', '女', 2, 2, 2, 2, 1),
('钱七', '男', 3, 1, 1, 1, 1),
('孙八', '女', 3, 2, 1, 1, 3),
('周九', '男', 4, 1, 2, 2, 1),
('吴十', '女', 4, 2, 2, 2, 1);
