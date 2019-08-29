#后台模块（Backstasge）
##首页模块index
##用户模块user
##角色模块role
##权限模块access
##分类模块category ok
实现的思路
CREATE TABLE `eb_category` (
  `cat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '分类的父分类id',
  `cat_name` varchar(90) NOT NULL DEFAULT '' COMMENT '分类名称',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `cat_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '分类描述',
  `sort_order` tinyint(1) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `measure_unit` varchar(15) NOT NULL DEFAULT '',
  `show_in_nav` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否在导航栏中显示',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示，1是，0否，默认1',
  `is_rec` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否推荐，1是，0否，默认1',
  PRIMARY KEY (`cat_id`) USING BTREE,
  KEY `parent_id` (`parent_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='商品分类表';
##商品模块goods ok
CREATE TABLE `eb_goods` (
  `good_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `good_sn` varchar(255) NOT NULL COMMENT '商品货号',
  `good_name` varchar(255) NOT NULL DEFAULT '' COMMENT '商品名',
  `good_desc` text NOT NULL COMMENT '商品简短描述',
  `cat_id` smallint(5) NOT NULL COMMENT '商品分类id',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `sale_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '本店售价',
  `promote_price` decimal(10,2) NOT NULL COMMENT '促销价格',
  `promote_start_date` int(11) NOT NULL COMMENT '促销开始时间',
  `promote_end_date` int(11) NOT NULL COMMENT '促销结束时间',
  `good_img` varchar(255) NOT NULL DEFAULT '' COMMENT '商品主图',
  `good_thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '商品缩略图',
  `is_hot` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否热卖，1是，0否，默认1是',
  `is_new` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否新品，1是，0否，默认1是',
  `is_rec` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否推荐，1是，0否，默认1是',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除，1是，0否，默认0否',
  `is_sale` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否上架，1是，0否，默认1是',
  `addtime` int(11) NOT NULL COMMENT '商品录入时间',
  `sort_order` smallint(255) unsigned NOT NULL COMMENT '排序字段',
  PRIMARY KEY (`good_id`) USING BTREE,
  UNIQUE KEY `good_sn` (`good_sn`) USING BTREE COMMENT '商品货号唯一索引',
  KEY `good_name` (`good_name`) USING BTREE COMMENT '商品名普通索引',
  KEY `is_del` (`is_del`) USING BTREE COMMENT '是否删除索引'
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='商品信息详情表';
###扩展分类功能的实现 ok
实现的思路
一个商品可能属于多个分类下的，
比如，智能电视既可以是家电下的也可以是智能设备下的也可以是智能家居分类下的
表设计 扩展分类表 eb_goods_category
CREATE TABLE `eb_goods_category` (
  `e_cat_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品扩展分类ID标识',
  `good_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID标识',
  `cat_id` smallint(5) NOT NULL DEFAULT '0' COMMENT '分类ID标识',
  PRIMARY KEY (`e_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品扩展分类表';


登录模块login

前台模块（Home）

##下一个任务JS框架的设计

##商品的修改，与显示

###bug 商品添加和编辑页面的修改扩展分类删除问题，既可以增加扩展，也可以删除某个扩展分类

##商品回收站功能 ok




