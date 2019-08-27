/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50714
 Source Host           : localhost:3306
 Source Schema         : ebuy

 Target Server Type    : MySQL
 Target Server Version : 50714
 File Encoding         : 65001

 Date: 27/08/2019 22:06:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for eb_access
-- ----------------------------
DROP TABLE IF EXISTS `eb_access`;
CREATE TABLE `eb_access`  (
  `access_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `parent_id` smallint(5) UNSIGNED NOT NULL COMMENT '权限父id',
  `access_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '权限名称',
  `access_string` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '权限字符串',
  `access_mode` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模块名',
  `access_controller` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '控制器名',
  `access_action` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '动作名',
  `add_time` int(11) NOT NULL DEFAULT 0 COMMENT '权限录入时间',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示，1显示，0不显示，默认1',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态，1正常，0删除，默认1',
  PRIMARY KEY (`access_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eb_access
-- ----------------------------
INSERT INTO `eb_access` VALUES (1, 0, '用户管理', 'User/index', 'Backstage', 'User', 'index', 0, 1, 1);
INSERT INTO `eb_access` VALUES (2, 1, '用户列表', 'User/index', 'Backstage', 'User', 'index', 0, 1, 1);
INSERT INTO `eb_access` VALUES (3, 1, '编辑用户', 'User/edit', 'Backstage', 'User', 'edit', 0, 1, 1);
INSERT INTO `eb_access` VALUES (4, 1, '新增用户', 'User/add', 'Backstage', 'User', 'add', 0, 1, 1);
INSERT INTO `eb_access` VALUES (5, 1, '删除用户', 'User/del', 'Backstage', 'User', 'del', 0, 1, 1);
INSERT INTO `eb_access` VALUES (6, 0, '商品管理', 'Goods/index', 'Backstage', 'Goods', 'index', 0, 1, 1);
INSERT INTO `eb_access` VALUES (7, 6, '商品列表', 'Goods/index', 'Backstage', 'Goods', 'index', 0, 1, 1);
INSERT INTO `eb_access` VALUES (8, 6, '编辑商品', 'Goods/edit', 'Backstage', 'Goods', 'edit', 0, 1, 1);
INSERT INTO `eb_access` VALUES (9, 6, '新增商品', 'Goods/add', 'Backstage', 'Goods', 'add', 0, 1, 1);
INSERT INTO `eb_access` VALUES (10, 6, '删除商品', 'Goods/del', 'Backstage', 'Goods', 'del', 0, 1, 1);
INSERT INTO `eb_access` VALUES (11, 0, '权限管理', 'Access/index', 'Backstage', 'Access', 'index', 0, 1, 1);
INSERT INTO `eb_access` VALUES (12, 11, '权限列表', 'Access/index', 'Backstage', 'Access', 'index', 0, 1, 1);
INSERT INTO `eb_access` VALUES (13, 11, '新增权限', 'Access/add', 'Backstage', 'Access', 'add', 0, 1, 1);
INSERT INTO `eb_access` VALUES (14, 11, '编辑权限', 'Access/edit', 'Backstage', 'Access', 'edit', 0, 1, 1);
INSERT INTO `eb_access` VALUES (15, 11, '删除权限', 'Access/del', 'Backstage', 'Access', 'del', 0, 1, 1);
INSERT INTO `eb_access` VALUES (16, 0, '角色管理', 'Role/index', 'Backstage', 'Role', 'index', 0, 1, 1);
INSERT INTO `eb_access` VALUES (17, 16, '角色列表', 'Role/index', 'Backstage', 'Role', 'index', 0, 1, 1);
INSERT INTO `eb_access` VALUES (18, 16, '编辑角色', 'Role/edit', 'Backstage', 'Role', 'edit', 0, 1, 1);
INSERT INTO `eb_access` VALUES (19, 16, '新增角色', 'Role/add', 'Backstage', 'Role', 'add', 0, 1, 1);
INSERT INTO `eb_access` VALUES (20, 16, '删除角色', 'Role/del', 'Backstage', 'Role', 'del', 0, 1, 1);
INSERT INTO `eb_access` VALUES (21, 6, '商品上架', 'Goods/up', 'Backstage', 'Goods', 'up', 0, 1, 1);
INSERT INTO `eb_access` VALUES (22, 1, '用户等级', 'User/level', 'Backstage', 'User', 'level', 0, 1, 1);

-- ----------------------------
-- Table structure for eb_category
-- ----------------------------
DROP TABLE IF EXISTS `eb_category`;
CREATE TABLE `eb_category`  (
  `cat_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `parent_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分类的父分类id',
  `cat_name` varchar(90) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '分类名称',
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '关键字',
  `cat_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '分类描述',
  `sort_order` tinyint(1) UNSIGNED NOT NULL DEFAULT 50 COMMENT '排序',
  `template_file` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `measure_unit` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `show_in_nav` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否在导航栏中显示',
  `is_show` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否显示，1是，0否，默认1',
  `filter_attr` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `is_rec` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否推荐，1是，0否，默认1',
  PRIMARY KEY (`cat_id`) USING BTREE,
  INDEX `parent_id`(`parent_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 32 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eb_category
-- ----------------------------
INSERT INTO `eb_category` VALUES (1, 0, '家用电器', '电器，高质量', '电器的好坏需要保养', 40, '', '件', 1, 1, '0', 0);
INSERT INTO `eb_category` VALUES (2, 0, '手机', '', '', 50, '', '', 0, 1, '0', 1);
INSERT INTO `eb_category` VALUES (3, 0, '电脑', '', '', 50, '', '台', 0, 1, '0', 1);
INSERT INTO `eb_category` VALUES (4, 0, '服装', '', '', 50, '', '', 0, 0, '0', 1);
INSERT INTO `eb_category` VALUES (5, 0, '鞋', '', '', 50, '', '', 0, 0, '0', 1);
INSERT INTO `eb_category` VALUES (6, 0, '数码', '', '', 50, '', '', 1, 0, '0', 1);
INSERT INTO `eb_category` VALUES (7, 0, '家具', '', '', 50, '', '', 1, 0, '0', 1);
INSERT INTO `eb_category` VALUES (8, 0, '美妆', '', '我要画个美美的妆。', 50, '', '', 0, 0, '0', 1);
INSERT INTO `eb_category` VALUES (9, 1, '电视', '', '', 10, '', '', 1, 1, '0', 1);
INSERT INTO `eb_category` VALUES (10, 1, '空调', '', '', 50, '', '', 0, 1, '0', 1);
INSERT INTO `eb_category` VALUES (11, 1, '洗衣机', '', '', 50, '', '', 0, 1, '0', 1);
INSERT INTO `eb_category` VALUES (12, 1, '冰箱', '', '', 50, '', '', 0, 0, '0', 1);
INSERT INTO `eb_category` VALUES (13, 9, '4k超清电视', '', '', 50, '', '', 0, 1, '0', 1);
INSERT INTO `eb_category` VALUES (14, 9, '超薄电视', '', '', 50, '', '', 1, 1, '0', 1);
INSERT INTO `eb_category` VALUES (15, 10, '中央空调', '', '', 50, '', '', 0, 1, '0', 1);
INSERT INTO `eb_category` VALUES (16, 10, '省电空调', '', '', 50, '', '', 0, 0, '0', 1);
INSERT INTO `eb_category` VALUES (17, 10, '移动空调', '', '', 50, '', '', 0, 0, '0', 1);
INSERT INTO `eb_category` VALUES (18, 2, '游戏手机', '', '', 50, '', '', 0, 0, '0', 1);
INSERT INTO `eb_category` VALUES (19, 2, '老人手机', '', '', 50, '', '', 0, 1, '0', 1);
INSERT INTO `eb_category` VALUES (20, 2, '智能手机', '', '', 50, '', '', 0, 1, '0', 1);
INSERT INTO `eb_category` VALUES (21, 20, '苹果手机', '', '', 50, '', '', 1, 1, '0', 1);
INSERT INTO `eb_category` VALUES (23, 20, '华为手机', '', '', 50, '', '', 0, 1, '0', 1);
INSERT INTO `eb_category` VALUES (24, 23, '华为荣耀系列手机', '', '', 50, '', '', 0, 1, '0', 1);
INSERT INTO `eb_category` VALUES (26, 24, '荣耀20i', '', '', 50, '', '', 0, 0, '0', 1);
INSERT INTO `eb_category` VALUES (27, 24, '荣耀20 pro', '', '', 50, '', '', 0, 1, '0', 1);
INSERT INTO `eb_category` VALUES (28, 21, 'iphone7', '', '', 50, '', '', 0, 0, '0', 1);
INSERT INTO `eb_category` VALUES (29, 21, 'iphone XR', '', '', 50, '', '', 0, 1, '0', 1);
INSERT INTO `eb_category` VALUES (30, 3, 'thinkpad', '联想，笔记本', 'thinkpad笔记本电脑', 12, '', '台', 1, 1, '0', 1);
INSERT INTO `eb_category` VALUES (31, 19, '无用分类', '', '', 255, '', '东方大道', 1, 0, '0', 1);

-- ----------------------------
-- Table structure for eb_goods
-- ----------------------------
DROP TABLE IF EXISTS `eb_goods`;
CREATE TABLE `eb_goods`  (
  `good_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `good_sn` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品货号',
  `good_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品名',
  `good_desc` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品简短描述',
  `cat_id` smallint(5) NOT NULL COMMENT '商品分类id',
  `market_price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '市场价',
  `sale_price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '本店售价',
  `promote_price` decimal(10, 2) NOT NULL COMMENT '促销价格',
  `promote_start_date` int(11) NOT NULL COMMENT '促销开始时间',
  `promote_end_date` int(11) NOT NULL COMMENT '促销结束时间',
  `good_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品主图',
  `good_thumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品缩略图',
  `is_hot` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否热卖，1是，0否，默认1是',
  `is_new` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否新品，1是，0否，默认1是',
  `is_rec` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否推荐，1是，0否，默认1是',
  `is_del` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除，1是，0否，默认0否',
  `is_sale` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否上架，1是，0否，默认1是',
  `addtime` int(11) NOT NULL COMMENT '商品录入时间',
  `sort_order` smallint(255) UNSIGNED NOT NULL COMMENT '排序字段',
  PRIMARY KEY (`good_id`) USING BTREE,
  UNIQUE INDEX `good_sn`(`good_sn`) USING BTREE COMMENT '商品货号唯一索引',
  INDEX `good_name`(`good_name`) USING BTREE COMMENT '商品名普通索引',
  INDEX `is_del`(`is_del`) USING BTREE COMMENT '是否删除索引'
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eb_goods
-- ----------------------------
INSERT INTO `eb_goods` VALUES (1, 'EBUY10011566727395', '小米全面屏电视E55A 55英寸L55M5-AZ 4K超高清HDR 内置小爱 蓝牙语音遥控2GB+8GBAI人工智能网络液晶平板电视', '', 13, 0.00, 0.00, 0.00, 2019, 2019, '', '', 1, 1, 1, 0, 1, 0, 50);
INSERT INTO `eb_goods` VALUES (2, 'EBUY10011566728573', '海信（Hisense）H55E3A 55英寸 超高清4K HDR 金属背板 人工智能液晶电视机 丰富影视教育资源', '', 13, 2000.00, 1588.00, 888.00, 2019, 2019, '', '', 1, 1, 1, 0, 1, 0, 50);
INSERT INTO `eb_goods` VALUES (3, 'EBUY5d626adb07148', '创维（SKYWORTH）65H5 65英寸4K超高清HDR 护眼全面屏 AI人工智能语音 蓝牙网络WIFI 液晶平板电视机', '', 13, 3500.55, 3000.56, 2500.00, 1566730964, 1567249367, '', '', 1, 1, 1, 0, 1, 1566730971, 50);
INSERT INTO `eb_goods` VALUES (4, 'EBUY5d626bff0f424', '创维（SKYWORTH）55A5 55英寸4K超高清HDR 超薄全面屏 全时AI 人工智能语音声控电视 液晶平板电视机 智慧屏', '', 13, 3200.56, 3000.55, 2888.66, 1566731251, 1567249655, '', '', 1, 1, 1, 0, 1, 1566731263, 20);
INSERT INTO `eb_goods` VALUES (5, 'EBUY5d62707fef22c', 'Apple iPhone XR (A2108) 128GB 白色 移动联通电信4G手机 双卡双待', '&lt;strong&gt;\r\n&lt;table id=&quot;__01&quot; width=&quot;750&quot; border=&quot;0&quot; align=&quot;center&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot; style=&quot;color:#666666;font-family:tahoma, arial, \'Microsoft YaHei\', \'Hiragino Sans GB\', u5b8bu4f53, sans-serif;font-size:12px;background-color:#FFFFFF;&quot; class=&quot;ke-zeroborder&quot;&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td&gt;\r\n				&lt;img width=&quot;750&quot; height=&quot;249&quot; alt=&quot;&quot; border=&quot;0&quot; class=&quot;&quot; src=&quot;https://img14.360buyimg.com/cms/jfs/t1/21110/13/5033/79400/5c380af6E167e6f64/c1a2c5294006dad9.jpg&quot; /&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td&gt;\r\n				&lt;img width=&quot;750&quot; height=&quot;405&quot; alt=&quot;&quot; border=&quot;0&quot; class=&quot;&quot; src=&quot;https://img11.360buyimg.com/cms/jfs/t1/32038/29/398/90933/5c3b2b28Ee52cc79f/bba9833293b49a26.jpg&quot; /&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td&gt;\r\n				&lt;img width=&quot;750&quot; alt=&quot;&quot; border=&quot;0&quot; class=&quot;&quot; src=&quot;https://img14.360buyimg.com/cms/jfs/t1/12225/39/12782/63625/5c99cb37E78df49e9/7df0385f30b417c0.jpg&quot; /&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;div style=&quot;margin:0px auto;padding:0px;color:#666666;font-family:tahoma, arial, \'Microsoft YaHei\', \'Hiragino Sans GB\', u5b8bu4f53, sans-serif;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;img class=&quot;&quot; src=&quot;https://img10.360buyimg.com/cms/jfs/t1/32255/33/4631/335252/5c7f77e1Ed03f9568/f205d9c99a2b4b01.jpg&quot; /&gt;&lt;img class=&quot;&quot; src=&quot;https://img14.360buyimg.com/cms/jfs/t1/10243/28/13159/434204/5c7f77e1E77b34286/7da561e321879d1e.jpg&quot; /&gt;&lt;img class=&quot;&quot; src=&quot;https://img12.360buyimg.com/cms/jfs/t1/25003/38/9414/543832/5c7f77e1E1c0f605a/ad5158287c23c4c6.jpg&quot; /&gt;&lt;img class=&quot;&quot; src=&quot;https://img14.360buyimg.com/cms/jfs/t1/18348/33/9569/388862/5c7f77e1E652dfb72/2da44463e27668dd.jpg&quot; /&gt;\r\n&lt;/div&gt;\r\n&lt;br /&gt;\r\n&lt;/strong&gt;', 29, 8000.00, 5000.00, 4500.00, 1566732281, 1567250684, '', '', 1, 1, 1, 0, 1, 1566732415, 10);
INSERT INTO `eb_goods` VALUES (17, 'EBUY5d6280fb74360', '', '&lt;strong&gt;商品描述&lt;/strong&gt;', 0, 0.00, 0.00, 0.00, 0, 0, 'Uploads/2019-08-25/5d6280fb76688.jpg', 'Uploads/2019-08-25/thumb_5d6280fb76688.jpg', 1, 1, 1, 0, 1, 1566736635, 50);
INSERT INTO `eb_goods` VALUES (16, 'EBUY5d627e7b5e1dc', '联想ThinkPad T480（0PCD）14英寸轻薄笔记本电脑（i7-8550U 8G 128GSSD+1T MX150 FHD 背光键盘 双电池）', '&lt;p&gt;\r\n	&lt;img src=&quot;https://img12.360buyimg.com/cms/jfs/t20548/257/279383319/284474/74d92a63/5b07e30eNec4a751e.jpg&quot; /&gt;&lt;img src=&quot;https://img14.360buyimg.com/cms/jfs/t20362/216/265811479/249181/d176b928/5b07e30eN43af74e0.jpg&quot; /&gt;&lt;img src=&quot;https://img11.360buyimg.com/cms/jfs/t21595/261/264243057/211360/6be764d2/5b07e623N60f347c4.jpg&quot; /&gt;\r\n&lt;/p&gt;', 30, 9500.00, 9000.00, 8500.00, 1566735494, 1567772297, 'Uploads/2019-08-25/5d627e7b6011c.jpg', '', 1, 1, 1, 0, 1, 1566735995, 50);

-- ----------------------------
-- Table structure for eb_role
-- ----------------------------
DROP TABLE IF EXISTS `eb_role`;
CREATE TABLE `eb_role`  (
  `role_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `action_list` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role_describe` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`role_id`) USING BTREE,
  INDEX `user_name`(`role_name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eb_role
-- ----------------------------
INSERT INTO `eb_role` VALUES (1, '超级管理员', '', '具有系统所有权限');
INSERT INTO `eb_role` VALUES (2, '商品管理部门', '', '具有商品管理的权限');

-- ----------------------------
-- Table structure for eb_user
-- ----------------------------
DROP TABLE IF EXISTS `eb_user`;
CREATE TABLE `eb_user`  (
  `user_id` smallint(5) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '邮箱',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `ec_salt` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '加密的盐值',
  `add_time` int(11) NOT NULL DEFAULT 0 COMMENT '用户录入时间',
  `last_login` int(11) NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  `last_ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `action_list` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户操作列表',
  `nav_list` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lang_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `agency_id` smallint(5) UNSIGNED NOT NULL,
  `suppliers_id` smallint(5) UNSIGNED NULL DEFAULT 0,
  `todolist` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `role_id` smallint(5) NULL DEFAULT NULL COMMENT '用户所属角色id',
  `passport_uid` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1' COMMENT '用户类型，1管理员，0会员',
  PRIMARY KEY (`user_id`) USING BTREE,
  INDEX `user_name`(`user_name`) USING BTREE,
  INDEX `agency_id`(`agency_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
