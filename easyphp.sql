/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : easyphp

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 11/10/2020 09:19:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for easyphp_user
-- ----------------------------
DROP TABLE IF EXISTS `easyphp_user`;
CREATE TABLE `easyphp_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_login_time` int(10) NULL DEFAULT NULL,
  `user_leave_time` int(10) NULL DEFAULT NULL,
  `user_ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of easyphp_user
-- ----------------------------
INSERT INTO `easyphp_user` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
