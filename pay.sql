/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : video

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-03-16 23:03:18
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `co_admin`
-- ----------------------------
DROP TABLE IF EXISTS `co_admin`;
CREATE TABLE `co_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminuser` varchar(255) DEFAULT NULL,
  `adminpass` varchar(255) DEFAULT NULL,
  `erjimima` varchar(255) DEFAULT NULL,
  `sessid` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `quanxian` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_admin
-- ----------------------------
INSERT INTO co_admin VALUES ('5', 'aspku', '328b5d3b47f531721c2a49bfe1ecc305', null, 'eqpdamtkimk4rjkptnu0743o22', '正常', 'all');

-- ----------------------------
-- Table structure for `co_agenttx`
-- ----------------------------
DROP TABLE IF EXISTS `co_agenttx`;
CREATE TABLE `co_agenttx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agentuser` varchar(255) DEFAULT NULL,
  `txje` decimal(18,3) DEFAULT NULL,
  `sxf` decimal(18,3) DEFAULT NULL,
  `sjje` decimal(18,3) DEFAULT NULL,
  `zsxm` varchar(255) DEFAULT NULL,
  `txyh` varchar(255) DEFAULT NULL,
  `txzh` varchar(255) DEFAULT NULL,
  `txsj` varchar(255) DEFAULT NULL,
  `txzt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_agenttx
-- ----------------------------
INSERT INTO co_agenttx VALUES ('68', 'agent', '10000.000', '20.000', '9980.000', '源码库', '支付宝', '12121212121', '2019-03-16 22:35:26', 'yes');

-- ----------------------------
-- Table structure for `co_agent_sys`
-- ----------------------------
DROP TABLE IF EXISTS `co_agent_sys`;
CREATE TABLE `co_agent_sys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agentuser` varchar(255) DEFAULT NULL,
  `agentpass` varchar(255) DEFAULT NULL,
  `sessid` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `yue` decimal(18,3) DEFAULT NULL,
  `dllx` varchar(255) DEFAULT NULL,
  `lrlx` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `zsxm` varchar(255) DEFAULT NULL,
  `txyh` varchar(255) DEFAULT NULL,
  `txzh` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_agent_sys
-- ----------------------------
INSERT INTO co_agent_sys VALUES ('11', 'agent', 'e10adc3949ba59abbe56e057f20f883e', 'eqpdamtkimk4rjkptnu0743o22', '正常', '0.000', '1级代理', '费率差', '13944012128', 'mail@qq.com', '源码库', '支付宝', '12121212121');

-- ----------------------------
-- Table structure for `co_api`
-- ----------------------------
DROP TABLE IF EXISTS `co_api`;
CREATE TABLE `co_api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apiname` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `apiuid` varchar(255) DEFAULT NULL,
  `apizh` text,
  `apikey` text,
  `appsecret` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `apifl` varchar(255) DEFAULT NULL,
  `apiimg` text,
  `apism` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_api
-- ----------------------------
INSERT INTO co_api VALUES ('1', 'alipay', '支付宝', '2088721643576232', '17638982@qq.com', 'vdo8zlq1h31sz7xdtep501o9nbywf0bo', null, 'yes', '0.02', '/static/images/zhifubao.Png', '不可用于涉黄赌毒，菠菜，诱导等擦边违法用途');
INSERT INTO co_api VALUES ('2', 'weixin', '微信', '1465796902', 'wx4ae0b44b7acee559', 'sdxg6546DS46dfDS5F466AS5dgvDF214', null, 'yes', '0.02', '/static/images/weixin.png', '不可用于涉黄赌毒，菠菜，诱导等擦边违法用途');
INSERT INTO co_api VALUES ('3', 'yinlian', '银联', '777290058156667', '证书验证(请勿更改此值)', '000000', null, 'yes', '0.02', '/static/images/yinlian.png', '不可用于涉黄赌毒，菠菜，诱导等擦边违法用途');
INSERT INTO co_api VALUES ('4', 'weixingz', '微信公众号', '1500952761', 'wxe0d27a8963c963a1', 'P17c8lGgWkz4q2prtzdXsfQ1cK6J2E2H', 'be307e42a2c32d65084c827449ed57d5', 'yes', '0.02', '/static/images/weixin.png', '不可用于涉黄赌毒，菠菜，诱导等擦边违法用途');
INSERT INTO co_api VALUES ('5', 'weixinh5', '微信H5', '1465796902', 'wx4ae0b44b7acee559', 'sdxg6546DS46dfDS5F466AS5dgvDF214', null, 'yes', '0.02', '/static/images/weixin.png', '不可用于涉黄赌毒，菠菜，诱导等擦边违法用途');
INSERT INTO co_api VALUES ('6', 'alipaywap', '支付宝WAP', '2018032702453581', 'MII', 'MIIEv', null, 'yes', '0.02', '/static/images/zhifubao.Png', '不可用于涉黄赌毒，菠菜，诱导等擦边违法用途');
INSERT INTO co_api VALUES ('7', 'api', 'zhifu', 'ss', 'ass', 'sas', null, 'no', '1.5', '515.png', 'dwdwdw');

-- ----------------------------
-- Table structure for `co_denglu`
-- ----------------------------
DROP TABLE IF EXISTS `co_denglu`;
CREATE TABLE `co_denglu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `dlip` varchar(255) DEFAULT NULL,
  `dlsj` varchar(255) DEFAULT NULL,
  `scdlip` varchar(255) DEFAULT NULL,
  `scdlsj` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_denglu
-- ----------------------------
INSERT INTO co_denglu VALUES ('20', 'aspku88', '127.0.0.1', '2019-03-16 18:18', null, null);

-- ----------------------------
-- Table structure for `co_diaodan`
-- ----------------------------
DROP TABLE IF EXISTS `co_diaodan`;
CREATE TABLE `co_diaodan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `ddh` varchar(255) DEFAULT NULL,
  `ddsj` varchar(255) DEFAULT NULL,
  `ddje` decimal(18,3) DEFAULT NULL,
  `ddzt` varchar(255) DEFAULT NULL,
  `ddtzzt` varchar(255) DEFAULT NULL,
  `jkbb` varchar(255) DEFAULT NULL,
  `ddtd` varchar(255) DEFAULT NULL,
  `ddtdmc` varchar(255) DEFAULT NULL,
  `ddtbtz` text,
  `ddybtz` text,
  `apiddh` varchar(255) DEFAULT NULL,
  `apiddmc` text,
  `apiddbz` text,
  `ddsxsj` varchar(255) DEFAULT NULL,
  `sdje` decimal(18,3) DEFAULT NULL,
  `hdlx` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=166 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_diaodan
-- ----------------------------

-- ----------------------------
-- Table structure for `co_dingdan`
-- ----------------------------
DROP TABLE IF EXISTS `co_dingdan`;
CREATE TABLE `co_dingdan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `ddh` varchar(255) DEFAULT NULL,
  `ddsj` varchar(255) DEFAULT NULL,
  `ddje` decimal(18,3) DEFAULT NULL,
  `ddzt` varchar(255) DEFAULT NULL,
  `ddtzzt` varchar(255) DEFAULT NULL,
  `jkbb` varchar(255) DEFAULT NULL,
  `ddtd` varchar(255) DEFAULT NULL,
  `ddtdmc` varchar(255) DEFAULT NULL,
  `ddtbtz` text,
  `ddybtz` text,
  `apiddh` varchar(255) DEFAULT NULL,
  `apiddmc` text,
  `apiddbz` text,
  `ddsxsj` varchar(255) DEFAULT NULL,
  `sdje` decimal(18,3) DEFAULT NULL,
  `agent` varchar(255) DEFAULT NULL,
  `agentje` decimal(18,3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=961 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_dingdan
-- ----------------------------
INSERT INTO co_dingdan VALUES ('943', '10050', 'aspku88', 'COPAY20190316182738M', '2019-03-16 18:27:38', '1.000', 'fail', '订单已失效', '1.0', 'alipay', '支付宝', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031665022277', '订单名称', '备注', '1552732658', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('944', '10050', 'aspku88', 'COPAY20190316185222M', '2019-03-16 18:52:22', '1.000', 'fail', '订单已失效', '1.0', 'weixin', '微信', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031665022278', '订单名称', '备注', '1552734142', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('945', '10050', 'aspku88', 'COPAY20190316185323M', '2019-03-16 18:53:23', '1.000', 'fail', '订单已失效', '1.0', 'weixinh5', '微信H5', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031665022279', '订单名称', '备注', '1552734203', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('946', '10050', 'aspku88', 'COPAY20190316190539M', '2019-03-16 19:05:39', '1.000', 'fail', '订单已失效', '1.0', 'alipaywap', '支付宝WAP', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031665022280', '订单名称', '备注', '1552734939', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('947', '10050', 'aspku88', 'COPAY20190316190551M', '2019-03-16 19:05:51', '1.000', 'fail', '订单已失效', '1.0', 'weixingz', '微信公众号', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031665022281', '订单名称', '备注', '1552734951', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('948', '10050', 'aspku88', 'COPAY20190316190722M', '2019-03-16 19:07:22', '1.000', 'fail', '订单已失效', '1.0', 'weixin', '微信', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031621324157', '订单名称', '备注', '1552735042', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('949', '10050', 'aspku88', 'COPAY20190316190916M', '2019-03-16 19:09:16', '1.000', 'fail', '订单已失效', '1.0', 'weixin', '微信', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031659020996', '订单名称', '备注', '1552735156', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('950', '10050', 'aspku88', 'COPAY20190316191043M', '2019-03-16 19:10:43', '1.000', 'fail', '订单已失效', '1.0', 'weixin', '微信', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031657125854', '订单名称', '备注', '1552735243', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('951', '10050', 'aspku88', 'COPAY20190316191411M', '2019-03-16 19:14:11', '1.000', 'fail', '订单已失效', '1.0', 'weixinh5', '微信H5', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031612507629', '订单名称', '备注', '1552735451', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('952', '10050', 'aspku88', 'COPAY20190316191420M', '2019-03-16 19:14:20', '1.000', 'fail', '订单已失效', '1.0', 'yinlian', '银联', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031659897155', '订单名称', '备注', '1552735460', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('953', '10050', 'aspku88', 'COPAY20190316191434M', '2019-03-16 19:14:34', '1.000', 'fail', '订单已失效', '1.0', 'yinlian', '银联', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031674388122', '订单名称', '备注', '1552735474', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('954', '10050', 'aspku88', 'COPAY20190316192228M', '2019-03-16 19:22:28', '1.000', 'fail', '订单已失效', '1.0', 'alipaywap', '支付宝WAP', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031694243164', '订单名称', '备注', '1552735948', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('955', '10050', 'aspku88', 'COPAY20190316192700M', '2019-03-16 19:27:00', '1.000', 'fail', '订单已失效', '1.0', 'alipaywap', '支付宝WAP', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031659916381', '订单名称', '备注', '1552736220', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('956', '10050', 'aspku88', 'COPAY20190316192937M', '2019-03-16 19:29:37', '1.000', 'fail', '订单已失效', '1.0', 'yinlian', '银联', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031627185363', '订单名称', '备注', '1552736377', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('957', '10050', 'aspku88', 'COPAY20190316205527M', '2019-03-16 20:55:27', '1.000', 'fail', '订单已失效', '1.0', 'weixin', '微信', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031625444030', '订单名称', '备注', '1552741527', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('958', '10050', 'aspku88', 'COPAY20190316221653M', '2019-03-16 22:16:53', '1.000', 'fail', '订单已失效', '1.0', 'alipaywap', '支付宝WAP', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031663712158', '订单名称', '备注', '1552746413', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('959', '10050', 'aspku88', 'COPAY20190316221740M', '2019-03-16 22:17:40', '1.000', 'fail', '订单已失效', '1.0', 'weixinh5', '微信H5', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031692806701', '订单名称', '备注', '1552746460', '0.900', '2323', '0.080');
INSERT INTO co_dingdan VALUES ('960', '10050', 'aspku88', 'YIPAY20190316225932M', '2019-03-16 22:59:32', '1.000', 'wait', '等待通知', '1.0', 'alipay', '支付宝', 'http://www.bz52.cn/demo/php/return.php', 'http://www.bz52.cn/demo/php/notify.php', '2019031627372131', '订单名称', '备注', '1552748972', '0.900', '2323', '0.080');

-- ----------------------------
-- Table structure for `co_fankui`
-- ----------------------------
DROP TABLE IF EXISTS `co_fankui`;
CREATE TABLE `co_fankui` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fkyh` varchar(255) DEFAULT NULL,
  `fkbt` varchar(255) DEFAULT NULL,
  `fkxq` varchar(255) DEFAULT NULL,
  `fksj` varchar(255) DEFAULT NULL,
  `yd` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_fankui
-- ----------------------------

-- ----------------------------
-- Table structure for `co_gonggao`
-- ----------------------------
DROP TABLE IF EXISTS `co_gonggao`;
CREATE TABLE `co_gonggao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `content` text,
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_gonggao
-- ----------------------------

-- ----------------------------
-- Table structure for `co_jiesuan`
-- ----------------------------
DROP TABLE IF EXISTS `co_jiesuan`;
CREATE TABLE `co_jiesuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `jsje` decimal(18,3) DEFAULT NULL,
  `sxf` decimal(18,3) DEFAULT NULL,
  `sjje` decimal(18,3) DEFAULT NULL,
  `xingming` varchar(255) DEFAULT NULL,
  `jsyh` varchar(255) DEFAULT NULL,
  `jszh` varchar(255) DEFAULT NULL,
  `jssj` varchar(255) DEFAULT NULL,
  `jszt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_jiesuan
-- ----------------------------

-- ----------------------------
-- Table structure for `co_khsh`
-- ----------------------------
DROP TABLE IF EXISTS `co_khsh`;
CREATE TABLE `co_khsh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shmc` varchar(255) DEFAULT NULL,
  `shmm` varchar(255) DEFAULT NULL,
  `shsj` varchar(255) DEFAULT NULL,
  `shyx` varchar(255) DEFAULT NULL,
  `lxqq` varchar(255) DEFAULT NULL,
  `shxb` varchar(255) DEFAULT NULL,
  `lxdz` varchar(255) DEFAULT NULL,
  `sjdl` varchar(255) DEFAULT NULL,
  `wzwz` varchar(255) DEFAULT NULL,
  `wzmc` varchar(255) DEFAULT NULL,
  `wzlx` varchar(255) DEFAULT NULL,
  `zsxm` varchar(255) DEFAULT NULL,
  `txyh` varchar(255) DEFAULT NULL,
  `txzh` varchar(255) DEFAULT NULL,
  `hjdz` varchar(255) DEFAULT NULL,
  `sfhm` varchar(255) DEFAULT NULL,
  `sfzm` varchar(255) DEFAULT NULL,
  `sffm` varchar(255) DEFAULT NULL,
  `sfdz` varchar(255) DEFAULT NULL,
  `shlx` varchar(255) DEFAULT NULL,
  `sj` varchar(255) DEFAULT NULL,
  `zt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_khsh
-- ----------------------------

-- ----------------------------
-- Table structure for `co_session`
-- ----------------------------
DROP TABLE IF EXISTS `co_session`;
CREATE TABLE `co_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `sessid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=362 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_session
-- ----------------------------

-- ----------------------------
-- Table structure for `co_shiming`
-- ----------------------------
DROP TABLE IF EXISTS `co_shiming`;
CREATE TABLE `co_shiming` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `sfzxm` varchar(255) DEFAULT NULL,
  `xingbie` varchar(255) DEFAULT NULL,
  `sfzhm` varchar(255) DEFAULT NULL,
  `sfzdz` varchar(255) DEFAULT NULL,
  `sfzzmtp` varchar(255) DEFAULT NULL,
  `sfzfmtp` varchar(255) DEFAULT NULL,
  `hjszd` varchar(255) DEFAULT NULL,
  `sqlx` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_shiming
-- ----------------------------

-- ----------------------------
-- Table structure for `co_system`
-- ----------------------------
DROP TABLE IF EXISTS `co_system`;
CREATE TABLE `co_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sitename` varchar(255) DEFAULT NULL,
  `siteurl` varchar(255) DEFAULT NULL,
  `sitemail` varchar(255) DEFAULT NULL,
  `sitecom` varchar(255) DEFAULT NULL,
  `sitephone` varchar(255) DEFAULT NULL,
  `sitebeian` varchar(255) DEFAULT NULL,
  `sitestatus` varchar(255) DEFAULT NULL,
  `regstatus` varchar(255) DEFAULT NULL,
  `siteweixin` varchar(255) DEFAULT NULL,
  `siteqq` varchar(255) DEFAULT NULL,
  `apistatus` varchar(255) DEFAULT NULL,
  `regfs` varchar(255) DEFAULT NULL,
  `yxfwq` varchar(255) DEFAULT NULL,
  `yxdk` varchar(255) DEFAULT NULL,
  `yxbm` varchar(255) DEFAULT NULL,
  `yxdz` varchar(255) DEFAULT NULL,
  `yxnc` varchar(255) DEFAULT NULL,
  `yxyhm` varchar(255) DEFAULT NULL,
  `yxmm` varchar(255) DEFAULT NULL,
  `ddyxq` varchar(255) DEFAULT NULL,
  `zdje` decimal(18,3) DEFAULT NULL,
  `ptddmc` varchar(255) DEFAULT NULL,
  `zgje` decimal(18,3) DEFAULT NULL,
  `smsid` varchar(255) DEFAULT NULL,
  `smskey` varchar(255) DEFAULT NULL,
  `smsqm` varchar(255) DEFAULT NULL,
  `smsmb` varchar(255) DEFAULT NULL,
  `ddstatus` varchar(255) DEFAULT NULL,
  `ddkssj` varchar(255) DEFAULT NULL,
  `ddjssj` varchar(255) DEFAULT NULL,
  `ddsksje` varchar(255) DEFAULT NULL,
  `ddsjsje` varchar(255) DEFAULT NULL,
  `ddbfbjl` varchar(255) DEFAULT NULL,
  `txsxf` decimal(18,3) DEFAULT NULL,
  `zdtxje` decimal(18,3) DEFAULT NULL,
  `txbdsxf` decimal(18,3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_system
-- ----------------------------
INSERT INTO co_system VALUES ('1', '第三方支付系统', 'www.aspku.com', 'admin@admin.com', '第三方支付系统', '4000066886', '76148203', 'yes', 'yes', '76148203', '76148203', 'yes', 'ptzc', 'smtp.qq.com', '25', 'UTF-8', 'admin@123.com', '聚合支付', 'admin@123.com', '123456', '10', '0.010', '第三方支付系统订单', '5000.000', 'LTAI12UA', 'X9gN22EBgrh', '聚合支付', 'SMS_787936634', 'no', '1', '23', '1', '50', '90', '0.002', '100.000', '5.000');

-- ----------------------------
-- Table structure for `co_userapi`
-- ----------------------------
DROP TABLE IF EXISTS `co_userapi`;
CREATE TABLE `co_userapi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `alipay` varchar(255) DEFAULT NULL,
  `alipaywap` varchar(255) DEFAULT NULL,
  `weixin` varchar(255) DEFAULT NULL,
  `yinlian` varchar(255) DEFAULT NULL,
  `weixingz` varchar(255) DEFAULT NULL,
  `weixinh5` varchar(255) DEFAULT NULL,
  `wzurl` text,
  `wzname` varchar(255) DEFAULT NULL,
  `wzlx` varchar(255) DEFAULT NULL,
  `lxfs` varchar(255) DEFAULT NULL,
  `zt` varchar(255) DEFAULT NULL,
  `sqsj` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_userapi
-- ----------------------------
INSERT INTO co_userapi VALUES ('47', 'aspku88', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'www.aspku.com', '源码库', '综合社区', '13212345678', 'yes', '2019-03-16 18:18:37');
INSERT INTO co_userapi VALUES ('48', 'hoa12', 'no', 'no', 'no', 'no', 'no', 'no', null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `co_user_sys`
-- ----------------------------
DROP TABLE IF EXISTS `co_user_sys`;
CREATE TABLE `co_user_sys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `shouji` char(255) DEFAULT NULL,
  `qq` char(255) DEFAULT NULL,
  `status` char(255) DEFAULT NULL,
  `token` char(255) DEFAULT NULL,
  `tokentime` char(255) DEFAULT NULL,
  `api` char(255) DEFAULT 'no',
  `apikey` varchar(255) DEFAULT NULL,
  `shiming` char(255) DEFAULT NULL,
  `xingbie` char(255) DEFAULT NULL,
  `dizhi` char(255) DEFAULT NULL,
  `yue` decimal(18,3) DEFAULT NULL,
  `ytxye` int(255) DEFAULT '0',
  `daili` char(255) DEFAULT NULL,
  `txzh` char(255) DEFAULT NULL,
  `feilv` char(255) DEFAULT NULL,
  `zcsj` varchar(255) DEFAULT NULL,
  `txyh` varchar(255) DEFAULT NULL,
  `xingming` char(255) DEFAULT NULL,
  `sfzhm` char(255) DEFAULT NULL,
  `sfzzm` text,
  `sfzfm` text,
  `sfzdz` varchar(255) DEFAULT NULL,
  `hjszd` varchar(255) DEFAULT NULL,
  `rztime` varchar(255) DEFAULT NULL,
  `rzlx` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10052 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_user_sys
-- ----------------------------
INSERT INTO co_user_sys VALUES ('10050', 'aspku88', '25d55ad283aa400af464c76d713c07ad', 'admin@admin.com', '13212345678', '123456', 'jihuo', null, null, 'yes', 'aej16vr9jeysfuqug7vnxxi5kq9ugk5gd2j0ehzs', 'yes', '男', '阿斯打扫打扫打扫大苏打', '0.000', '0', '2323', '134444444444', '0.1', '2019-03-16 18:18:37', '支付宝', '娃娃', '370211198106134817', '', '', '打扫打扫大阿德萨啊', '啊是大三大四的', '2019-03-16 18:18:37', 'gr');
INSERT INTO co_user_sys VALUES ('10051', 'hoa12', 'e10adc3949ba59abbe56e057f20f883e', '12334@qq.com', '13645667899', '123456', 'no', 'c203d4d9910124eb55ab1eb8f4d5349f', '1552753469', 'no', null, 'no', null, null, '0.000', '0', 'agent', null, null, '2019-03-16 22:24:29', null, null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `co_xiaoxi`
-- ----------------------------
DROP TABLE IF EXISTS `co_xiaoxi`;
CREATE TABLE `co_xiaoxi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user` varchar(255) DEFAULT NULL,
  `msg_title` text,
  `msg_text` text,
  `msg_time` varchar(255) DEFAULT NULL,
  `msg_yd` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=217 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of co_xiaoxi
-- ----------------------------
