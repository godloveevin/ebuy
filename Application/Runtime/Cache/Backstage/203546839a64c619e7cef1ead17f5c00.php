<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>ECSHOP 管理中心</title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/Public/Backstage/styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Backstage/styles/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/Backstage/js/transport.js"></script>
    <script type="text/javascript" src="/Public/Backstage/js/common.js"></script>
    <style>
        .panel-icloud .panel-right iframe {
            height: 300px;
            margin-top: 15px;
        }
        .panel-hint{
            top: 0%;
        }
    </style>

    <script>
        <!--
        // 这里把JS用到的所有语言都赋值到这里
        var process_request = "正在处理您的请求...";
        var todolist_caption = "记事本";
        var todolist_autosave = "自动保存";
        var todolist_save = "保存";
        var todolist_clear = "清除";
        var todolist_confirm_save = "是否将更改保存到记事本？";
        var todolist_confirm_clear = "是否清空内容？";
        var expand_all = "展开";
        var collapse_all = "闭合";
        var shop_name_not_null = "商店名称不能为空";
        var good_name_not_null = "商品名称不能为空";
        var good_category_not_null = "商品分类不能为空";
        var good_number_not_number = "商品数量不是数值";
        var good_price_not_number = "商品价格不是数值";
        //-->
        /*关闭按钮*/
        function get_certificate(){
            var panel = document.getElementById('panelCloud');
            var mask  = document.getElementById('CMask')||null;
            var frame = document.getElementById('CFrame');
            if(panel&&CMask&&frame){
                panel.style.display = 'block';
                mask.style.display = 'block';
                frame.src = ''
            }
        }

        /*关闭按钮*/
        function btnCancel(item){
            var par  = item.offsetParent;
            var mask  = document.getElementById('CMask')||null;
            var frame = document.getElementById('CFrame');
            par.style.display = 'none';
            if(mask){mask.style.display = 'none';}
            frame.src = '';
        }
    </script>
</head>
<body>
<!--云起激活系统面板-->
<div class="panel-hint panel-icloud" id="panelCloud">
    <div class="panel-cross"><span onclick="btnCancel(this)">Ｘ</span></div>
    <div class="panel-title">
        <span class="tit">您需要激活系统</span>
        <p>用云起账号激活您的系统，享受物流查询，天工收银，手机短信等更多应用和服务</p>
    </div>
    <div class="panel-left">
        <span>没有云起账号吗？</span>
        <p>点击下列按钮一步完成注册激活！</p>
        <a href="https://account.shopex.cn/reg?refer=yunqi_ecshop" target="_blank" class="btn btn-yellow">免费注册云起账号</a>
    </div>
    <div class="panel-right">
        <h5 class="logo">云起</h5>
        <p>正在激活中</p>
        <iframe src="" frameborder="0" id="CFrame"></iframe>
        <div class="cloud-passw">
            <a target="_blank" href="https://account.shopex.cn/forget?">忘记密码？</a>
        </div>
    </div>
</div>
<!--云起激活系统面板-->
<!--遮罩-->
<div class="mask-black" id="CMask"></div>
<!--遮罩-->
<h1>
    <span class="action-span1"><a href="main">ECSHOP 管理中心</a> </span>
    <span id="search_id" class="action-span1"></span>
    <div style="clear:both"></div>
</h1>


<!-- start order statistics -->
<div class="panel">
    <h2 class="group-title">订单统计信息</h2>
    <table cellspacing='1' cellpadding='3'>
        <tr>
            <th width="12%"><a href="order.php?act=list&composite_status=101">待发货订单:</a></th>
            <td width="21%"><strong style="color: red">0</strong></td>
            <th width="12%"><a href="order.php?act=list&composite_status=0">未确认订单:</a></th>
            <td width="21%"><strong>0</strong></td>
            <th width="12%"><a href="order.php?act=list&composite_status=100">待支付订单:</a></th>
            <td width="21%"><strong>0</strong></td>
        </tr>
        <tr>
            <th><a href="order.php?act=list&composite_status=102">已成交订单数:</a></td>
            <td><strong>0</strong></th>
            <th><a href="goods_booking.php?act=list_all">新缺货登记:</a></td>
            <td><strong>1</strong></th>
            <th><a href="user_account.php?act=list&process_type=1&is_paid=0">退款申请:</a></th>
            <td><strong>0</strong></td>
        </tr>
        <tr>
            <th><a href="order.php?act=list&composite_status=6">部分发货订单:</a></th>
            <td><strong>0</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </table>
</div>
<!-- end order statistics -->
<div class="clearfix" style="min-width: 1090px">
    <div class="panel analysis">
        <!-- start goods statistics -->
        <table class="zebra-table">
            <caption class="group-title">实体商品统计信息</caption>
            <tbody>
            <tr>
                <th>商品总数:</th>
                <td>37</td>
            </tr>
            <tr>
                <th><a href="goods.php?act=list&stock_warning=1">库存警告商品数:</a></th>
                <td><strong style="color: red">32</strong></td>
            </tr>
            <tr>
                <th><a href="goods.php?act=list&amp;intro_type=is_new">新品推荐数:</a></th>
                <td>12</td>
            </tr>
            <tr>
                <th><a href="goods.php?act=list&amp;intro_type=is_best">精品推荐数:</a></th>
                <td>9</td>
            </tr>
            <tr>
                <th><a href="goods.php?act=list&amp;intro_type=is_hot">热销商品数:</a></th>
                <td>9</td>
            </tr>
            <tr>
                <th><a href="goods.php?act=list&amp;intro_type=is_promote">促销商品数:</a></th>
                <td>0</td>
            </tr>
            </tbody>
        </table>
        <!-- Virtual Card -->
        <table class="zebra-table">
            <caption class="group-title">虚拟卡商品统计</caption>
            <tbody>
            <tr>
                <th>商品总数:</th>
                <td>0</td>
            </tr>
            <tr>
                <th><a href="goods.php?act=list&amp;stock_warning=1&amp;extension_code=virtual_card">库存警告商品数:</a></th>
                <td><strong style="color: red">0</strong></td>
            </tr>
            <tr>
                <th><a href="goods.php?act=list&amp;intro_type=is_new&amp;extension_code=virtual_card">新品推荐数:</a></th>
                <td>0</td>
            </tr>
            <tr>
                <th><a href="goods.php?act=list&amp;intro_type=is_best&amp;extension_code=virtual_card">精品推荐数:</a></th>
                <td>0</td>
            </tr>
            <tr>
                <th><a href="goods.php?act=list&amp;intro_type=is_hot&amp;extension_code=virtual_card">热销商品数:</a></th>
                <td>0</td>
            </tr>
            <tr>
                <th><a href="goods.php?act=list&amp;intro_type=is_promote&amp;extension_code=virtual_card">促销商品数:</a></th>
                <td>0</td>
            </tr>
            </tbody>
        </table>
        <!-- end -->
    </div>
    <!-- start access statistics -->
    <ul class="access-list" style="margin: 10px 0 0">
        <li>
            <div class="item">
                <img src="/Public/Backstage/images/index/users.png" alt="">
                <p>今日访问:</p>
                <b>1</b>
            </div>
        </li>
        <li>
            <div class="item">
                <img src="/Public/Backstage/images/index/onlines.png" alt="">
                <p>在线人数:</p>
                <b>1</b>
            </div>
        </li>
        <li>
            <div class="item">
                <img src="/Public/Backstage/images/index/message.png" alt="">
                <p><a href="user_msg.php?act=list_all">最新留言:</a></p>
                <b>0</b>
            </div>
        </li>
        <li>
            <div class="item">
                <img src="/Public/Backstage/images/index/comments.png" alt="">
                <p><a href="comment_manage.php?act=list">未审核评论:</a></p>
                <b>3</b>
            </div>
        </li>
    </ul>
</div>
<!-- end access statistics -->
<!-- start system information -->
<div class="panel">
    <table cellspacing='1' cellpadding='3'>
        <caption class="group-title">系统信息</caption>
        <tr>
            <th width="12%">服务器操作系统:</th>
            <td width="21%">WINNT (127.0.0.1)</td>
            <th width="12%">Web 服务器:</th>
            <td width="21%">Apache/2.4.23 (Win32) PHP/5.6.25</td>
            <th width="12%">PHP 版本:</th>
            <td width="21%">5.6.25</td>
        </tr>
        <tr>
            <th>MySQL 版本:</th>
            <td>5.7.14</td>
            <th>安全模式:</th>
            <td>否</td>
            <th>安全模式GID:</th>
            <td>否</td>
        </tr>
        <tr>
            <th>Socket 支持:</th>
            <td>是</td>
            <th>时区设置:</th>
            <td>PRC</td>
            <th>GD 版本:</th>
            <td>GD2 ( JPEG GIF PNG)</td>
        </tr>
        <tr>
            <th>Zlib 支持:</th>
            <td>是</td>
            <th>IP 库版本:</th>
            <td>广东省广州市</td>
            <th>文件上传的最大大小:</th>
            <td>2M</td>
        </tr>
        <tr>
            <th>ECShop 版本:</th>
            <td>v4.0.6 RELEASE 20190731</td>
            <th>安装日期:</th>
            <td>2019-08-07</td>
            <th>编码:</th>
            <td>UTF-8</td>
        </tr>
    </table>
</div>


<script type="text/javascript" src="../js/utils.js"></script><script type="Text/Javascript" language="JavaScript">
    onload = function()
    {
        /* 检查订单 */
        startCheckOrder();
    };

    function api_styel()
    {
        if(document.getElementById("Marquee") != null)
        {
            var Mar = document.getElementById("Marquee");
            if (Browser.isIE)
            {
                Mar.style.height = "52px";
            }
            else
            {
                Mar.style.height = "36px";
            }

            var child_div=Mar.getElementsByTagName("div");

            var picH = 16;//移动高度
            var scrollstep=2;//移动步幅,越大越快
            var scrolltime=30;//移动频度(毫秒)越大越慢
            var stoptime=4000;//间断时间(毫秒)
            var tmpH = 0;

            function start()
            {
                if(tmpH < picH)
                {
                    tmpH += scrollstep;
                    if(tmpH > picH )tmpH = picH ;
                    Mar.scrollTop = tmpH;
                    setTimeout(start,scrolltime);
                }
                else
                {
                    tmpH = 0;
                    Mar.appendChild(child_div[0]);
                    Mar.scrollTop = 0;
                    setTimeout(start,stoptime);
                }
            }
            setTimeout(start,stoptime);
        }
    }
</script>

<div id="footer">
    共执行 31 个查询，用时 0.160000 秒，Gzip 已禁用，内存占用 2.288 MB<br />
    版权所有 &copy; 2005-2019 上海商派软件有限公司，并保留所有权利。</div>
<!-- 新订单提示信息 -->
<div id="popMsg">
    <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#cfdef4" border="0">
        <tr>
            <td style="color: #0f2c8c" width="30" height="24"></td>
            <td style="font-weight: normal; color: #1f336b; padding-top: 4px;padding-left: 4px" valign="center" width="100%"> 新订单通知</td>
            <td style="padding-top: 2px;padding-right:2px" valign="center" align="right" width="19"><span title="关闭" style="cursor: hand;cursor:pointer;color:red;font-size:12px;font-weight:bold;margin-right:4px;" onclick="Message.close()" >×</span><!-- <img title=关闭 style="cursor: hand" onclick=closediv() hspace=3 src="msgclose.jpg"> --></td>
        </tr>
        <tr>
            <td style="padding-right: 1px; padding-bottom: 1px" colspan="3" height="70">
                <div id="popMsgContent">
                    <p>您有 <strong style="color:#ff0000" id="spanNewOrder">1</strong> 个新订单以及       <strong style="color:#ff0000" id="spanNewPaid">0</strong> 个新付款的订单</p>
                    <p align="center" style="word-break:break-all"><a href="order.php?act=list"><span style="color:#ff0000">点击查看新订单</span></a></p>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>