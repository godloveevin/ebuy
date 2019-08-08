<?php
return array(
	//'配置项'=>'配置值'

    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'ebuy',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'eb_',    // 数据库表前缀

    'DEFAULT_MODULE'=>'Home',// 设置默认的访问模块为Home
    'MODULE_ALLOW_LIST'=>array('Api','Home','Backstage'),// 设置允许访问的模块
);