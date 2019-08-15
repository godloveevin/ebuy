<?php
return array(
	//'配置项'=>'配置值'

    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',                                             // 数据库类型
    'DB_HOST'               =>  '127.0.0.1',                                         // 服务器地址
    'DB_NAME'               =>  'ebuy',                                              // 数据库名
    'DB_USER'               =>  'root',                                              // 用户名
    'DB_PWD'                =>  'root',                                              // 密码
    'DB_PORT'               =>  '3306',                                              // 端口
    'DB_PREFIX'             =>  'eb_',                                               // 数据库表前缀

    'URL_MODEL'             =>  2,                                                   // 设置url访问模式为重写模式
    'DEFAULT_MODULE'        =>  'Home',                                              // 设置默认的访问模块为Home
    'MODULE_ALLOW_LIST'     =>  array('Api','Home','Backstage'),                    // 设置允许访问的模块

    'TMPL_PARSE_STRING'     =>  array(
        '__PUBLIC_BACKSTAGE__'  =>  '/Public/Backstage',                            // 后台资源文件
        '__PUBLIC_HOME__'       =>  '/Public/Home',                                 // 前台资源文件
        '__PUBLIC_API__'        =>  '/Public/Api',                                  // API资源文件
    ),                                                                              // 配置字符串替换
);