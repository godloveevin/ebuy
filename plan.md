#后台模块（Backstasge）
##首页模块index
##用户模块user
##角色模块role
##权限模块access
##分类模块category ok
##商品模块goods
###扩展分类功能的实现
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

