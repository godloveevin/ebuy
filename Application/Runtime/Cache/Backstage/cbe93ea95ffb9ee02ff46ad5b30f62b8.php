<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>ECSHOP 管理中心 - 权限列表 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/Public/Backstage/styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Backstage/styles/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/Backstage/js/transport.js"></script>
    <script type="text/javascript" src="/Public/Backstage/js/common.js"></script>
</head>
<body>

<h1>
    <a class="btn btn-right" href="<?php echo U('Access/add');?>">添加权限</a>
    <span class="action-span1"><a href="<?php echo U('Index/index');?>">后台管理中心</a> </span>
    <span id="search_id" class="action-span1">  > 权限列表 </span>
    <div style="clear:both"></div>
</h1>

<div class="list-div">
    <table cellspacing='1' id="list-table">
        <?php if(is_array($accessInfos)): foreach($accessInfos as $key=>$vo): ?><tr>
                <td width="18%" valign="top" class="first-cell"><?php echo ($vo["access_name"]); ?></td>
            <td>
                <?php if(is_array($vo["subAccess"])): foreach($vo["subAccess"] as $key=>$v): ?><div style="width:200px;float:left;"><label>><?php echo ($v["access_name"]); ?></label></div><?php endforeach; endif; ?>
            </td>
            </tr><?php endforeach; endif; ?>
    </table>
</div>




<div id="footer">
    共执行 5 个查询，用时 0.024000 秒，Gzip 已禁用，内存占用 1.623 MB<br />
    版权所有 &copy; 2005-2019 上海商派软件有限公司，并保留所有权利。</div>

</body>
</html>