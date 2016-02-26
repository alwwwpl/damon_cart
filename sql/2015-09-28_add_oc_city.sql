/*
 Navicat Premium Data Transfer

 Source Server         : sucjun
 Source Server Type    : MySQL
 Source Server Version : 50622
 Source Host           : localhost
 Source Database       : open

 Target Server Type    : MySQL
 Target Server Version : 50622
 File Encoding         : utf-8

 Date: 09/28/2015 12:41:50 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `oc_city`
-- ----------------------------
DROP TABLE IF EXISTS `oc_city`;
CREATE TABLE `oc_city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '城市ID',
  `parent` int(11) NOT NULL DEFAULT '0' COMMENT '父ID',
  `name` varchar(20) NOT NULL COMMENT '城市名称',
  `pinyin` varchar(30) NOT NULL COMMENT '拼音',
  `simplified` varchar(20) NOT NULL COMMENT '简写',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1:开启，0:关闭',
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `oc_city`
-- ----------------------------
BEGIN;
INSERT INTO `oc_city` VALUES ('1', '0', '安徽省', 'anhui', 'AH', '0'), ('2', '1', '合肥市', 'hefei', 'HF', '1'), ('3', '1', '蚌埠市', 'bengbu', 'BB', '1'), ('4', '1', '芜湖市', 'wuhui', 'WH', '1'), ('5', '1', '淮南市', 'huaina', 'HN', '1'), ('6', '1', '马鞍山市', 'maanshan', 'MAS', '1'), ('7', '1', '淮北市', 'huaibei', 'HB', '1'), ('8', '1', '铜陵市', 'tongling', 'TL', '1'), ('9', '1', '安庆市', 'anqing', 'AQ', '1'), ('10', '1', '黄山市', 'huangshan', 'HS', '1'), ('11', '1', '阜阳市', 'fuyang', 'FY', '1'), ('12', '1', '宿州市', 'suzhou', 'SZ', '1'), ('13', '1', '滁州市', 'chuzhou', 'CZ', '1'), ('14', '1', '六安市', 'luan', 'LA', '1'), ('15', '1', '宣城市', 'xuancheng', 'XC', '1'), ('16', '1', '池州市', 'chizhou', 'CZ', '1'), ('17', '1', '亳州市', 'bozhou', 'BZ', '1');
COMMIT;

