<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>ebuy后台管理中心</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script>
        if (window.top != window)
        {
            window.top.location.href = document.location.href;
        }
    </script>
    <frameset cols="120, *" framespacing="0" border="0" id="frame-body">
        <frame src="<?php echo U('menu');?>" id="menu-frame" name="menu-frame" frameborder="no" scrolling="yes">
        <frameset rows="100,*" framespacing="0" border="0">
            <frame src="<?php echo U('top');?>" id="header-frame" name="header-frame" frameborder="no" scrolling="no">
            <frame src="<?php echo U('main');?>" id="main-frame" name="main-frame" frameborder="no" scrolling="yes">
        </frameset>
    </frameset>
</head>
<body>
</body>
</html>