/*
 Navicat Premium Data Transfer

 Source Server         : x
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : easyphp

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 22/09/2020 16:33:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'kyomini@qq.com', '123456', 1);

-- ----------------------------
-- Table structure for user_auth_role
-- ----------------------------
DROP TABLE IF EXISTS `user_auth_role`;
CREATE TABLE `user_auth_role`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '角色名称',
  `pid` smallint(6) DEFAULT NULL COMMENT '父角色ID',
  `mark` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '角色唯一标识',
  `rules` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  `status` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '用户组状态：为1正常，为0禁用,-1为删除',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '描述',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  `upid` int(2) UNSIGNED DEFAULT NULL COMMENT '父级ID',
  `listorder` int(3) NOT NULL DEFAULT 0 COMMENT '排序，优先级，越小优先级越高',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `parentId`(`pid`) USING BTREE,
  INDEX `status`(`status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '角色表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_auth_role
-- ----------------------------
INSERT INTO `user_auth_role` VALUES (1, '注册用户组', 1, 'reg_user', '1', 1, '注册用户组专用角色', 0, 0, NULL, 0);

-- ----------------------------
-- Table structure for user_auth_role_user
-- ----------------------------
DROP TABLE IF EXISTS `user_auth_role_user`;
CREATE TABLE `user_auth_role_user`  (
  `role_id` int(11) UNSIGNED DEFAULT 0 COMMENT '角色 id',
  `user_id` int(11) DEFAULT 0 COMMENT '用户id',
  INDEX `group_id`(`role_id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户角色对应表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_auth_role_user
-- ----------------------------
INSERT INTO `user_auth_role_user` VALUES (1, 1);

-- ----------------------------
-- Table structure for user_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `user_auth_rule`;
CREATE TABLE `user_auth_rule`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '规则编号',
  `name` char(80) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '链接地址 模块/控制器/方法',
  `title` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '规则中文名称',
  `type` tinyint(1) DEFAULT 1 COMMENT '规则类型1pc端规则，2手机端权限 ，3 同时是手机和pc',
  `status` tinyint(1) DEFAULT 1 COMMENT '状态：为1正常，为0禁用',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '规则描述',
  `condition` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  `sort` int(10) DEFAULT 0 COMMENT '排序，优先级，越小优先级越高',
  `create_time` int(11) DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) DEFAULT 0 COMMENT '更新时间',
  `pid` int(2) UNSIGNED DEFAULT NULL COMMENT '父级ID',
  `fontawesome` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'fontawesome的图标',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '规则表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_auth_rule
-- ----------------------------
INSERT INTO `user_auth_rule` VALUES (1, '/member', '用户中心规则', 3, 1, '注册用户进入用户中心权限', '10', 0, 0, 0, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
