/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : farm

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-02-07 17:43:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `web_admin`
-- ----------------------------
DROP TABLE IF EXISTS `web_admin`;
CREATE TABLE `web_admin` (
  `id` mediumint(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET gbk NOT NULL,
  `password` varchar(50) CHARACTER SET gbk NOT NULL,
  `logip` char(50) CHARACTER SET gbk NOT NULL COMMENT '上次登录的时间',
  `regtime` varchar(50) CHARACTER SET gbk NOT NULL COMMENT '注册时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态',
  `groupid` tinyint(2) NOT NULL COMMENT '用户组id',
  `lasttime` varchar(50) CHARACTER SET gbk NOT NULL COMMENT '上次登录的时间',
  `lognum` mediumint(9) NOT NULL COMMENT '登录次数',
  `sex` tinyint(1) NOT NULL DEFAULT '1',
  `abstract` varchar(200) CHARACTER SET gbk DEFAULT NULL,
  `email` varchar(50) CHARACTER SET gbk DEFAULT NULL,
  `address` varchar(100) CHARACTER SET gbk DEFAULT NULL,
  `mobile` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `errorlognum` mediumint(9) DEFAULT '0',
  `errorlogtime` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of web_admin
-- ----------------------------
INSERT INTO `web_admin` VALUES ('1', 'superadmin', 'cd416bee4377dce8592a9f5d21db36fc', '127.0.0.1', '1477993282', '1', '16', '1481682483', '23', '1', null, 'as1@qq.com', '1', '13128716080', '0', '0');
INSERT INTO `web_admin` VALUES ('2', 'admin', 'b37f4d4dc5a6f05837dd4c7d4c6038c8', '127.0.0.1', '1481682474', '3', '20', '1481682502', '0', '1', null, null, null, '13128716080', '0', '0');

-- ----------------------------
-- Table structure for `web_admin_code`
-- ----------------------------
DROP TABLE IF EXISTS `web_admin_code`;
CREATE TABLE `web_admin_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `effectivetime` varchar(50) DEFAULT NULL,
  `frequency` tinyint(4) DEFAULT NULL,
  `updatetime` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员修改密码的验证码表';

-- ----------------------------
-- Records of web_admin_code
-- ----------------------------

-- ----------------------------
-- Table structure for `web_article`
-- ----------------------------
DROP TABLE IF EXISTS `web_article`;
CREATE TABLE `web_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `art_title` varchar(200) NOT NULL,
  `art_info` varchar(255) NOT NULL,
  `art_keyword` varchar(200) NOT NULL,
  `art_content` text NOT NULL,
  `art_author` varchar(200) NOT NULL,
  `art_time` int(10) unsigned NOT NULL DEFAULT '0',
  `art_type` smallint(5) unsigned NOT NULL,
  `art_img` varchar(200) NOT NULL,
  `art_order` int(10) unsigned NOT NULL,
  `art_click` int(10) unsigned NOT NULL DEFAULT '0',
  `art_source` varchar(200) NOT NULL,
  `art_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `type_id` (`art_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of web_article
-- ----------------------------
INSERT INTO `web_article` VALUES ('1', '123', '', '', '<p>213123</p>', '', '1483319672', '1', '', '0', '0', '', '1');
INSERT INTO `web_article` VALUES ('2', '3424', '', '', '<p>4342</p>', '', '1485134087', '2', '', '0', '0', '', '1');

-- ----------------------------
-- Table structure for `web_articleclass`
-- ----------------------------
DROP TABLE IF EXISTS `web_articleclass`;
CREATE TABLE `web_articleclass` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `pid` mediumint(9) DEFAULT NULL,
  `art_class_name` varchar(60) CHARACTER SET gbk DEFAULT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='文章类型表';

-- ----------------------------
-- Records of web_articleclass
-- ----------------------------
INSERT INTO `web_articleclass` VALUES ('1', '0', '公告列表', '1');
INSERT INTO `web_articleclass` VALUES ('2', '0', '游戏帮助', '1');

-- ----------------------------
-- Table structure for `web_bank`
-- ----------------------------
DROP TABLE IF EXISTS `web_bank`;
CREATE TABLE `web_bank` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `bankname` varchar(30) CHARACTER SET gbk DEFAULT NULL,
  `is_hied` tinyint(1) DEFAULT '1',
  `sort` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='银行表';

-- ----------------------------
-- Records of web_bank
-- ----------------------------
INSERT INTO `web_bank` VALUES ('1', '工商银行', '1', '2');
INSERT INTO `web_bank` VALUES ('2', '建设银行', '1', '0');
INSERT INTO `web_bank` VALUES ('3', '中国银行', '1', '0');
INSERT INTO `web_bank` VALUES ('4', '农业银行', '1', '0');
INSERT INTO `web_bank` VALUES ('5', '交通银行', '1', '0');
INSERT INTO `web_bank` VALUES ('6', '招商银行', '1', '0');
INSERT INTO `web_bank` VALUES ('7', '光大银行', '1', '0');
INSERT INTO `web_bank` VALUES ('8', '平安银行', '1', '0');
INSERT INTO `web_bank` VALUES ('9', '广发银行', '1', '4');
INSERT INTO `web_bank` VALUES ('10', '中信银行', '1', '0');
INSERT INTO `web_bank` VALUES ('11', '民生银行', '1', '0');
INSERT INTO `web_bank` VALUES ('14', '平安银行', '1', '0');
INSERT INTO `web_bank` VALUES ('15', '农村商业银行', '1', '0');
INSERT INTO `web_bank` VALUES ('16', '支付宝', '1', '127');

-- ----------------------------
-- Table structure for `web_bonus`
-- ----------------------------
DROP TABLE IF EXISTS `web_bonus`;
CREATE TABLE `web_bonus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1购买种子，2卖出果实',
  `create_date` varchar(25) NOT NULL,
  `sum` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '输入',
  `export` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '输出',
  `balance` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1表示输入，2表示支出',
  `explain` varchar(100) NOT NULL COMMENT '描述',
  `admin_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_type_create_date` (`uid`,`type`,`create_date`),
  KEY `user` (`uid`),
  KEY `type` (`type`),
  KEY `create_date` (`create_date`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='奖金明细表';

-- ----------------------------
-- Records of web_bonus
-- ----------------------------
INSERT INTO `web_bonus` VALUES ('1', '1', '1', '1486345182', '1000.00', '0.00', '1000.00', '1', '线下充值', '1');
INSERT INTO `web_bonus` VALUES ('2', '1', '1', '1486345295', '0.00', '100.00', '900.00', '2', '购买玫瑰花种子*1', '0');
INSERT INTO `web_bonus` VALUES ('3', '1', '1', '1486345298', '0.00', '100.00', '800.00', '2', '购买玫瑰花种子*1', '0');
INSERT INTO `web_bonus` VALUES ('4', '1', '1', '1486345381', '0.00', '100.00', '700.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('5', '1', '1', '1486345415', '0.00', '100.00', '600.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('6', '1', '1', '1486345618', '0.00', '100.00', '500.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('7', '1', '1', '1486345732', '0.00', '100.00', '400.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('8', '1', '1', '1486345736', '0.00', '100.00', '300.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('9', '1', '1', '1486345781', '0.00', '100.00', '200.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('10', '1', '1', '1486345800', '0.00', '100.00', '100.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('11', '1', '1', '1486345805', '0.00', '100.00', '0.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('12', '1', '1', '1486346450', '1000.00', '0.00', '1000.00', '1', '线下充值', '1');
INSERT INTO `web_bonus` VALUES ('13', '1', '1', '1486346699', '0.00', '1000.00', '0.00', '2', '申请提现', '0');
INSERT INTO `web_bonus` VALUES ('14', '1', '1', '1486346763', '1000.00', '0.00', '1000.00', '1', '拒绝提现', '1');
INSERT INTO `web_bonus` VALUES ('15', '1', '1', '1486346784', '0.00', '1000.00', '0.00', '2', '申请提现', '0');
INSERT INTO `web_bonus` VALUES ('16', '1', '1', '1486346947', '1000.00', '0.00', '1000.00', '1', '线下充值', '1');
INSERT INTO `web_bonus` VALUES ('17', '1', '1', '1486346964', '0.00', '1000.00', '0.00', '2', '申请提现', '0');
INSERT INTO `web_bonus` VALUES ('18', '1', '1', '1486346973', '1000.00', '0.00', '1000.00', '1', '拒绝提现', '1');
INSERT INTO `web_bonus` VALUES ('19', '1', '1', '1486349900', '1000.00', '0.00', '2000.00', '1', '平台充值', '1');
INSERT INTO `web_bonus` VALUES ('20', '1', '1', '1486349919', '0.00', '100.00', '1900.00', '2', '平台扣币', '1');
INSERT INTO `web_bonus` VALUES ('21', '1', '1', '1486351837', '0.00', '100.00', '1800.00', '2', '购买玫瑰花种子*1', '0');
INSERT INTO `web_bonus` VALUES ('22', '1', '1', '1486362808', '0.00', '100.00', '1700.00', '2', '购买化肥种子*1', '0');
INSERT INTO `web_bonus` VALUES ('23', '1', '1', '1486362838', '0.00', '100.00', '1600.00', '2', '购买玫瑰花种子*1', '0');
INSERT INTO `web_bonus` VALUES ('24', '1', '1', '1486363700', '0.00', '100.00', '1500.00', '2', '购买玫瑰花种子*1', '0');
INSERT INTO `web_bonus` VALUES ('25', '1', '1', '1486363773', '0.00', '200.00', '1300.00', '2', '购买豌豆种子*1', '0');
INSERT INTO `web_bonus` VALUES ('26', '1', '1', '1486363859', '0.00', '200.00', '1100.00', '2', '购买豌豆种子*1', '0');
INSERT INTO `web_bonus` VALUES ('27', '1', '1', '1486370885', '1000.00', '0.00', '2100.00', '1', '卖出玫瑰花果实*5', '0');
INSERT INTO `web_bonus` VALUES ('28', '1', '1', '1486429363', '0.00', '100.00', '2000.00', '2', '购买玫瑰花种子*1', '0');
INSERT INTO `web_bonus` VALUES ('29', '1', '1', '1486429369', '0.00', '200.00', '1800.00', '2', '购买豌豆种子*1', '0');
INSERT INTO `web_bonus` VALUES ('30', '1', '1', '1486429378', '0.00', '120.00', '1680.00', '2', '购买柿子种子*1', '0');
INSERT INTO `web_bonus` VALUES ('31', '1', '1', '1486434848', '0.00', '100.00', '1580.00', '2', '购买玫瑰花种子*1', '0');
INSERT INTO `web_bonus` VALUES ('32', '1', '1', '1486434867', '0.00', '100.00', '1480.00', '2', '购买玫瑰花种子*1', '0');
INSERT INTO `web_bonus` VALUES ('33', '1', '1', '1486435079', '200.00', '0.00', '1680.00', '1', '卖出玫瑰花果实*1', '0');
INSERT INTO `web_bonus` VALUES ('34', '1', '1', '1486435102', '460.00', '0.00', '2140.00', '1', '卖出豌豆果实*2', '0');
INSERT INTO `web_bonus` VALUES ('35', '1', '1', '1486435102', '350.00', '0.00', '2490.00', '1', '卖出柿子果实*1', '0');
INSERT INTO `web_bonus` VALUES ('36', '1', '1', '1486435242', '0.00', '200.00', '2290.00', '2', '购买豌豆种子*1', '0');
INSERT INTO `web_bonus` VALUES ('37', '1', '1', '1486435575', '0.00', '100.00', '2190.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('38', '1', '1', '1486435618', '0.00', '100.00', '2090.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('39', '2', '1', '1486450501', '1000.00', '0.00', '1000.00', '1', '线下充值', '1');
INSERT INTO `web_bonus` VALUES ('40', '2', '1', '1486450512', '0.00', '100.00', '900.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('41', '2', '1', '1486450528', '0.00', '100.00', '800.00', '2', '购买玫瑰花种子*1', '0');
INSERT INTO `web_bonus` VALUES ('42', '2', '1', '1486450626', '0.00', '200.00', '600.00', '2', '购买化肥种子*1', '0');
INSERT INTO `web_bonus` VALUES ('43', '2', '1', '1486450907', '0.00', '100.00', '500.00', '2', '购买玫瑰花种子*1', '0');
INSERT INTO `web_bonus` VALUES ('44', '2', '1', '1486450924', '0.00', '200.00', '300.00', '2', '购买化肥种子*1', '0');
INSERT INTO `web_bonus` VALUES ('45', '2', '1', '1486453329', '0.00', '100.00', '200.00', '2', '购买玫瑰花种子*1', '0');
INSERT INTO `web_bonus` VALUES ('46', '2', '1', '1486453333', '0.00', '100.00', '100.00', '2', '购买玫瑰花种子*1', '0');
INSERT INTO `web_bonus` VALUES ('47', '2', '1', '1486453357', '200.00', '0.00', '300.00', '1', '卖出玫瑰花果实*1', '0');
INSERT INTO `web_bonus` VALUES ('48', '2', '1', '1486453379', '0.00', '100.00', '200.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('49', '2', '1', '1486453409', '0.00', '100.00', '100.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('50', '2', '1', '1486453412', '0.00', '100.00', '0.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('54', '1', '1', '1486455583', '0.00', '100.00', '1990.00', '2', '购买浇水种子*1', '0');
INSERT INTO `web_bonus` VALUES ('55', '1', '1', '1486455601', '0.00', '100.00', '1890.00', '2', '购买玫瑰花种子*1', '0');
INSERT INTO `web_bonus` VALUES ('56', '1', '1', '1486456160', '0.00', '200.00', '1690.00', '2', '购买豌豆种子*1', '0');
INSERT INTO `web_bonus` VALUES ('57', '1', '1', '1486456175', '0.00', '20.00', '1670.00', '2', '购买除虫种子*1', '0');
INSERT INTO `web_bonus` VALUES ('58', '1', '1', '1486456519', '0.00', '200.00', '1470.00', '2', '购买豌豆种子*1', '0');
INSERT INTO `web_bonus` VALUES ('59', '1', '1', '1486456524', '0.00', '100.00', '1370.00', '2', '购买玫瑰花种子*1', '0');
INSERT INTO `web_bonus` VALUES ('60', '1', '1', '1486456542', '0.00', '100.00', '1270.00', '2', '购买浇水*1', '0');
INSERT INTO `web_bonus` VALUES ('61', '1', '1', '1486456550', '0.00', '20.00', '1250.00', '2', '购买除虫*1', '0');
INSERT INTO `web_bonus` VALUES ('62', '1', '1', '1486456937', '0.00', '100.00', '1150.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('63', '1', '1', '1486460506', '0.00', '100.00', '1050.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('64', '1', '1', '1486460523', '0.00', '100.00', '950.00', '2', '土地开垦', '0');
INSERT INTO `web_bonus` VALUES ('65', '1', '1', '1486460566', '0.00', '100.00', '850.00', '2', '土地开垦', '0');

-- ----------------------------
-- Table structure for `web_bonusshouyi`
-- ----------------------------
DROP TABLE IF EXISTS `web_bonusshouyi`;
CREATE TABLE `web_bonusshouyi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `fid` int(11) DEFAULT NULL,
  `order_no` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `create_date` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `fbonus` decimal(18,2) DEFAULT NULL,
  `bonus` decimal(18,2) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1' COMMENT '1 直推激励奖，2团队激励奖',
  `message` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='奖金收益';

-- ----------------------------
-- Records of web_bonusshouyi
-- ----------------------------

-- ----------------------------
-- Table structure for `web_chongzhi`
-- ----------------------------
DROP TABLE IF EXISTS `web_chongzhi`;
CREATE TABLE `web_chongzhi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `money` decimal(18,2) DEFAULT '0.00',
  `uid` int(11) DEFAULT NULL,
  `bankorderno` varchar(50) CHARACTER SET gbk DEFAULT NULL COMMENT '银行交易号',
  `bank` varchar(20) CHARACTER SET gbk DEFAULT NULL COMMENT '银行',
  `status` tinyint(1) DEFAULT NULL COMMENT '1等待审核，2审核通过，3拒绝',
  `admin_id` int(11) DEFAULT NULL,
  `create_date` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `no` varchar(20) DEFAULT NULL COMMENT '订单号',
  `replace_date` varchar(20) DEFAULT NULL,
  `bankapliyname` varchar(20) DEFAULT NULL,
  `bankapliyno` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='充值表';

-- ----------------------------
-- Records of web_chongzhi
-- ----------------------------
INSERT INTO `web_chongzhi` VALUES ('1', '1000.00', '1', null, '广发银行', '3', '1', '1486345107', '2017020651484856', '1486345130', '111111', '111111');
INSERT INTO `web_chongzhi` VALUES ('2', '1000.00', '1', null, '支付宝', '2', '1', '1486345175', '2017020655561021', '1486345182', '张飞', '15820733611');
INSERT INTO `web_chongzhi` VALUES ('3', '1000.00', '1', null, '支付宝', '2', '1', '1486346401', '2017020649101102', '1486346450', '1111111', '1111111');
INSERT INTO `web_chongzhi` VALUES ('4', '1000.00', '1', null, '支付宝', '2', '1', '1486346937', '2017020657505456', '1486346947', '1000', '11111111');
INSERT INTO `web_chongzhi` VALUES ('5', '1000.00', '2', null, '支付宝', '2', '1', '1486450493', '2017020710099544', '1486450501', '1111111', '111111111');

-- ----------------------------
-- Table structure for `web_code`
-- ----------------------------
DROP TABLE IF EXISTS `web_code`;
CREATE TABLE `web_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `effectivetime` varchar(50) DEFAULT NULL,
  `frequency` tinyint(4) DEFAULT NULL,
  `updatetime` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员验证码表';

-- ----------------------------
-- Records of web_code
-- ----------------------------

-- ----------------------------
-- Table structure for `web_duebank`
-- ----------------------------
DROP TABLE IF EXISTS `web_duebank`;
CREATE TABLE `web_duebank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bankname` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `bankno` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `username` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `create_date` varchar(20) DEFAULT NULL,
  `replace_date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='收款银行';

-- ----------------------------
-- Records of web_duebank
-- ----------------------------
INSERT INTO `web_duebank` VALUES ('2', '工商银行', '11111111111111111111', '2', '刘备', '1', '1481091233', '1481091233');
INSERT INTO `web_duebank` VALUES ('3', '工商银行', '52222112121233222', '1', '曹操', '1', '1481992640', '1486345069');

-- ----------------------------
-- Table structure for `web_framdepot`
-- ----------------------------
DROP TABLE IF EXISTS `web_framdepot`;
CREATE TABLE `web_framdepot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shopid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `create_date` varchar(50) CHARACTER SET gbk DEFAULT NULL,
  `lock` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='仓库';

-- ----------------------------
-- Records of web_framdepot
-- ----------------------------
INSERT INTO `web_framdepot` VALUES ('1', '1', '1', '3', null, '0');
INSERT INTO `web_framdepot` VALUES ('2', '2', '1', '2', null, '0');
INSERT INTO `web_framdepot` VALUES ('3', '4', '1', '0', null, '0');
INSERT INTO `web_framdepot` VALUES ('4', '1', '2', '0', null, '0');

-- ----------------------------
-- Table structure for `web_framgrow`
-- ----------------------------
DROP TABLE IF EXISTS `web_framgrow`;
CREATE TABLE `web_framgrow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `shopid` int(11) DEFAULT NULL,
  `landtypeid` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '1 生长 2 完成 3铲除',
  `create_date` varchar(20) CHARACTER SET gbk DEFAULT NULL COMMENT '创建时间',
  `pick_date` varchar(20) CHARACTER SET gbk DEFAULT NULL COMMENT '收割时间',
  `integral` int(11) DEFAULT '0' COMMENT '收获产生的积分',
  `manure` int(11) DEFAULT '0' COMMENT '施肥次数',
  `hour` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='种植表';

-- ----------------------------
-- Records of web_framgrow
-- ----------------------------
INSERT INTO `web_framgrow` VALUES ('1', '1', '1', '8', '2', '1486345907', '1486365502', '0', '0', '1');
INSERT INTO `web_framgrow` VALUES ('2', '1', '1', '6', '2', '1486345908', '1486365498', '0', '0', '1');
INSERT INTO `web_framgrow` VALUES ('3', '1', '1', '7', '2', '1486351843', '1486365500', '0', '0', '1');
INSERT INTO `web_framgrow` VALUES ('4', '1', '1', '2', '2', '1486362844', '1486370044', '0', '0', '1');
INSERT INTO `web_framgrow` VALUES ('5', '1', '1', '14', '2', '1486363707', '1486370059', '0', '0', '1');
INSERT INTO `web_framgrow` VALUES ('6', '1', '2', '9', '2', '1486363879', '1486429447', '0', '1', '3');
INSERT INTO `web_framgrow` VALUES ('7', '1', '2', '7', '2', '1486372322', '1486429448', '0', '0', '3');
INSERT INTO `web_framgrow` VALUES ('8', '1', '4', '10', '2', '1486429389', '1486434761', '0', '0', '1');
INSERT INTO `web_framgrow` VALUES ('9', '1', '2', '14', '2', '1486429391', '1486446866', '0', '0', '3');
INSERT INTO `web_framgrow` VALUES ('10', '1', '1', '12', '2', '1486429397', '1486434929', '0', '0', '1');
INSERT INTO `web_framgrow` VALUES ('11', '1', '1', '2', '2', '1486434876', '1486438903', '0', '0', '1');
INSERT INTO `web_framgrow` VALUES ('12', '1', '1', '6', '2', '1486434878', '1486438904', '0', '0', '1');
INSERT INTO `web_framgrow` VALUES ('13', '1', '2', '3', '2', '1486439033', '1486456681', '0', '0', '3');
INSERT INTO `web_framgrow` VALUES ('14', '2', '1', '2', '2', '1486450547', '1486450641', '0', '1', '1');
INSERT INTO `web_framgrow` VALUES ('15', '2', '1', '2', '2', '1486450932', '1486450947', '0', '1', '1');
INSERT INTO `web_framgrow` VALUES ('16', '2', '1', '2', '1', '1486453339', null, '0', '0', '1');
INSERT INTO `web_framgrow` VALUES ('17', '2', '1', '3', '1', '1486453418', null, '0', '0', '1');
INSERT INTO `web_framgrow` VALUES ('18', '1', '1', '1', '2', '1486455608', '1486456682', '0', '1', '1');
INSERT INTO `web_framgrow` VALUES ('19', '1', '2', '7', '1', '1486456167', null, '0', '0', '3');
INSERT INTO `web_framgrow` VALUES ('20', '1', '2', '9', '1', '1486456533', null, '0', '0', '3');
INSERT INTO `web_framgrow` VALUES ('21', '1', '1', '14', '1', '1486458623', null, '0', '0', '1');

-- ----------------------------
-- Table structure for `web_framlandtype`
-- ----------------------------
DROP TABLE IF EXISTS `web_framlandtype`;
CREATE TABLE `web_framlandtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `landtype` tinyint(1) DEFAULT NULL COMMENT '代表是那块土地',
  `status` tinyint(1) DEFAULT '0' COMMENT '土地开垦状态 0 表示需要翻地，1表示可以种植，2发芽，3幼苗，4长大，5成熟',
  `image` varchar(100) CHARACTER SET gbk DEFAULT NULL,
  `create_date` varchar(20) CHARACTER SET gbk DEFAULT NULL COMMENT '创建时间',
  `grow_date` varchar(20) CHARACTER SET gbk DEFAULT NULL COMMENT '成熟时间',
  `title` varchar(30) CHARACTER SET gbk DEFAULT NULL COMMENT '种植植物的名称',
  `manure` int(11) DEFAULT '0' COMMENT '施肥次数',
  `shopid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='土地表';

-- ----------------------------
-- Records of web_framlandtype
-- ----------------------------
INSERT INTO `web_framlandtype` VALUES ('1', '1', '15', '1', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('2', '1', '14', '3', 'Public/upload/fram/rugosa/1.png', '1486458623', '1486462223', '玫瑰花', '0', '1');
INSERT INTO `web_framlandtype` VALUES ('3', '1', '13', '1', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('4', '1', '12', '1', '', '', '', '', '0', '1');
INSERT INTO `web_framlandtype` VALUES ('5', '1', '11', '1', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('6', '1', '10', '1', '', '', '', '', '0', '4');
INSERT INTO `web_framlandtype` VALUES ('7', '1', '9', '3', 'Public/upload/fram/peas/1.png', '1486456533', '1486467333', '豌豆', '0', '2');
INSERT INTO `web_framlandtype` VALUES ('8', '1', '8', '1', '', '', '', '', '0', '1');
INSERT INTO `web_framlandtype` VALUES ('9', '1', '7', '3', 'Public/upload/fram/peas/1.png', '1486456167', '1486463367', '豌豆', '1', '2');
INSERT INTO `web_framlandtype` VALUES ('10', '1', '6', '1', '', '', '', '', '0', '1');
INSERT INTO `web_framlandtype` VALUES ('11', '1', '5', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('12', '1', '4', '1', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('13', '1', '3', '1', '', '', '', '', '0', '2');
INSERT INTO `web_framlandtype` VALUES ('14', '1', '2', '1', '', '', '', '', '0', '1');
INSERT INTO `web_framlandtype` VALUES ('15', '1', '1', '1', '', '', '', '', '0', '1');
INSERT INTO `web_framlandtype` VALUES ('16', '2', '15', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('17', '2', '14', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('18', '2', '13', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('19', '2', '12', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('20', '2', '11', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('21', '2', '10', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('22', '2', '9', '1', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('23', '2', '8', '1', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('24', '2', '7', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('25', '2', '6', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('26', '2', '5', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('27', '2', '4', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('28', '2', '3', '2', null, '1486453418', '1486457018', '玫瑰花', '0', '1');
INSERT INTO `web_framlandtype` VALUES ('29', '2', '2', '2', '', '1486453339', '1486456939', '玫瑰花', '0', '1');
INSERT INTO `web_framlandtype` VALUES ('30', '2', '1', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('31', '3', '15', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('32', '3', '14', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('33', '3', '13', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('34', '3', '12', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('35', '3', '11', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('36', '3', '10', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('37', '3', '9', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('38', '3', '8', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('39', '3', '7', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('40', '3', '6', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('41', '3', '5', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('42', '3', '4', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('43', '3', '3', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('44', '3', '2', '0', null, null, null, null, '0', '0');
INSERT INTO `web_framlandtype` VALUES ('45', '3', '1', '0', null, null, null, null, '0', '0');

-- ----------------------------
-- Table structure for `web_framseed`
-- ----------------------------
DROP TABLE IF EXISTS `web_framseed`;
CREATE TABLE `web_framseed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shopid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT '0' COMMENT '种子数量',
  `type` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='种子表';

-- ----------------------------
-- Records of web_framseed
-- ----------------------------
INSERT INTO `web_framseed` VALUES ('1', '1', '1', '0', '1');
INSERT INTO `web_framseed` VALUES ('2', '5', '1', '0', '2');
INSERT INTO `web_framseed` VALUES ('3', '2', '1', '0', '1');
INSERT INTO `web_framseed` VALUES ('4', '4', '1', '0', '1');
INSERT INTO `web_framseed` VALUES ('5', '1', '2', '0', '1');
INSERT INTO `web_framseed` VALUES ('6', '5', '2', '0', '2');
INSERT INTO `web_framseed` VALUES ('10', '6', '1', '1', '2');
INSERT INTO `web_framseed` VALUES ('11', '7', '1', '1', '2');

-- ----------------------------
-- Table structure for `web_framshop`
-- ----------------------------
DROP TABLE IF EXISTS `web_framshop`;
CREATE TABLE `web_framshop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL COMMENT '植物类型 1种子 2,道具',
  `level` int(11) DEFAULT '1' COMMENT '植物等级',
  `title` varchar(50) CHARACTER SET gbk DEFAULT NULL COMMENT '植物名称',
  `love` int(11) DEFAULT '0' COMMENT '爱心值',
  `ico` varchar(100) CHARACTER SET gbk DEFAULT NULL,
  `thumb` varchar(100) CHARACTER SET gbk DEFAULT NULL COMMENT '缩略图',
  `small` varchar(100) CHARACTER SET gbk DEFAULT NULL COMMENT '树苗',
  `middle` varchar(100) CHARACTER SET gbk DEFAULT NULL COMMENT '小树',
  `large` varchar(100) CHARACTER SET gbk DEFAULT NULL COMMENT '大树',
  `money` decimal(18,0) DEFAULT '0' COMMENT '种子购买价格',
  `status` tinyint(1) DEFAULT '1' COMMENT '1 上架',
  `hour` int(20) DEFAULT NULL COMMENT '成熟的时间',
  `integral` decimal(18,0) DEFAULT '0' COMMENT '获得积分',
  `experience` decimal(18,0) DEFAULT '0' COMMENT '获得经验',
  `sellmoney` decimal(18,0) DEFAULT '0' COMMENT '果实售价',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='商店表';

-- ----------------------------
-- Records of web_framshop
-- ----------------------------
INSERT INTO `web_framshop` VALUES ('1', '1', '1', '玫瑰花', '0', 'Public/upload/fram/rugosa/rugosa.ico', 'Public/upload/fram/rugosa/thumb.png', 'Public/upload/fram/rugosa/1.png', 'Public/upload/fram/rugosa/2.png', 'Public/upload/fram/rugosa/3.png', '100', '1', '1', '150', '100', '200');
INSERT INTO `web_framshop` VALUES ('2', '1', '2', '豌豆', '0', 'Public/upload/fram/peas/peas.ico', 'Public/upload/fram/peas/thumb.png', 'Public/upload/fram/peas/1.png', 'Public/upload/fram/peas/2.png', 'Public/upload/fram/peas/3.png', '200', '1', '3', '250', '120', '230');
INSERT INTO `web_framshop` VALUES ('3', '1', '3', '芒果', '0', 'Public/upload/fram/mango/mango.ico', 'Public/upload/fram/mango/thumb.png', 'Public/upload/fram/mango/1.png', 'Public/upload/fram/mango/2.png', 'Public/upload/fram/mango/3.png', '100', '1', '1', '340', '180', '300');
INSERT INTO `web_framshop` VALUES ('4', '1', '1', '柿子', '0', 'Public/upload/fram/persimmon/persimmon.ico', 'Public/upload/fram/persimmon/thumb.png', 'Public/upload/fram/persimmon/1.png', 'Public/upload/fram/persimmon/2.png', 'Public/upload/fram/persimmon/3.png', '120', '1', '1', '455', '200', '350');
INSERT INTO `web_framshop` VALUES ('5', '2', '1', '化肥', '0', 'Public/upload/fram/huafei/hfico.ico', 'Public/upload/fram/huafei/huafeis.png', 'Public/upload/fram/huafei/huafeis.png', 'Public/upload/fram/huafei/huafeis.png', 'Public/upload/fram/huafei/huafeis.png', '200', '1', '1', '400', '50', '0');
INSERT INTO `web_framshop` VALUES ('6', '2', '1', '浇水器', '0', 'Public/upload/fram/jiaoshui/huasa.ico', 'Public/upload/fram/jiaoshui/huasa.png', 'Public/upload/fram/jiaoshui/huasa.png', 'Public/upload/fram/jiaoshui/huasa.png', 'Public/upload/fram/jiaoshui/huasa.png', '100', '1', '1', '100', '30', '0');
INSERT INTO `web_framshop` VALUES ('7', '2', '1', '除虫剂', '0', 'Public/upload/fram/chuchong/chuchong.ico', 'Public/upload/fram/chuchong/chuchong.png', 'Public/upload/fram/chuchong/chuchong.png', 'Public/upload/fram/chuchong/chuchong.png', 'Public/upload/fram/chuchong/chuchong.png', '20', '1', '1', '50', '100', '0');

-- ----------------------------
-- Table structure for `web_frozenlog`
-- ----------------------------
DROP TABLE IF EXISTS `web_frozenlog`;
CREATE TABLE `web_frozenlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `create_date` varchar(50) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '0' COMMENT '0是系统冻结，1是后台人工冻结',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='冻结日志表';

-- ----------------------------
-- Records of web_frozenlog
-- ----------------------------

-- ----------------------------
-- Table structure for `web_invest`
-- ----------------------------
DROP TABLE IF EXISTS `web_invest`;
CREATE TABLE `web_invest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(50) CHARACTER SET gbk DEFAULT NULL COMMENT '订单号',
  `uid` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '1未完成，2已经完成',
  `create_date` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `money` decimal(18,2) DEFAULT '0.00' COMMENT '投资金额',
  `day` int(11) DEFAULT '0' COMMENT '返利天数',
  `bonus` decimal(18,2) DEFAULT '0.00' COMMENT '利息',
  `sum` decimal(18,2) DEFAULT '0.00',
  `allbonus` decimal(18,2) DEFAULT '0.00',
  `replace_date` varchar(20) DEFAULT NULL,
  `pursetype` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投注表';

-- ----------------------------
-- Records of web_invest
-- ----------------------------

-- ----------------------------
-- Table structure for `web_level`
-- ----------------------------
DROP TABLE IF EXISTS `web_level`;
CREATE TABLE `web_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `experience` decimal(18,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='等级表';

-- ----------------------------
-- Records of web_level
-- ----------------------------
INSERT INTO `web_level` VALUES ('1', 'LV.0', '0');
INSERT INTO `web_level` VALUES ('2', 'LV.1', '3000');
INSERT INTO `web_level` VALUES ('3', 'LV.2', '32200');
INSERT INTO `web_level` VALUES ('4', 'LV.3', '43500');
INSERT INTO `web_level` VALUES ('5', 'LV.4', '54300');
INSERT INTO `web_level` VALUES ('6', 'LV.6', '63100');
INSERT INTO `web_level` VALUES ('7', 'LV.7', '72010');
INSERT INTO `web_level` VALUES ('8', 'LV.8', '81000');
INSERT INTO `web_level` VALUES ('9', 'LV.10', '99999');

-- ----------------------------
-- Table structure for `web_loginlog`
-- ----------------------------
DROP TABLE IF EXISTS `web_loginlog`;
CREATE TABLE `web_loginlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `ip` varchar(50) CHARACTER SET gbk DEFAULT NULL,
  `country` varchar(50) CHARACTER SET gbk DEFAULT NULL,
  `create_date` varchar(50) CHARACTER SET gbk DEFAULT NULL,
  `beginip` varchar(50) CHARACTER SET gbk DEFAULT NULL,
  `endip` varchar(50) CHARACTER SET gbk DEFAULT NULL,
  `area` varchar(50) CHARACTER SET gbk DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='登录日志';

-- ----------------------------
-- Records of web_loginlog
-- ----------------------------
INSERT INTO `web_loginlog` VALUES ('1', '1', '127.0.0.1', '本机地址', '2017-01-05 15:46:47', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('2', '1', '127.0.0.1', '本机地址', '2017-01-09 11:57:37', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('3', '1', '127.0.0.1', '本机地址', '2017-01-11 16:54:27', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('4', '1', '127.0.0.1', '本机地址', '2017-01-11 17:13:15', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('5', '1', '127.0.0.1', '本机地址', '2017-01-11 17:32:24', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('6', '1', '127.0.0.1', '本机地址', '2017-01-11 17:35:36', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('7', '1', '127.0.0.1', '本机地址', '2017-01-12 10:16:06', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('8', '1', '127.0.0.1', '本机地址', '2017-01-12 10:24:23', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('9', '1', '127.0.0.1', '本机地址', '2017-01-13 15:58:49', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('10', '1', '127.0.0.1', '本机地址', '2017-01-14 10:38:15', '127.0.0.1', '127.0.0.1', '', '2');
INSERT INTO `web_loginlog` VALUES ('11', '1', '127.0.0.1', '本机地址', '2017-01-14 10:38:24', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('12', '1', '127.0.0.1', '本机地址', '2017-01-14 11:27:37', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('13', '1', '127.0.0.1', '本机地址', '2017-01-16 09:14:21', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('14', '1', '127.0.0.1', '本机地址', '2017-01-16 09:55:28', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('15', '1', '127.0.0.1', '本机地址', '2017-02-06 08:50:37', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('16', '1', '127.0.0.1', '本机地址', '2017-02-06 10:00:30', '127.0.0.1', '127.0.0.1', '', '2');
INSERT INTO `web_loginlog` VALUES ('17', '1', '127.0.0.1', '本机地址', '2017-02-06 10:00:38', '127.0.0.1', '127.0.0.1', '', '2');
INSERT INTO `web_loginlog` VALUES ('18', '1', '127.0.0.1', '本机地址', '2017-02-06 10:00:46', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('19', '1', '127.0.0.1', '本机地址', '2017-02-06 10:05:53', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('20', '1', '127.0.0.1', '本机地址', '2017-02-06 15:19:03', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('21', '1', '127.0.0.1', '本机地址', '2017-02-06 16:46:30', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('22', '1', '127.0.0.1', '本机地址', '2017-02-07 09:09:27', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('23', '1', '127.0.0.1', '本机地址', '2017-02-07 11:33:56', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('24', '1', '127.0.0.1', '本机地址', '2017-02-07 14:02:57', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('25', '1', '127.0.0.1', '本机地址', '2017-02-07 14:18:53', '127.0.0.1', '127.0.0.1', '', '1');
INSERT INTO `web_loginlog` VALUES ('26', '1', '127.0.0.1', '本机地址', '2017-02-07 16:38:49', '127.0.0.1', '127.0.0.1', '', '1');

-- ----------------------------
-- Table structure for `web_member`
-- ----------------------------
DROP TABLE IF EXISTS `web_member`;
CREATE TABLE `web_member` (
  `id` mediumint(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET gbk NOT NULL COMMENT '账号',
  `name` varchar(50) CHARACTER SET gbk DEFAULT NULL COMMENT '昵称',
  `password` varchar(50) CHARACTER SET gbk NOT NULL,
  `towlevelpassword` varchar(50) DEFAULT '' COMMENT '二级密码',
  `status` tinyint(1) DEFAULT '1',
  `logip` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `regtime` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `mobile` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `email` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `lognum` mediumint(20) DEFAULT '0',
  `level` tinyint(1) DEFAULT '1' COMMENT '会员等级',
  `logtime` varchar(50) CHARACTER SET gbk DEFAULT NULL COMMENT '登录时间',
  `recommend` int(11) DEFAULT '0' COMMENT '推荐人id',
  `group` mediumint(9) DEFAULT '0' COMMENT '实际团队人数',
  `directnum` mediumint(9) DEFAULT '0' COMMENT '实际直推人数',
  `wechat` varchar(20) DEFAULT NULL COMMENT '微信号',
  `alipay` varchar(20) DEFAULT NULL COMMENT '支付宝账号',
  `principal` decimal(18,0) DEFAULT '0' COMMENT '本金',
  `profit` decimal(18,0) DEFAULT '0' COMMENT '收益',
  `flag` tinyint(1) DEFAULT '0',
  `banknum` tinyint(1) DEFAULT '1',
  `integral` decimal(18,0) DEFAULT '0' COMMENT '积分',
  `love` decimal(18,0) DEFAULT '0' COMMENT '爱心',
  `experience` decimal(18,0) DEFAULT '0' COMMENT '经验',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `alipay` (`alipay`),
  UNIQUE KEY `mobile` (`mobile`),
  KEY `member_name` (`username`) USING BTREE,
  KEY `member_regtime` (`regtime`),
  KEY `member_status` (`status`),
  KEY `member_name_regtime_status` (`username`,`status`,`regtime`),
  KEY `recommend` (`recommend`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='会员表';

-- ----------------------------
-- Records of web_member
-- ----------------------------
INSERT INTO `web_member` VALUES ('1', 'abc123456', 'abc', 'c2d8f4294542f6697efc08edf0ff4749', '92336aef6a84e4df090ee65b0bb14f1c', '1', null, '1486342999', '15820733619', null, '0', '2', null, '0', '2', '2', null, null, '850', '0', '0', '1', '2805', '0', '1580');
INSERT INTO `web_member` VALUES ('2', '111111', '111111', 'c2d8f4294542f6697efc08edf0ff4749', 'c2d8f4294542f6697efc08edf0ff4749', '1', '0', '1486344790', '15820733611', null, '0', '1', null, '1', '0', '0', null, null, '0', '0', '0', '1', '300', '0', '200');
INSERT INTO `web_member` VALUES ('3', 'qqqqqq', 'qqqqqq', '934c458d27bd08046e4c208dfee736c5', '', '1', '0', '1486367628', 'qqqqqq', null, '0', '1', null, '1', '0', '0', null, null, '0', '0', '0', '1', '0', '0', '0');

-- ----------------------------
-- Table structure for `web_message`
-- ----------------------------
DROP TABLE IF EXISTS `web_message`;
CREATE TABLE `web_message` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) CHARACTER SET gbk DEFAULT NULL,
  `addtime` varchar(50) CHARACTER SET gbk DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `content` varchar(1000) CHARACTER SET gbk DEFAULT NULL,
  `type` mediumint(9) DEFAULT NULL,
  `uid` mediumint(9) DEFAULT NULL,
  `reply` varchar(1000) DEFAULT NULL,
  `replytime` varchar(50) DEFAULT NULL,
  `picture` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='留言表';

-- ----------------------------
-- Records of web_message
-- ----------------------------

-- ----------------------------
-- Table structure for `web_number`
-- ----------------------------
DROP TABLE IF EXISTS `web_number`;
CREATE TABLE `web_number` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '1 本金，2收益，3直推激励奖，4团队激励奖',
  `number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='允许的次数表';

-- ----------------------------
-- Records of web_number
-- ----------------------------
INSERT INTO `web_number` VALUES ('1', '1', '1', '3');

-- ----------------------------
-- Table structure for `web_picture`
-- ----------------------------
DROP TABLE IF EXISTS `web_picture`;
CREATE TABLE `web_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(100) CHARACTER SET gbk DEFAULT NULL,
  `image_path_thumb` varchar(100) CHARACTER SET gbk DEFAULT NULL,
  `create_date` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `admin_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `replace_date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='图片表';

-- ----------------------------
-- Records of web_picture
-- ----------------------------

-- ----------------------------
-- Table structure for `web_power`
-- ----------------------------
DROP TABLE IF EXISTS `web_power`;
CREATE TABLE `web_power` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `pid` mediumint(9) DEFAULT NULL,
  `name` varchar(30) CHARACTER SET gbk DEFAULT NULL,
  `control_action` varchar(50) CHARACTER SET gbk DEFAULT NULL,
  `sort` varchar(30) CHARACTER SET gbk DEFAULT NULL,
  `level` tinyint(10) DEFAULT '0',
  `style` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8 COMMENT='栏目表';

-- ----------------------------
-- Records of web_power
-- ----------------------------
INSERT INTO `web_power` VALUES ('64', '0', '权限管理', '', '111111111', '0', '&#xe60e');
INSERT INTO `web_power` VALUES ('65', '64', '角色列表', 'Rbac/adminrole', '64-65', '1', '');
INSERT INTO `web_power` VALUES ('66', '64', '节点列表', 'Rbac/adminpermission', '64-66', '1', '');
INSERT INTO `web_power` VALUES ('67', '64', '管理员列表', 'Rbac/adminlist', '64-67', '1', '');
INSERT INTO `web_power` VALUES ('68', '0', '系统设置', '', '63', '0', '&#xe62e');
INSERT INTO `web_power` VALUES ('69', '68', '基本设置', 'Webconfig/index', '68-69', '1', '');
INSERT INTO `web_power` VALUES ('70', '65', '角色编辑', 'Rbac/adminroleedit', '64-65-70', '2', '');
INSERT INTO `web_power` VALUES ('71', '65', '添加角色', 'Rbac/adminroleadd', '64-65-71', '2', '');
INSERT INTO `web_power` VALUES ('72', '65', '删除', 'Rbac/adminRoleDel', '64-65-72', '2', '');
INSERT INTO `web_power` VALUES ('73', '65', '批量删除', 'Rbac/datadelRole', '64-65-73', '2', null);
INSERT INTO `web_power` VALUES ('74', '66', '编辑节点', 'Rbac/poweredit', '64-66-74', '2', '');
INSERT INTO `web_power` VALUES ('75', '66', '删除', 'Rbac/del', '64-66-75', '2', null);
INSERT INTO `web_power` VALUES ('76', '66', '批量删除', 'Rbac/datadelPower', '64-66-76', '2', null);
INSERT INTO `web_power` VALUES ('77', '67', '停用', 'Rbac/admin_stop', '64-67-77', '2', null);
INSERT INTO `web_power` VALUES ('78', '67', '启用', 'Rbac/admin_start', '64-67-78', '2', null);
INSERT INTO `web_power` VALUES ('79', '67', '编辑', 'Rbac/adminedit', '64-67-79', '2', null);
INSERT INTO `web_power` VALUES ('80', '67', '修改密码', 'Rbac/adminpasswordedit', '64-67-80', '2', null);
INSERT INTO `web_power` VALUES ('81', '67', '删除', 'Rbac/adminDel', '64-67-81', '2', null);
INSERT INTO `web_power` VALUES ('84', '67', '批量删除', 'Rbac/datadelAdmin', '64-67-84', '2', null);
INSERT INTO `web_power` VALUES ('85', '0', '会员管理', '', '1', '0', '&#xe60d');
INSERT INTO `web_power` VALUES ('86', '0', '文章管理', '', '11', '0', '&#xe616');
INSERT INTO `web_power` VALUES ('87', '0', '图片管理', '', '111', '-1', '&#xe613');
INSERT INTO `web_power` VALUES ('88', '0', '留言管理', '', '1111', '0', '&#xe63b');
INSERT INTO `web_power` VALUES ('89', '85', '会员列表', 'Member/index', '89-89', '1', '');
INSERT INTO `web_power` VALUES ('90', '86', '文章列表', 'Article/index', '86-90', '1', '');
INSERT INTO `web_power` VALUES ('91', '89', '添加用户', 'Member/useradd', '89-89-91', '2', null);
INSERT INTO `web_power` VALUES ('92', '86', '分类管理', 'Article/articleclass', '86-92', '-1', '');
INSERT INTO `web_power` VALUES ('93', '92', '编辑分类', 'Article/articleclassedit', '86-92-93', '2', null);
INSERT INTO `web_power` VALUES ('94', '88', '留言列表', 'Message/index', '79-94', '1', '');
INSERT INTO `web_power` VALUES ('95', '89', '启用', 'Member/user_start', '89-89-95', '2', null);
INSERT INTO `web_power` VALUES ('96', '89', '停用', 'Member/user_stop', '89-89-96', '2', '');
INSERT INTO `web_power` VALUES ('97', '89', '查看详情', 'Member/usershow', '89-89-97', '2', '');
INSERT INTO `web_power` VALUES ('98', '89', '修改资料', 'Member/useredit', '89-89-98', '2', '');
INSERT INTO `web_power` VALUES ('99', '89', '修改密码', 'Member/userpasswordedit', '89-89-99', '2', null);
INSERT INTO `web_power` VALUES ('101', '89', '删除', 'Member/userDel', '89-89-101', '2', null);
INSERT INTO `web_power` VALUES ('102', '90', '启用', 'Article/article_start', '86-90-102', '2', '');
INSERT INTO `web_power` VALUES ('103', '90', '启用', 'Article/article_stop', '86-90-103', '2', '');
INSERT INTO `web_power` VALUES ('104', '90', '批量删除', 'Article/datadelArticle', '86-90-104', '2', '');
INSERT INTO `web_power` VALUES ('105', '90', '删除', 'Article/articleDel', '86-90-105', '2', '');
INSERT INTO `web_power` VALUES ('106', '90', '查看', 'Article/articlezhang', '86-90-106', '2', '');
INSERT INTO `web_power` VALUES ('107', '90', '编辑', 'Article/articleedit', '86-90-107', '2', '');
INSERT INTO `web_power` VALUES ('108', '90', '添加', 'Article/articleadd', '86-90-108', '2', '');
INSERT INTO `web_power` VALUES ('109', '92', '删除分类', 'Article/articleClassDel', '86-92-109', '2', '');
INSERT INTO `web_power` VALUES ('111', '92', '管理分类', 'Article/articleclass', '86-92-111', '2', '');
INSERT INTO `web_power` VALUES ('112', '94', '删除', 'Message/messageDel', '79-94-112', '2', '');
INSERT INTO `web_power` VALUES ('113', '94', '批量删除', 'Message/datadelMessage', '79-94-113', '2', '');
INSERT INTO `web_power` VALUES ('114', '94', '查看/回复', 'Message/messageedit', '79-94-114', '2', '');
INSERT INTO `web_power` VALUES ('115', '87', '图片列表', 'Picture/index', '80-115', '1', null);
INSERT INTO `web_power` VALUES ('129', '115', '添加图片', 'Picture/pictureadd', '80-115-129', '2', '');
INSERT INTO `web_power` VALUES ('130', '115', '启用', 'Picture/picture_start', '80-115-130', '2', null);
INSERT INTO `web_power` VALUES ('131', '115', '停用', 'Picture/picture_stop', '80-115-131', '2', null);
INSERT INTO `web_power` VALUES ('132', '115', '编辑', 'Picture/pictureedit', '80-115-132', '2', null);
INSERT INTO `web_power` VALUES ('133', '115', '删除', 'Picture/pictureDel', '80-115-133', '2', null);
INSERT INTO `web_power` VALUES ('134', '115', '批量删除', 'Picture/datadePicture', '80-115-134', '2', null);
INSERT INTO `web_power` VALUES ('137', '117', '删除', 'Picture/partnerDel', '80-117-137', '2', null);
INSERT INTO `web_power` VALUES ('141', '117', '启用', 'Picture/partner_start', '80-117-141', '2', null);
INSERT INTO `web_power` VALUES ('142', '117', '停用', 'Picture/partner_stop', '80-117-142', '2', null);
INSERT INTO `web_power` VALUES ('167', '64', '系统日志列表', 'Rbac/loginlog', '64-167', '1', '');
INSERT INTO `web_power` VALUES ('169', '89', 'EXCEL', 'Member/downloadexcel', '89-89-169', '2', null);
INSERT INTO `web_power` VALUES ('170', '68', '银行列表', 'Webconfig/banklist', '63-170', '1', null);
INSERT INTO `web_power` VALUES ('171', '170', '停用', 'Webconfig/bank_stop', '63-170-171', '2', null);
INSERT INTO `web_power` VALUES ('172', '170', '启用', 'Webconfig/bank_start', '63-170-172', '2', null);
INSERT INTO `web_power` VALUES ('174', '170', '添加银行', 'Webconfig/bankadd', '63-170-174', '2', null);
INSERT INTO `web_power` VALUES ('175', '170', '编辑银行', 'Webconfig/bankedit', '63-170-175', '2', null);
INSERT INTO `web_power` VALUES ('176', '170', '删除银行', 'Webconfig/bankdel', '63-170-176', '2', null);
INSERT INTO `web_power` VALUES ('177', '68', '参数设置', 'Webconfig/setbonus', '63-177', '1', null);
INSERT INTO `web_power` VALUES ('187', '85', '冻结日志', 'Member/frozenlog', '89-187', '1', null);
INSERT INTO `web_power` VALUES ('188', '89', '修改二级密码', 'Member/usertowpasswordedit', '89-89-188', '2', null);
INSERT INTO `web_power` VALUES ('193', '85', '关系列表', 'Member/usertree', '89-193', '1', null);
INSERT INTO `web_power` VALUES ('194', '89', '充值', 'Member/recharge', '89-89-194', '2', null);
INSERT INTO `web_power` VALUES ('195', '89', '扣币', 'Member/deduct', '89-89-195', '2', null);
INSERT INTO `web_power` VALUES ('196', '68', '收款银行', 'Webconfig/duebank', '63-196', '1', null);
INSERT INTO `web_power` VALUES ('197', '196', '添加收款银行', 'Webconfig/duebankadd', '63-196-197', '2', '');
INSERT INTO `web_power` VALUES ('198', '196', '编辑收款银行', 'Webconfig/duebankedit', '63-196-198', '2', null);
INSERT INTO `web_power` VALUES ('199', '196', '启用', 'Webconfig/duebank_start', '63-196-199', '2', null);
INSERT INTO `web_power` VALUES ('200', '196', '停用', 'Webconfig/duebank_stop', '63-196-200', '2', null);
INSERT INTO `web_power` VALUES ('201', '0', '财务管理', '', '201', '0', '&#xe687');
INSERT INTO `web_power` VALUES ('202', '201', '充值明细', 'Report/recharge', '201-202', '1', null);
INSERT INTO `web_power` VALUES ('203', '201', '资金明细', 'Report/zijinlist', '201-203', '1', null);
INSERT INTO `web_power` VALUES ('204', '201', '投资收益', 'Report/touzishouyi', '201-204', '-1', '');
INSERT INTO `web_power` VALUES ('205', '201', '会员充值', 'Report/chongzhilist', '201-205', '1', null);
INSERT INTO `web_power` VALUES ('206', '201', '会员提现', 'Report/tixianlist', '201-206', '1', null);
INSERT INTO `web_power` VALUES ('207', '205', '确认收款', 'Report/ConfirmReceipt', '201-205-207', '2', null);
INSERT INTO `web_power` VALUES ('208', '205', '拒绝收款', 'Report/RefuseCollection', '201-205-208', '2', null);
INSERT INTO `web_power` VALUES ('209', '206', '确认打款', 'Report/FinishedPlaying', '201-206-209', '2', null);
INSERT INTO `web_power` VALUES ('210', '206', '拒绝打款', 'Report/RefuseToPlay', '201-206-210', '2', null);
INSERT INTO `web_power` VALUES ('212', '201', '直推收益', 'Report/tuijianbonus', '201-212', '-1', null);
INSERT INTO `web_power` VALUES ('213', '201', '团队收益', 'Report/tuanduibonus', '201-213', '-1', null);
INSERT INTO `web_power` VALUES ('214', '201', '投资列表', 'Report/touzilist', '201-214', '-1', null);
INSERT INTO `web_power` VALUES ('215', '201', '投资金额', 'Report/total', '201-215', '-1', null);
INSERT INTO `web_power` VALUES ('216', '0', '农场管理', '', '216', '0', '&#xe68c');
INSERT INTO `web_power` VALUES ('217', '216', '商店管理', 'Farm/shop', '216-217', '1', null);
INSERT INTO `web_power` VALUES ('218', '216', '仓库管理', 'Farm/depot', '216-218', '1', null);
INSERT INTO `web_power` VALUES ('219', '216', '种植记录', 'Farm/grow', '216-219', '1', null);

-- ----------------------------
-- Table structure for `web_recharge`
-- ----------------------------
DROP TABLE IF EXISTS `web_recharge`;
CREATE TABLE `web_recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT NULL,
  `number` decimal(18,0) DEFAULT '0' COMMENT '数量',
  `uid` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `create_date` varchar(50) CHARACTER SET gbk DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1表示充值，2表示扣币',
  PRIMARY KEY (`id`),
  KEY `user_type_create_date` (`type`,`uid`,`create_date`),
  KEY `user` (`uid`),
  KEY `type` (`type`),
  KEY `create_date` (`create_date`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='后台充值记录表';

-- ----------------------------
-- Records of web_recharge
-- ----------------------------
INSERT INTO `web_recharge` VALUES ('1', '1', '1000', '1', '1', '1486345182', '1');
INSERT INTO `web_recharge` VALUES ('2', '1', '1000', '1', '1', '1486346450', '1');
INSERT INTO `web_recharge` VALUES ('3', '1', '1000', '1', '1', '1486346947', '1');
INSERT INTO `web_recharge` VALUES ('4', '1', '1000', '1', '1', '1486349900', '1');
INSERT INTO `web_recharge` VALUES ('5', '1', '100', '1', '1', '1486349919', '2');
INSERT INTO `web_recharge` VALUES ('6', '1', '1000', '2', '1', '1486450501', '1');

-- ----------------------------
-- Table structure for `web_role`
-- ----------------------------
DROP TABLE IF EXISTS `web_role`;
CREATE TABLE `web_role` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(50) CHARACTER SET gbk DEFAULT NULL,
  `remarks` varchar(100) CHARACTER SET gbk DEFAULT NULL,
  `power_id` varchar(10000) CHARACTER SET gbk DEFAULT NULL,
  `power_control_action` varchar(10000) CHARACTER SET gbk DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='分组表';

-- ----------------------------
-- Records of web_role
-- ----------------------------
INSERT INTO `web_role` VALUES ('19', '超级管理员', '', '64,65,70,71,72,73,66,74,75,76,67,77,78,79,80,81,84,167,68,69,170,171,172,174,175,176,177,196,197,198,199,200,211,85,89,91,95,96,97,98,99,101,169,188,194,195,187,193,86,90,102,103,104,105,106,107,108,87,115,129,130,131,132,133,134,88,94,112,113,114,201,202,203,204,205,207,208,206,209,210,212,213,214', 'Rbac/adminrole,Rbac/adminpermission,Rbac/adminlist,,Webconfig/index,Rbac/adminroleedit,Rbac/adminroleadd,Rbac/adminRoleDel,Rbac/datadelRole,Rbac/poweredit,Rbac/del,Rbac/datadelPower,Rbac/admin_stop,Rbac/admin_start,Rbac/adminedit,Rbac/adminpasswordedit,Rbac/adminDel,Rbac/datadelAdmin,,,,,Member/index,Article/index,Member/useradd,Message/index,Member/user_start,Member/user_stop,Member/usershow,Member/useredit,Member/userpasswordedit,Member/userDel,Article/article_start,Article/article_stop,Article/datadelArticle,Article/articleDel,Article/articlezhang,Article/articleedit,Article/articleadd,Message/messageDel,Message/datadelMessage,Message/messageedit,Picture/index,Picture/pictureadd,Picture/picture_start,Picture/picture_stop,Picture/pictureedit,Picture/pictureDel,Picture/datadePicture,Rbac/loginlog,Member/downloadexcel,Webconfig/banklist,Webconfig/bank_stop,Webconfig/bank_start,Webconfig/bankadd,Webconfig/bankedit,Webconfig/bankdel,Webconfig/setbonus,Member/frozenlog,Member/usertowpasswordedit,Member/usertree,Member/recharge,Member/deduct,Webconfig/duebank,Webconfig/duebankadd,Webconfig/duebankedit,Webconfig/duebank_start,Webconfig/duebank_stop,,Report/recharge,Report/zijinlist,Report/touzishouyi,Report/chongzhilist,Report/tixianlist,Report/ConfirmReceipt,Report/RefuseCollection,Report/FinishedPlaying,Report/RefuseToPlay,Webconfig/setbili,Report/tuijianbonus,Report/tuanduibonus,Report/touzilist');
INSERT INTO `web_role` VALUES ('20', '普通管理员', '', '85,89,91,95,96,97,98,99,101,169,188,194,195', ',Member/index,Member/useradd,Member/user_start,Member/user_stop,Member/usershow,Member/useredit,Member/userpasswordedit,Member/userDel,Member/downloadexcel,Member/usertowpasswordedit,Member/recharge,Member/deduct');

-- ----------------------------
-- Table structure for `web_shouyi`
-- ----------------------------
DROP TABLE IF EXISTS `web_shouyi`;
CREATE TABLE `web_shouyi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `money` decimal(18,2) DEFAULT '0.00',
  `sum` decimal(18,2) DEFAULT '0.00',
  `uid` int(11) DEFAULT NULL,
  `create_date` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `order_date` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `rate` varchar(10) DEFAULT NULL,
  `order_no` varchar(50) CHARACTER SET gbk DEFAULT NULL,
  `bonus` decimal(18,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`create_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='每日收益表';

-- ----------------------------
-- Records of web_shouyi
-- ----------------------------

-- ----------------------------
-- Table structure for `web_tixian`
-- ----------------------------
DROP TABLE IF EXISTS `web_tixian`;
CREATE TABLE `web_tixian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `money` decimal(18,2) DEFAULT '0.00',
  `uid` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '1表示审核，2审核通过，3拒绝',
  `type` tinyint(1) DEFAULT NULL COMMENT '1本金提现，2利息提现',
  `create_date` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `no` varchar(20) DEFAULT NULL,
  `replace_date` varchar(20) DEFAULT NULL,
  `pursetype` tinyint(4) DEFAULT NULL,
  `poundage` decimal(18,2) DEFAULT '0.00',
  `bank` varchar(15) DEFAULT NULL,
  `bankno` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `userbank_id` int(11) DEFAULT NULL,
  `kaihubank` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`type`,`create_date`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='提现表';

-- ----------------------------
-- Records of web_tixian
-- ----------------------------
INSERT INTO `web_tixian` VALUES ('1', '1000.00', '1', '3', '1', '1486346699', '1', '2017020698535399', '1486346763', '1', '35.00', '工商银行', '111111111111', '1111111', '1', '111111111111');
INSERT INTO `web_tixian` VALUES ('2', '1000.00', '1', '2', '1', '1486346784', '1', '2017020648531025', '1486346788', '1', '35.00', '工商银行', '111111111111', '1111111', '1', '111111111111');
INSERT INTO `web_tixian` VALUES ('3', '1000.00', '1', '3', '1', '1486346964', '1', '2017020652981019', '1486346973', '1', '35.00', '工商银行', '111111111111', '1111111', '1', '111111111111');

-- ----------------------------
-- Table structure for `web_total`
-- ----------------------------
DROP TABLE IF EXISTS `web_total`;
CREATE TABLE `web_total` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `grouptotalmoney` decimal(18,0) DEFAULT '0',
  `grouptotalsum` decimal(18,0) DEFAULT '0',
  `selftotalmoney` decimal(18,0) DEFAULT '0',
  `selftotalsum` decimal(18,0) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投资金额总数表';

-- ----------------------------
-- Records of web_total
-- ----------------------------

-- ----------------------------
-- Table structure for `web_userbank`
-- ----------------------------
DROP TABLE IF EXISTS `web_userbank`;
CREATE TABLE `web_userbank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `bank` varchar(30) CHARACTER SET gbk DEFAULT NULL,
  `bankno` varchar(60) DEFAULT NULL,
  `username` varchar(30) CHARACTER SET gbk DEFAULT NULL,
  `kaihubank` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='会员银行';

-- ----------------------------
-- Records of web_userbank
-- ----------------------------
INSERT INTO `web_userbank` VALUES ('1', '1', '工商银行', '111111111111', '1111111', '111111111111');

-- ----------------------------
-- Table structure for `web_webconfig`
-- ----------------------------
DROP TABLE IF EXISTS `web_webconfig`;
CREATE TABLE `web_webconfig` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `describe` varchar(50) CHARACTER SET gbk DEFAULT NULL,
  `value` varchar(2000) CHARACTER SET gbk DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='基本设置表';

-- ----------------------------
-- Records of web_webconfig
-- ----------------------------
INSERT INTO `web_webconfig` VALUES ('1', '基本设置', '{\"smsusername\":\"\",\"smspassword\":\"\",\"onoff\":\"1\",\"chaoshi\":\"0\",\"webname\":\"\",\"weburl\":\"192.168.1.86:8080\",\"title\":\"\",\"keywords\":\"\",\"description\":\"\",\"copyright\":\"\",\"icp\":\"\",\"cnzz\":\"\",\"ip\":\"\",\"num\":\"5\"}');
INSERT INTO `web_webconfig` VALUES ('2', '参数设置', '{\"touzi_status\":\"1\",\"tixian_status\":\"1\",\"chongzhi_status\":\"1\",\"webmsg\":\"\\u7cfb\\u7edf\\u7ef4\\u62a4\\u4e2d\\uff01\\u8bf7\\u7b49\\u5019\\u901a\\u77e5\\u3002\",\"topmsg\":\"\",\"daymsg\":\"\",\"benjintianshu\":\"2\",\"benjincishu\":\"6\",\"benjinzuidi\":\"1000\",\"benjinshuxufei\":\"3.5\",\"benjinzuigaotixian\":\"50000\",\"zuidicongzhimoney\":\"1000\",\"zuigaocongzhimoney\":\"50000\",\"chongzhimoneybeishu\":\"1000\",\"benjinbeishu\":\"1000\",\"lxtxzxz\":\"100\",\"lxtxbs\":\"100\",\"lxsxf\":\"5\",\"ztjlj\":\"10\",\"tdjlj\":\"4\",\"tdtzje\":\"500000\"}');
DROP TRIGGER IF EXISTS `addframland`;
DELIMITER ;;
CREATE TRIGGER `addframland` AFTER INSERT ON `web_member` FOR EACH ROW begin
DECLARE n int;
set n=15;
while  n>0  do
   insert into web_framlandtype (uid,landtype) values(new.id,n);
set n=n-1;
end while;
end
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `delframland`;
DELIMITER ;;
CREATE TRIGGER `delframland` AFTER DELETE ON `web_member` FOR EACH ROW begin
  delete  from web_framlandtype where uid=old.id;
end
;;
DELIMITER ;
