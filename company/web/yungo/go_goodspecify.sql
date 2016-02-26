# Host: 127.0.0.1  (Version: 5.5.38)
# Date: 2015-10-15 09:21:48
# Generator: MySQL-Front 5.3  (Build 4.120)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "go_goodspecify"
#

DROP TABLE IF EXISTS `go_goodspecify`;
CREATE TABLE `go_goodspecify` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned DEFAULT NULL COMMENT '会员ID',
  `gid` int(11) unsigned DEFAULT NULL COMMENT '商品ID',
  `num` int(11) unsigned DEFAULT NULL COMMENT '购买次数',
  `ok` char(20) DEFAULT '已完成' COMMENT '完成状态',
  `utitle` varchar(255) DEFAULT NULL COMMENT '会员用户名',
  `gtitle` varchar(255) DEFAULT NULL COMMENT '商品标题',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "go_goodspecify"
#

/*!40000 ALTER TABLE `go_goodspecify` DISABLE KEYS */;
/*!40000 ALTER TABLE `go_goodspecify` ENABLE KEYS */;
