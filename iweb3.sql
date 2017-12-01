/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : iweb3

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-10-20 11:27:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idtblusers` int(100) NOT NULL AUTO_INCREMENT,
  `VendedorCod` varchar(50) DEFAULT NULL,
  `IDempresa` varchar(50) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `DateCreado` date DEFAULT NULL,
  `HrsCreado` varchar(100) DEFAULT NULL,
  `UserCreador` varchar(100) DEFAULT NULL,
  `GroupAsign` int(50) DEFAULT NULL,
  `privi` int(20) DEFAULT NULL,
  `ConseCutivo` int(100) DEFAULT NULL,
  PRIMARY KEY (`idtblusers`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('23', 'Local', 'UMK', 'mespinoza', 'cm7a2214', '0000-00-00', '', '', '0', '0', '0');
INSERT INTO `usuario` VALUES ('64', 'Local', 'UMK', 'F09', '7894', '0000-00-00', '', '', '0', '2', '26');
INSERT INTO `usuario` VALUES ('65', 'Local', 'UMK', 'F10', '9512', '0000-00-00', '', '', '0', '2', '7');
INSERT INTO `usuario` VALUES ('66', 'Local', 'UMK', 'F11', '4552', '0000-00-00', '', '', '0', '2', '0');
INSERT INTO `usuario` VALUES ('67', 'Local', 'UMK', 'F19', 'XXXX', '0000-00-00', '', '', '0', '2', '8');
INSERT INTO `usuario` VALUES ('68', 'Local', 'UMK', 'F20', 'VE784512', '0000-00-00', '', '', '0', '2', '1');
INSERT INTO `usuario` VALUES ('70', 'Local', 'UMK', 'F03', '4652', '0000-00-00', '', '', '0', '2', '27');
INSERT INTO `usuario` VALUES ('71', 'Local', 'UMK', 'F06', '1327', '0000-00-00', '', '', '0', '2', '44');
INSERT INTO `usuario` VALUES ('72', 'Local', 'UMK', 'F08', '7515', '0000-00-00', '', '', '0', '2', '5');
INSERT INTO `usuario` VALUES ('73', 'Local', 'UMK', 'F14', '2147', '0000-00-00', '', '', '0', '2', '8');
INSERT INTO `usuario` VALUES ('74', 'Local', 'UMK', 'F21', '2834', '0000-00-00', '', '', '0', '2', '0');
INSERT INTO `usuario` VALUES ('75', 'Local', 'UMK', 'F07', '2314', '0000-00-00', '', '', '0', '2', '1');
INSERT INTO `usuario` VALUES ('76', 'Local', 'UMK', 'F04', '4225', '0000-00-00', '', '', '0', '2', '6');
INSERT INTO `usuario` VALUES ('77', 'Local', 'UMK', 'F02', '6345', '0000-00-00', '', '', '0', '2', '0');
INSERT INTO `usuario` VALUES ('78', 'Local', 'UMK', 'F17', '9652', '0000-00-00', '', '', '0', '2', '0');
INSERT INTO `usuario` VALUES ('79', 'Local', 'UMK', 'Reyna', 'sac01', '0000-00-00', '', '', '0', '3', '0');
INSERT INTO `usuario` VALUES ('81', 'Local', 'UMK', 'Taty', 'sac03', '0000-00-00', '', '', '0', '3', '0');
INSERT INTO `usuario` VALUES ('83', 'Local', 'UMK', 'asaenzumk', 'Guma.2014!', '0000-00-00', '', '', '0', '2', '0');
INSERT INTO `usuario` VALUES ('84', 'Local', 'UMK', 'rruiz', 'r3727', '0000-00-00', '', '', '0', '2', '0');
INSERT INTO `usuario` VALUES ('86', 'Local', 'UMK', 'Gabriela', '123456', '2015-08-22', '', '', '0', '0', '0');
INSERT INTO `usuario` VALUES ('87', 'Local', 'UMK', 'SUP01', '7433', '2015-08-31', '', '', '0', '3', '0');
INSERT INTO `usuario` VALUES ('88', 'Local', 'UMK', 'SUP02', '7444', '2015-08-31', '', '', '0', '3', '0');
INSERT INTO `usuario` VALUES ('89', 'Local', 'UMK', 'F05', '3754', '2015-09-08', '', '', '0', '2', '1');
INSERT INTO `usuario` VALUES ('90', 'Local', 'UMK', 'Cesia', 'c7810', '2015-08-22', '', '', '0', '0', '0');
INSERT INTO `usuario` VALUES ('92', 'UMK', '', 'INV', '7582', '0000-00-00', '', '', '0', '2', '0');
INSERT INTO `usuario` VALUES ('93', 'Local', 'UMK', 'rlacayo', 'ggumk', '2016-02-02', '', '', '0', '2', '0');
INSERT INTO `usuario` VALUES ('94', 'UMK', 'UMK', 'NFONSECA', '7541', '2016-03-09', ' ', ' ', '0', '2', '0');
INSERT INTO `usuario` VALUES ('95', 'Local', 'UMK', 'asaenz', 'a9734', '0000-00-00', '', '', '0', '2', '0');
INSERT INTO `usuario` VALUES ('96', 'Local', 'UMK', 'jpineda', 'j1234', '0000-00-00', '', '', '0', '2', '0');
INSERT INTO `usuario` VALUES ('97', 'Local', 'UMK', 'F13', 'j4571', '2016-10-10', '', '', '0', '2', '0');
INSERT INTO `usuario` VALUES ('99', 'Local', 'UMK', 'F06', 'mas7854', '2017-01-18', '', '', '0', '2', '0');
INSERT INTO `usuario` VALUES ('103', 'Local', 'UMK', 'Vivian', 'v7131', '2017-05-08', '', '', '0', '0', '0');
INSERT INTO `usuario` VALUES ('104', 'Local', 'UMK', 'Claudia', 'sac05', '0000-00-00', '', '', '0', '2', '0');
INSERT INTO `usuario` VALUES ('105', 'Local', 'UMK', 'Maria', 'sac06', '0000-00-00', '', '', '0', '2', '0');
INSERT INTO `usuario` VALUES ('106', 'Local', 'UMK', 'Sara', 'sac04', '2017-08-23', '', '', '0', '2', '0');
INSERT INTO `usuario` VALUES ('107', 'local', 'UMK', 'admin', '1234567', '2017-10-19', null, null, null, '0', null);
