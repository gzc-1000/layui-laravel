/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : school

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2020-12-16 10:39:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `conf_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_title` varchar(50) DEFAULT '' COMMENT '//标题',
  `conf_name` varchar(50) DEFAULT '' COMMENT '//变量名',
  `conf_content` text COMMENT '//变量值',
  `conf_order` int(11) DEFAULT '0' COMMENT '//排序',
  `conf_tips` varchar(255) DEFAULT '' COMMENT '//描述',
  `field_type` varchar(50) DEFAULT '' COMMENT '//字段类型',
  `field_value` varchar(255) DEFAULT '' COMMENT '//类型值',
  PRIMARY KEY (`conf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', '网站标题', 'web_title', '兄弟连Blog系统', '1', '网站大众化标题', 'input', '');
INSERT INTO `config` VALUES ('2', '统计代码', 'web_count', '百度统计1', '3', '网站访问情况统计', 'textarea', '');
INSERT INTO `config` VALUES ('3', '网站状态', 'web_status', '1', '2', '网站开启状态', 'radio', '1|开启,0|关闭');
INSERT INTO `config` VALUES ('5', '辅助标题', 'seo_title', '无兄弟 不编程', '4', '对网站名称的补充', 'input', '');
INSERT INTO `config` VALUES ('6', '关键词', 'keywords', '北京php培训,php视频教程,php培训,php基础视频,php实例视频,lamp视频教程', '5', '', 'input', '');
INSERT INTO `config` VALUES ('7', '描述', 'description', '兄弟连教育,专注PHP培训、Java培训、UI设计培训、HTML5培训、Linux培训、Python培训,选择IT培训机构,就来兄弟连!', '6', '', 'textarea', '');
INSERT INTO `config` VALUES ('8', '版权信息', 'copyright', 'Design by 兄弟连网 <a href=\"http://www.itxdl.cn\" target=\"_blank\">http://www.itxdl.cn</a>', '7', '', 'textarea', '');
INSERT INTO `config` VALUES ('10', '网站网址', 'web_url', 'http://www.itxdl.cn', '1', '网站网址', 'input', '');
INSERT INTO `config` VALUES ('11', '备案', 'ICP', '© 2013 - 2018                 <a target=\"_blank\" rel=\"nofollow\" href=\"http://www.itxdl.cn\" style=\"display:inline-block;text-decoration:none;height:20px;line-height:20px;\"><img src=\"images/beiantubiao.png\" style=\"float:left;\" />京公网安备 53230102000151号</a> | Theme by                  <a href=http://www.itxdl.cn\" target=\"_blank\">兄弟连</a>.  |   |                  <a href=\"http://www.miitbeian.gov.cn/\" target=\"_blank\"京ICP备14001375号-1</a>', '1', null, 'textarea', '');
INSERT INTO `config` VALUES ('14', '二级标题', 'boke', '博客系统', '1', '二级标题', 'input', '');
INSERT INTO `config` VALUES ('15', '1', '21', '312', '123', '12', 'input', '');

-- ----------------------------
-- Table structure for course
-- ----------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(255) DEFAULT NULL,
  `point` varchar(255) DEFAULT NULL,
  `descript` varchar(255) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `teacher_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1214 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of course
-- ----------------------------
INSERT INTO `course` VALUES ('124', '数理统计', '2', '数理统计', '2020-08-01 15:51:20', '2020-11-14 15:51:29', null, null);
INSERT INTO `course` VALUES ('125', '数据库', '2', '数据库原理', '2020-06-15 15:52:08', '2020-11-14 15:52:25', null, null);
INSERT INTO `course` VALUES ('126', 'JAVA语言', '2', 'Java语言', '2020-11-16 15:53:12', '2020-11-14 15:53:16', null, null);
INSERT INTO `course` VALUES ('127', '概率论', '2', '概率论', '2020-11-02 15:53:51', '2020-11-14 15:53:54', null, null);
INSERT INTO `course` VALUES ('128', 'PHP和mysql', '2', 'PHP+MySQL', '2020-08-04 15:54:22', '2020-11-14 15:54:36', null, null);
INSERT INTO `course` VALUES ('1213', '12312', '123', '<p>111</p>', '2020-11-19 00:00:00', '2020-11-19 00:00:00', null, null);

-- ----------------------------
-- Table structure for score
-- ----------------------------
DROP TABLE IF EXISTS `score`;
CREATE TABLE `score` (
  `score_id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_id` varchar(255) DEFAULT NULL,
  `c_id` varchar(255) DEFAULT NULL,
  `formal_score` float DEFAULT NULL,
  `end_score` float DEFAULT NULL,
  PRIMARY KEY (`score_id`)
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of score
-- ----------------------------
INSERT INTO `score` VALUES ('201', '331', '', '90', '90');
INSERT INTO `score` VALUES ('202', '332', null, '85', '88');
INSERT INTO `score` VALUES ('203', '333', null, '99', '88');
INSERT INTO `score` VALUES ('204', '334', null, '75', '66');
INSERT INTO `score` VALUES ('205', '335', null, '65', '56');
INSERT INTO `score` VALUES ('206', '336', null, '88', '77');
INSERT INTO `score` VALUES ('207', '400', null, '0', '0');
INSERT INTO `score` VALUES ('209', '330', null, '12', '112');
INSERT INTO `score` VALUES ('210', '5555', null, '55', '55');

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `Sno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('331', 'gzc', '男', '20', '计算机应用技术', '18计应2班', '3');
INSERT INTO `student` VALUES ('332', '张同学', '女', '21', '计算机网络技术', '18计网2班', '3');
INSERT INTO `student` VALUES ('333', '李军', '男', '23', '工商管理', '17工管1班', '3');
INSERT INTO `student` VALUES ('334', '王泥', '女', '20', '计算机应用技术', '19计应1班', '3');
INSERT INTO `student` VALUES ('335', '禤禤', '女', '19', '计算机应用技术', '19计应3班', '3');
INSERT INTO `student` VALUES ('336', 'tony', '男', '22', '理发专业', '20理发1班', '3');
INSERT INTO `student` VALUES ('400', 'test', 'test', '0', 'test', 'test', '3');
INSERT INTO `student` VALUES ('330', 'gggg', '男', '22', '12', '12', null);
INSERT INTO `student` VALUES ('5555', '555', '男', '55', '55', '5', null);

-- ----------------------------
-- Table structure for teacher
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `Tno` int(11) NOT NULL AUTO_INCREMENT,
  `T_name` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`Tno`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES ('98', '刘老师', '女', '38', '工商管理', '5000', '2', '0');
INSERT INTO `teacher` VALUES ('99', '李老师', '男', '25', '商务英语', '5000', null, null);
INSERT INTO `teacher` VALUES ('101', '三老师', '男', '33', '英语', '3333', '2', '1');
INSERT INTO `teacher` VALUES ('102', '666老师', '男', '66', '计算机应用技术', '6666', '2', '1');
INSERT INTO `teacher` VALUES ('103', 'test', 'test', '0', 'test', '0', '2', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '//用户名',
  `user_pass` varchar(255) NOT NULL DEFAULT '' COMMENT '//密码',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `role` varchar(255) NOT NULL,
  `phone` varchar(11) DEFAULT NULL COMMENT '电话',
  `age` int(11) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '用户状态  1 启用 0禁用',
  `active` tinyint(4) DEFAULT '0' COMMENT '账号是否激活 0 未激活  1 激活',
  `token` varchar(255) DEFAULT NULL COMMENT '验证账号有效性',
  `expire` varchar(255) DEFAULT NULL COMMENT '账号激活是否过期时间',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COMMENT='//管理员';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'eyJpdiI6IkkreWtMUmJhMVFKcEtFY2t4MjBPdFE9PSIsInZhbHVlIjoiSUdLcTBxd3ZNOXVlVGhtZzZ5RGZPQT09IiwibWFjIjoiMGNjMzZhNjY2OGMwNzE3ZDI4NzZhNWY3Y2VkMDQ1OGRkMDBjNzVlMWYxNmE1NzY2Y2RkNjhmYzZmM2Y0MGVkNiJ9', '146866@qq.com', 'admin', '123456789', null, null, null, null, '1', '0', '0', null, null);
INSERT INTO `user` VALUES ('3', 'admin2', 'eyJpdiI6IkkreWtMUmJhMVFKcEtFY2t4MjBPdFE9PSIsInZhbHVlIjoiSUdLcTBxd3ZNOXVlVGhtZzZ5RGZPQT09IiwibWFjIjoiMGNjMzZhNjY2OGMwNzE3ZDI4NzZhNWY3Y2VkMDQ1OGRkMDBjNzVlMWYxNmE1NzY2Y2RkNjhmYzZmM2Y0MGVkNiJ9', '1234', 'admin', '123', null, null, null, null, '1', '1', '0', null, null);
INSERT INTO `user` VALUES ('8', '刘老师', 'eyJpdiI6IkkreWtMUmJhMVFKcEtFY2t4MjBPdFE9PSIsInZhbHVlIjoiSUdLcTBxd3ZNOXVlVGhtZzZ5RGZPQT09IiwibWFjIjoiMGNjMzZhNjY2OGMwNzE3ZDI4NzZhNWY3Y2VkMDQ1OGRkMDBjNzVlMWYxNmE1NzY2Y2RkNjhmYzZmM2Y0MGVkNiJ9', '213@qq.com', 'teacher', '789', '38', '女', null, '工商管理', '2', '1', '0', null, null);
INSERT INTO `user` VALUES ('2', 'gzc', 'eyJpdiI6IkkreWtMUmJhMVFKcEtFY2t4MjBPdFE9PSIsInZhbHVlIjoiSUdLcTBxd3ZNOXVlVGhtZzZ5RGZPQT09IiwibWFjIjoiMGNjMzZhNjY2OGMwNzE3ZDI4NzZhNWY3Y2VkMDQ1OGRkMDBjNzVlMWYxNmE1NzY2Y2RkNjhmYzZmM2Y0MGVkNiJ9', '146866@qq.com', 'student', 'kkkkk', '21', '男', '18计应2班', '计算机应用技术', '3', '1', '0', null, null);
INSERT INTO `user` VALUES ('6', '666老师', 'eyJpdiI6IlZGQ3ZmTEdIb0RySFBIaFczTzVWakE9PSIsInZhbHVlIjoiMmNpcHJITlpWNzhvY3JnRVRiUmp3UT09IiwibWFjIjoiNmJmMzYyNGI3MDUzMzVjNDNkM2U1NzcyNjljMzEzMjIyNmI2ZGViYTRhYmRkZjViYjViMTllZTE3ZTEzOTM0YSJ9', '5@5qq.com', 'teacher', '666666', '66', '男', null, '计算机应用技术', '2', '1', '0', null, null);
INSERT INTO `user` VALUES ('7', '张同学', 'eyJpdiI6Im92cVBheFJJNXZnWllpZDU3V0VOYWc9PSIsInZhbHVlIjoidFltNFVrOUR3TFNaZU4zOWxua1FHUT09IiwibWFjIjoiMTU5MGY1MjVjZTQzNGZmZDRjNWRmZjYzMjIxM2FiMjk4Y2NhNjE1ZmFjZTgyZDdiMzY5Y2EyZGY3M2MzNWVkOCJ9', '13052543@qq.com', 'student', null, '20', '女', '18计网2班', '计算机网络', '3', '1', '0', null, null);
INSERT INTO `user` VALUES ('5', '三老师', 'eyJpdiI6IlZGQ3ZmTEdIb0RySFBIaFczTzVWakE9PSIsInZhbHVlIjoiMmNpcHJITlpWNzhvY3JnRVRiUmp3UT09IiwibWFjIjoiNmJmMzYyNGI3MDUzMzVjNDNkM2U1NzcyNjljMzEzMjIyNmI2ZGViYTRhYmRkZjViYjViMTllZTE3ZTEzOTM0YSJ9', 'qqssxxchahah@c.com', 'teacher', '889999', '33', '男', null, '英语', '2', '1', '0', null, null);
INSERT INTO `user` VALUES ('56', '李军', 'eyJpdiI6ImFmNENtM0dRTVlVZmxIcEw1ZytjZEE9PSIsInZhbHVlIjoidlpBY3J0RVpwTWpVTXlvdVQrV2JBZz09IiwibWFjIjoiZjdjNTBjZjViOWI0OTk0NjI2NDY2NTY5ZDBlNjc5YmRmYmU2NDZhMDc5YTM2ZDQ0N2E1MjRjNTFkNGJiZWFjMSJ9', 'lalala@lal.com', 'student', null, '23', '男', '17工管1班', '工商管理', '3', '1', '0', null, null);
INSERT INTO `user` VALUES ('57', '王泥', 'eyJpdiI6Imd1b0x3bFNSekJOVGlyaWg0NWtFTFE9PSIsInZhbHVlIjoiSVZybGM4MnBHUzFOMW5DVHVZN0Nudz09IiwibWFjIjoiZWM1OGFkN2FkN2ZiNTRhNjAxOTQxNTM3YzE3NmMyOTljOTYzYjIzODUzOWJmMTJkZjYxYTk0YzFhNGVmMWU0OSJ9', 'qqq@qq.com', 'student', null, '19', '女', '19计应2班', '计算机应用技术', '3', '1', '0', null, null);
INSERT INTO `user` VALUES ('58', '禤禤', 'eyJpdiI6IktlVWFIc2w0anNtc0NFNXBkb2wxOUE9PSIsInZhbHVlIjoiYVBzSW1BOEJibk92WFVOWFF2eUhWUT09IiwibWFjIjoiMzY4N2Q1MDdlNDg2ZTlhNjBmMzUxYzI3YWY2YjUxNTAzMjhlNzVhMDdmYzg0Y2ZjNjI2YzBhYTkwZmM2YjBjZiJ9', 'qqq@qq.com', 'student', null, '20', '女', '19计应2班', '计算机应用技术', '3', '1', '0', null, null);

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `user_id` int(11) NOT NULL COMMENT '用户表在关联表中的外键',
  `role_id` int(11) NOT NULL COMMENT '角色表在关联表的外键'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_role
-- ----------------------------
INSERT INTO `user_role` VALUES ('1', '1');
INSERT INTO `user_role` VALUES ('1', '2');
