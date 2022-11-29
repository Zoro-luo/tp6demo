/*
 Navicat MySQL Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : student

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 26/06/2020 09:34:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tp_access
-- ----------------------------
DROP TABLE IF EXISTS `tp_access`;
CREATE TABLE `tp_access`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '编号',
  `auth_id` mediumint(8) NOT NULL COMMENT '权限id',
  `role_id` mediumint(8) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_access
-- ----------------------------
INSERT INTO `tp_access` VALUES (1, 1, 1);
INSERT INTO `tp_access` VALUES (2, 2, 2);
INSERT INTO `tp_access` VALUES (3, 2, 3);
INSERT INTO `tp_access` VALUES (4, 3, 4);
INSERT INTO `tp_access` VALUES (5, 3, 5);
INSERT INTO `tp_access` VALUES (6, 5, 2);
INSERT INTO `tp_access` VALUES (7, 5, 5);
INSERT INTO `tp_access` VALUES (8, 6, 3);
INSERT INTO `tp_access` VALUES (9, 6, 4);

-- ----------------------------
-- Table structure for tp_auth
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth`;
CREATE TABLE `tp_auth`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '登录名',
  `password` char(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '登录密码',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_auth
-- ----------------------------
INSERT INTO `tp_auth` VALUES (1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b');
INSERT INTO `tp_auth` VALUES (2, '蜡笔小新', '7c4a8d09ca3762af61e59520943dc26494f8941b');
INSERT INTO `tp_auth` VALUES (3, '樱桃小丸子', '7c4a8d09ca3762af61e59520943dc26494f8941b');
INSERT INTO `tp_auth` VALUES (5, '辉夜', '7c4a8d09ca3762af61e59520943dc26494f8941b');
INSERT INTO `tp_auth` VALUES (6, '李白', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- ----------------------------
-- Table structure for tp_hobby
-- ----------------------------
DROP TABLE IF EXISTS `tp_hobby`;
CREATE TABLE `tp_hobby`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '编号',
  `user_id` mediumint(8) UNSIGNED NOT NULL COMMENT '用户id',
  `content` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '无' COMMENT '喜好内容',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_hobby
-- ----------------------------
INSERT INTO `tp_hobby` VALUES (1, 1, '喜欢大姐姐');
INSERT INTO `tp_hobby` VALUES (2, 2, '特爱吃肉');
INSERT INTO `tp_hobby` VALUES (3, 3, '朽木露琪亚');
INSERT INTO `tp_hobby` VALUES (4, 7, '暗恋小兰');
INSERT INTO `tp_hobby` VALUES (5, 5, '毕迪丽');
INSERT INTO `tp_hobby` VALUES (6, 18, '特兰克斯');
INSERT INTO `tp_hobby` VALUES (7, 10, '琦玉爷爷');
INSERT INTO `tp_hobby` VALUES (8, 15, '有空就修行');
INSERT INTO `tp_hobby` VALUES (9, 16, '会长大人');
INSERT INTO `tp_hobby` VALUES (11, 19, '喝酒');

-- ----------------------------
-- Table structure for tp_role
-- ----------------------------
DROP TABLE IF EXISTS `tp_role`;
CREATE TABLE `tp_role`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '编号',
  `type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '角色名称',
  `uri` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '访问uri',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_role
-- ----------------------------
INSERT INTO `tp_role` VALUES (1, '超级管理员', 'All');
INSERT INTO `tp_role` VALUES (2, '用户查询', 'User/index');
INSERT INTO `tp_role` VALUES (3, '用户新增', 'User/create,User/save');
INSERT INTO `tp_role` VALUES (4, '用户修改', 'User/edit,User/udpate');
INSERT INTO `tp_role` VALUES (5, '用户删除', 'User/delete');

-- ----------------------------
-- Table structure for tp_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT ' 自动编号',
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名 ',
  `password` char(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `gender` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '男' COMMENT '性别',
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邮箱',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
  `create_time` datetime(0) NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '创建时间',
  `udpate_time` datetime(0) NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_user
-- ----------------------------
INSERT INTO `tp_user` VALUES (1, '蜡笔小新', '7c4a8d09ca3762af61e59520943dc26494f8941b', '男', 'xiaoxin@163.com', 1, '2020-04-03 14:34:25', '2020-05-04 04:52:06');
INSERT INTO `tp_user` VALUES (2, '路飞', '7c4a8d09ca3762af61e59520943dc26494f8941b', '男', 'lufei@foxmail.com', 1, '2020-04-10 22:58:58', '1970-01-01 00:00:00');
INSERT INTO `tp_user` VALUES (3, '黑崎一护', '7c4a8d09ca3762af61e59520943dc26494f8941b', '男', 'yihu@163.com', 0, '2020-04-13 06:55:03', '1970-01-01 00:00:00');
INSERT INTO `tp_user` VALUES (4, '小明', '7c4a8d09ca3762af61e59520943dc26494f8941b', '男', 'xiaoming@163.com', 1, '2020-04-16 03:00:58', '1970-01-01 00:00:00');
INSERT INTO `tp_user` VALUES (5, '孙悟饭', '7c4a8d09ca3762af61e59520943dc26494f8941b', '男', 'wufan@qq.com', 1, '2020-04-30 21:00:00', '1970-01-01 00:00:00');
INSERT INTO `tp_user` VALUES (6, '樱桃小丸子', '7c4a8d09ca3762af61e59520943dc26494f8941b', '女', 'xiaowanzi@163.com', 0, '2020-05-01 18:04:55', '1970-01-01 00:00:00');
INSERT INTO `tp_user` VALUES (7, '江户川柯南', '7c4a8d09ca3762af61e59520943dc26494f8941b', '男', 'kenan@foxmail.com', 1, '2020-05-04 10:07:53', '1970-01-01 00:00:00');
INSERT INTO `tp_user` VALUES (8, '御坂美琴', '7c4a8d09ca3762af61e59520943dc26494f8941b', '女', 'meiqing@qq.com', 1, '2020-05-05 21:03:57', '1970-01-01 00:00:00');
INSERT INTO `tp_user` VALUES (9, '漩涡鸣人', '7c4a8d09ca3762af61e59520943dc26494f8941b', '男', 'mingren@163.com', 1, '2020-05-06 21:04:57', '1970-01-01 00:00:00');
INSERT INTO `tp_user` VALUES (10, '不知火舞', '7c4a8d09ca3762af61e59520943dc26494f8941b', '女', 'huowu@qq.com', 0, '2020-05-07 03:04:05', '1970-01-01 00:00:00');
INSERT INTO `tp_user` VALUES (11, '越前龙马', '7c4a8d09ca3762af61e59520943dc26494f8941b', '男', 'longma@foxmail.com', 1, '2020-05-08 06:55:04', '1970-01-01 00:00:00');
INSERT INTO `tp_user` VALUES (12, '坂本银时', '7c4a8d09ca3762af61e59520943dc26494f8941b', '男', 'yingshi@qq.com', 0, '2020-05-09 16:12:14', '1970-01-01 00:00:00');
INSERT INTO `tp_user` VALUES (13, '桔梗', '7c4a8d09ca3762af61e59520943dc26494f8941b', '女', 'jiegeng@163.com', 1, '2020-05-11 08:05:02', '1970-01-01 00:00:00');
INSERT INTO `tp_user` VALUES (14, '樱木花道', '7c4a8d09ca3762af61e59520943dc26494f8941b', '男', 'yingmu@qq.com', 1, '2020-05-12 17:54:46', '1970-01-01 00:00:00');
INSERT INTO `tp_user` VALUES (15, '鲁鲁修', '7c4a8d09ca3762af61e59520943dc26494f8941b', '男', 'luluxiu@foxmail.com', 0, '2020-05-16 16:08:49', '1970-01-01 00:00:00');
INSERT INTO `tp_user` VALUES (16, '辉夜', '7c4a8d09ca3762af61e59520943dc26494f8941b', '女', 'huiye@163.com', 1, '2020-05-19 09:15:44', '1970-01-01 00:00:00');
INSERT INTO `tp_user` VALUES (18, '李白', '601f1889667efaebb33b8c12572835da3f027f78', '男', 'libai@163.com', 0, '2020-05-26 13:49:54', '1970-01-01 00:00:00');
INSERT INTO `tp_user` VALUES (19, '李黑', '7c4a8d09ca3762af61e59520943dc26494f8941b', '男', 'lihei@163.com', 1, '2020-06-19 00:45:24', '1970-01-01 00:00:00');

SET FOREIGN_KEY_CHECKS = 1;
