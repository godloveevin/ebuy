<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/Public/Backstage/styles/general.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/Public/Backstage/styles/main.css" rel="stylesheet" type="text/css">

    <style type="text/css">
        body{
            padding: 0;
        }
    </style>
    <script type="text/javascript" src="/Public/Backstage/js/transport.js"></script>
</head>
<body>
<div id="header-div">
    <div id="submenu-div">
        <ul>
            <li><a href="aboutUs" target="main-frame">关于 ECSHOP</a></li>
            <li><a href="help" target="main-frame">帮助</a></li>
            <li><a href="<?php echo U('Home/Index/index');?>" target="_blank">站点首页</a></li>
            <li><a href="<?php echo U('index');?>">刷新</a></li>
            <li><a href="msgList" target="main-frame">管理员留言</a></li>
            <li style="border-left:none;"><a href="openShopGuide" target="main-frame">开店向导</a></li>
        </ul>
        <div id="send_info" style="padding: 5px 10px 0 0; clear:right;text-align: right; color: #FF9900;width:40%;float: right;">
        </div>
        <div id="load-div" style="padding: 5px 10px 0 0; color: #FF9900; display: none;width:40%;position: absolute;">
            <img src="/Public/Backstage/images/top_loader.gif" width="16" height="16" alt="正在处理您的请求..." style="vertical-align: middle" /> 正在处理您的请求...
        </div>
    </div>
</div>
<div id="menu-div">
    <ul>
        <!-- <li class="fix-spacel">&nbsp;</li> -->
        <li><a href="main" target="main-frame">起始页</a></li>
        <li><a href="setting" target="main-frame">设置导航栏</a></li>
        <li><a href="<?php echo U('goods/index');?>" target="main-frame">商品列表</a></li>
        <li><a href="<?php echo U('order/index');?>" target="main-frame">订单列表</a></li>
        <li><a href="<?php echo U('comment/index');?>" target="main-frame">用户评论</a></li>
        <li><a href="<?php echo U('user/index');?>" target="main-frame">会员列表</a></li>
        <li><a href="<?php echo U('shop/setting');?>" target="main-frame">店铺设置</a></li>
        <li><a href="<?php echo U('shop/qrcode');?>" target="main-frame">店铺二维码</a></li>
        <li><a href="<?php echo U('serverMarket');?>" target="main-frame">服务市场</a></li>
        <!--授权按钮1-->
        <li class="btn-bind">
            <img src="/Public/Backstage/images/authorizegk.png">
            <span href="javascript:void(0);" onclick="yunqiLogin();">授权用户专享</span>
        </li>
        <!--授权按钮-->
    </ul>
    <br class="clear" />
</div>

</body>
</html>