<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/Public/Backstage/styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Backstage/styles/nav.css" rel="stylesheet" type="text/css" />
</head>
<body class="nav">
<div class="menu">
    <div id="logo-div">
        <a href="index.php"><img width="87" class="logo" src="/Public/Backstage/images/ecshop_logo@2x.png" alt="ECSHOP - power for e-commerce" /></a>
        <!--{if $http_host=='localhost' or !$single_url}-->
        <a href="javascript:" class="noauthorize"><img src="/Public/Backstage/images/noauthorize.png" class="icon" width="12"> 未授权用户</a>
        <!--{else}
        <a class="{if $authorization}authorize{else}noauthorize{/if}" href="<?php echo ($single_url); ?>" target="_blank"><img src="/Public/Backstage/images/{if $authorization}authorize{else}noauthorize{/if}.png" class="icon" width="12"> {if $authorization}<?php echo ($authorize_name); ?>{else}未授权用户{/if}</a>
        {/if}-->
    </div>
    <div id="license-div"></div>
    <div id="main-div">
        <div id="menu-list">
            <ul class="menu" id="menu-ul">

                <li key="02_cat_and_goods" class="icon-goods" data-url="goods.php?act=list" data-key="01_goods_list" name="menu" onclick="showsub(this)">
                    商品管理
                    <div class="submenu">
                        <div class="title">商品管理</div>
                        <ul>
                            <li id="sub-menu-01_goods_list" class="menu-item" onclick="showact(this, event)"><a href="goods.php?act=list" target="main-frame">商品列表</a></li>
                            <li id="sub-menu-02_goods_add" class="menu-item" onclick="showact(this, event)"><a href="goods.php?act=add" target="main-frame">添加新商品</a></li>
                            <li id="sub-menu-03_category_list" class="menu-item" onclick="showact(this, event)"><a href="category.php?act=list" target="main-frame">商品分类</a></li>
                            <li id="sub-menu-05_comment_manage" class="menu-item" onclick="showact(this, event)"><a href="comment_manage.php?act=list" target="main-frame">用户评论</a></li>
                            <li id="sub-menu-06_goods_brand_list" class="menu-item" onclick="showact(this, event)"><a href="brand.php?act=list" target="main-frame">商品品牌</a></li>
                            <li id="sub-menu-08_goods_type" class="menu-item" onclick="showact(this, event)"><a href="goods_type.php?act=manage" target="main-frame">商品类型</a></li>
                            <li id="sub-menu-11_goods_trash" class="menu-item" onclick="showact(this, event)"><a href="goods.php?act=trash" target="main-frame">商品回收站</a></li>
                            <li id="sub-menu-12_batch_pic" class="menu-item" onclick="showact(this, event)"><a href="picture_batch.php" target="main-frame">图片批量处理</a></li>
                            <li id="sub-menu-13_batch_add" class="menu-item" onclick="showact(this, event)"><a href="goods_batch.php?act=add" target="main-frame">商品批量上传</a></li>
                            <li id="sub-menu-14_goods_export" class="menu-item" onclick="showact(this, event)"><a href="goods_export.php?act=goods_export" target="main-frame">商品批量导出</a></li>
                            <li id="sub-menu-15_batch_edit" class="menu-item" onclick="showact(this, event)"><a href="goods_batch.php?act=select" target="main-frame">商品批量修改</a></li>
                            <li id="sub-menu-16_goods_script" class="menu-item" onclick="showact(this, event)"><a href="gen_goods_script.php?act=setup" target="main-frame">生成商品代码</a></li>
                            <li id="sub-menu-17_tag_manage" class="menu-item" onclick="showact(this, event)"><a href="tag_manage.php?act=list" target="main-frame">标签管理</a></li>
                            <li id="sub-menu-50_virtual_card_list" class="menu-item" onclick="showact(this, event)"><a href="goods.php?act=list&extension_code=virtual_card" target="main-frame">虚拟商品列表</a></li>
                            <li id="sub-menu-51_virtual_card_add" class="menu-item" onclick="showact(this, event)"><a href="goods.php?act=add&extension_code=virtual_card" target="main-frame">添加虚拟商品</a></li>
                            <li id="sub-menu-52_virtual_card_change" class="menu-item" onclick="showact(this, event)"><a href="virtual_card.php?act=change" target="main-frame">更改加密串</a></li>
                            <li id="sub-menu-goods_auto" class="menu-item" onclick="showact(this, event)"><a href="goods_auto.php?act=list" target="main-frame">商品自动上下架</a></li>
                        </ul>
                    </div>
                </li>

                <li key="08_members" class="icon-members" data-url="users.php?act=list" data-key="03_users_list" name="menu" onclick="showsub(this)">
                    会员管理
                    <div class="submenu">
                        <div class="title">会员管理</div>
                        <ul>
                            <li id="sub-menu-03_users_list" class="menu-item" onclick="showact(this, event)"><a href="users.php?act=list" target="main-frame">会员列表</a></li>
                            <li id="sub-menu-04_users_add" class="menu-item" onclick="showact(this, event)"><a href="users.php?act=add" target="main-frame">添加会员</a></li>
                            <li id="sub-menu-05_user_rank_list" class="menu-item" onclick="showact(this, event)"><a href="user_rank.php?act=list" target="main-frame">会员等级</a></li>
                            <li id="sub-menu-06_list_integrate" class="menu-item" onclick="showact(this, event)"><a href="integrate.php?act=list" target="main-frame">会员整合</a></li>
                            <li id="sub-menu-08_unreply_msg" class="menu-item" onclick="showact(this, event)"><a href="user_msg.php?act=list_all" target="main-frame">会员留言</a></li>
                            <li id="sub-menu-09_user_account" class="menu-item" onclick="showact(this, event)"><a href="user_account.php?act=list" target="main-frame">充值和提现申请</a></li>
                            <li id="sub-menu-10_user_account_manage" class="menu-item" onclick="showact(this, event)"><a href="user_account_manage.php?act=list" target="main-frame">资金管理</a></li>
                        </ul>
                    </div>
                </li>

                <li key="10_priv_admin" class="icon-priv" data-url="privilege.php?act=list" data-key="admin_list" name="menu" onclick="showsub(this)">
                    权限管理
                    <div class="submenu">
                        <div class="title">权限管理</div>
                        <ul>
                            <li id="sub-menu-admin_list" class="menu-item" onclick="showact(this, event)"><a href="privilege.php?act=list" target="main-frame">管理员列表</a></li>
                            <li id="sub-menu-admin_logs" class="menu-item" onclick="showact(this, event)"><a href="admin_logs.php?act=list" target="main-frame">管理员日志</a></li>
                            <li id="sub-menu-admin_role" class="menu-item" onclick="showact(this, event)"><a href="role.php?act=list" target="main-frame">角色管理</a></li>
                            <li id="sub-menu-agency_list" class="menu-item" onclick="showact(this, event)"><a href="agency.php?act=list" target="main-frame">办事处列表</a></li>
                            <li id="sub-menu-suppliers_list" class="menu-item" onclick="showact(this, event)"><a href="suppliers.php?act=list" target="main-frame">供货商列表</a></li>
                        </ul>
                    </div>
                </li>

                <!--{foreach from=$menus item=menu key=k}
                {if $menu.action}
                <li><a href="<?php echo ($menu["action"]); ?>" target="main-frame"><?php echo ($menu["label"]); ?></a></li>
                {else}
                <li key="<?php echo ($k); ?>" class="icon-<?php echo ($menu["icon"]); ?>" data-url="<?php echo ($menu["url"]); ?>" data-key="<?php echo ($menu["key"]); ?>" name="menu" onclick="showsub(this)">
                    <?php echo ($menu["label"]); ?>
                    {if $menu.children}
                    <div class="submenu">
                        <div class="title"><?php echo ($menu["label"]); ?></div>
                        <ul>
                            {foreach from=$menu.children key=key item=child}
                            <li id="sub-menu-<?php echo ($key); ?>" class="menu-item" onclick="showact(this, event)"><a href="<?php echo ($child["action"]); ?>" target="main-frame"><?php echo ($child["label"]); ?></a></li>
                            {/foreach}
                        </ul>
                    </div>
                    {/if}
                </li>
                {/if}
                {/foreach}-->
            </ul>
        </div>
    </div>
    <div id="foot-div" onmouseover="showBar(this)" onmouseout="hideBar(this)">
        <a href="#" target="main-frame">admin</a>
        <div class="panel-hint">
            <ul>
                <li>
                    <a href="clear_cache" target="main-frame" class="fix-submenu">清除缓存{</a>
                </li>
                <li class="btn-exit">
                    <a href="logout" target="_top" class="fix-submenu">退出</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript" src="/Public/Backstage/js/global.js"></script>
<script type="text/javascript" src="/Public/Backstage/js/utils.js"></script>
<script type="text/javascript" src="/Public/Backstage/js/transport.js"></script>
<script type="text/javascript" src="/Public/Backstage/js/menu.js"></script>

<script language="JavaScript">
   /* window.setInterval(crontab,30000);
    function crontab(){
        Ajax.call('cloud.php?is_ajax=1&act=load_crontab','','', 'GET', 'JSON');
    }*/
    function showBar(item){
        var silb = item.lastElementChild;
        silb.style.display = "block";
    }
    function hideBar(item){
        var silb = item.lastElementChild;
        silb.style.display = "none";
    }
    function showsub(el) {
        var act = el.parentNode.getElementsByClassName('active');
        var url = el.getAttribute('data-url') || '';
        var key = el.getAttribute('data-key') || '';

        if (act.length) {
            Array.prototype.slice.call(act).forEach(function(el) {
                el.className = el.className.replace(/\sactive\b/i, '');
            });
        }
        el.className = el.className + ' active';
        top.document.getElementById('frame-body').cols = '240,*';
        if (url) {
            top.document.getElementById('main-frame').src=url;
            document.getElementById('sub-menu-'+key).className = 'menu-item active';
        }
    }
    function showact(el, e) {
        e.stopPropagation();
        var act = el.parentNode.getElementsByClassName('active');
        if (act.length) {
            Array.prototype.slice.call(act).forEach(function(el) {
                el.className = el.className.replace(/\sactive\b/i, '');
            });
        }
        el.className = el.className + ' active';
    }

    /**
     * 创建XML对象
     */
    function createDocument()
    {
        var xmlDoc;

        // create a DOM object
        if (window.ActiveXObject)
        {
            try
            {
                xmlDoc = new ActiveXObject("Msxml2.DOMDocument.6.0");
            }
            catch (e)
            {
                try
                {
                    xmlDoc = new ActiveXObject("Msxml2.DOMDocument.5.0");
                }
                catch (e)
                {
                    try
                    {
                        xmlDoc = new ActiveXObject("Msxml2.DOMDocument.4.0");
                    }
                    catch (e)
                    {
                        try
                        {
                            xmlDoc = new ActiveXObject("Msxml2.DOMDocument.3.0");
                        }
                        catch (e)
                        {
                            alert(e.message);
                        }
                    }
                }
            }
        }
        else
        {
            if (document.implementation && document.implementation.createDocument)
            {
                xmlDoc = document.implementation.createDocument("","doc",null);
            }
            else
            {
                alert("Create XML object is failed.");
            }
        }
        xmlDoc.async = false;

        return xmlDoc;
    }

</script>

</body>
</html>