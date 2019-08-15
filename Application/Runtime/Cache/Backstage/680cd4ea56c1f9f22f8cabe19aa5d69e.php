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
        var user_name_empty = "管理员用户名不能为空!";
        var password_invaild = "密码必须同时包含字母及数字且长度不能小于6!";
        var email_empty = "Email地址不能为空!";
        var email_error = "Email地址格式不正确!";
        var password_error = "两次输入的密码不一致!";
        var captcha_empty = "您没有输入验证码!";
        //-->
        /*关闭按钮*/
        function get_certificate(){
            var panel = document.getElementById('panelCloud');
            var mask  = document.getElementById('CMask')||null;
            var frame = document.getElementById('CFrame');
            if(panel&&CMask&&frame){
                panel.style.display = 'block';
                mask.style.display = 'block';
                frame.src = 'https://openapi.shopex.cn/oauth/authorize?response_type=code&client_id=yogfss4l&redirect_uri=http%3A%2F%2Fwww.ecshop4.com%2Fadmin%2Fcertificate.php%3Fact%3Dget_certificate%26type%3Dindex&view=auth_ecshop';
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

<!--遮罩-->
<div class="mask-black" id="CMask"></div>
<!--遮罩-->
<h1>
    <a class="btn btn-right" href="<?php echo U('Acess/add');?>">添加权限</a>
    <span class="action-span1"><a href="<?php echo U('Index/index');?>">ECSHOP 管理中心</a> </span>
    <span id="search_id" class="action-span1">&nbsp;&nbsp;>&nbsp;&nbsp;权限列表 </span>
    <div style="clear:both"></div>
</h1>

<div class="list-div">
    <table cellspacing='1' id="list-table">
        <tr>
            <td width="18%" valign="top" class="first-cell">
                <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('goods_manage,remove_back,cat_manage,cat_drop,attr_manage,brand_manage,comment_priv,tag_manage,goods_type,goods_auto,virualcard,picture_batch,goods_export,goods_batch,gen_goods_script',this);" class="checkbox">商品管理  </td>
            <td>
                <div style="width:200px;float:left;">
                    <label for="goods_manage"><input type="checkbox" name="action_code[]" value="goods_manage" id="goods_manage" class="checkbox"  onclick="checkrelevance('', 'goods_manage')" title=""/>
                        商品添加/编辑</label>
                </div>
                <div style="width:200px;float:left;">
                    <label for="remove_back"><input type="checkbox" name="action_code[]" value="remove_back" id="remove_back" class="checkbox"  onclick="checkrelevance('', 'remove_back')" title=""/>
                        商品删除/恢复</label>
                </div>
                <div style="width:200px;float:left;">
                    <label for="cat_manage"><input type="checkbox" name="action_code[]" value="cat_manage" id="cat_manage" class="checkbox"  onclick="checkrelevance('', 'cat_manage')" title=""/>
                        分类添加/编辑</label>
                </div>
                <div style="width:200px;float:left;">
                    <label for="cat_drop"><input type="checkbox" name="action_code[]" value="cat_drop" id="cat_drop" class="checkbox"  onclick="checkrelevance('cat_manage', 'cat_drop')" title="cat_manage"/>
                        分类转移/删除</label>
                </div>
                <div style="width:200px;float:left;">
                    <label for="attr_manage"><input type="checkbox" name="action_code[]" value="attr_manage" id="attr_manage" class="checkbox"  onclick="checkrelevance('', 'attr_manage')" title=""/>
                        商品属性管理</label>
                </div>
                <div style="width:200px;float:left;">
                    <label for="brand_manage"><input type="checkbox" name="action_code[]" value="brand_manage" id="brand_manage" class="checkbox"  onclick="checkrelevance('', 'brand_manage')" title=""/>
                        商品品牌管理</label>
                </div>
                <div style="width:200px;float:left;">
                    <label for="comment_priv"><input type="checkbox" name="action_code[]" value="comment_priv" id="comment_priv" class="checkbox"  onclick="checkrelevance('', 'comment_priv')" title=""/>
                        用户评论管理</label>
                </div>
                <div style="width:200px;float:left;">
                    <label for="tag_manage"><input type="checkbox" name="action_code[]" value="tag_manage" id="tag_manage" class="checkbox"  onclick="checkrelevance('', 'tag_manage')" title=""/>
                        标签管理</label>
                </div>
                <div style="width:200px;float:left;">
                    <label for="goods_type"><input type="checkbox" name="action_code[]" value="goods_type" id="goods_type" class="checkbox"  onclick="checkrelevance('', 'goods_type')" title=""/>
                        商品类型</label>
                </div>
                <div style="width:200px;float:left;">
                    <label for="goods_auto"><input type="checkbox" name="action_code[]" value="goods_auto" id="goods_auto" class="checkbox"  onclick="checkrelevance('', 'goods_auto')" title=""/>
                        商品自动上下架</label>
                </div>
                <div style="width:200px;float:left;">
                    <label for="virualcard"><input type="checkbox" name="action_code[]" value="virualcard" id="virualcard" class="checkbox"  onclick="checkrelevance('', 'virualcard')" title=""/>
                        虚拟卡管理</label>
                </div>
                <div style="width:200px;float:left;">
                    <label for="picture_batch"><input type="checkbox" name="action_code[]" value="picture_batch" id="picture_batch" class="checkbox"  onclick="checkrelevance('', 'picture_batch')" title=""/>
                        图片批量处理</label>
                </div>
                <div style="width:200px;float:left;">
                    <label for="goods_export"><input type="checkbox" name="action_code[]" value="goods_export" id="goods_export" class="checkbox"  onclick="checkrelevance('', 'goods_export')" title=""/>
                        商品批量导出</label>
                </div>
                <div style="width:200px;float:left;">
                    <label for="goods_batch"><input type="checkbox" name="action_code[]" value="goods_batch" id="goods_batch" class="checkbox"  onclick="checkrelevance('', 'goods_batch')" title=""/>
                        商品批量上传/修改</label>
                </div>
                <div style="width:200px;float:left;">
                    <label for="gen_goods_script"><input type="checkbox" name="action_code[]" value="gen_goods_script" id="gen_goods_script" class="checkbox"  onclick="checkrelevance('', 'gen_goods_script')" title=""/>
                        生成商品代码</label>
                </div>
            </td></tr>
    </table>
</div>





<div id="footer">
    共执行 5 个查询，用时 0.024000 秒，Gzip 已禁用，内存占用 1.623 MB<br />
    版权所有 &copy; 2005-2019 上海商派软件有限公司，并保留所有权利。</div>
<script type="text/javascript" src="../js/utils.js"></script><!-- 新订单提示信息 -->
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

<!--
<embed src="images/online.wav" width="0" height="0" autostart="false" name="msgBeep" id="msgBeep" enablejavascript="true"/>
-->
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://active.macromedia.com/flash2/cabs/swflash.cab#version=4,0,0,0" id="msgBeep" width="1" height="1">
    <param name="movie" value="images/online.swf">
    <param name="quality" value="high">
    <embed src="images/online.swf" name="msgBeep" id="msgBeep" quality="high" width="0" height="0" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?p1_prod_version=shockwaveflash">
    </embed>
</object>

<script language="JavaScript">
    document.onmousemove=function(e)
        {
            var obj = Utils.srcElement(e);
            if (typeof(obj.onclick) == 'function' && obj.onclick.toString().indexOf('listTable.edit') != -1)
            {
                obj.title = '点击修改内容';
                obj.style.cssText = 'background-color: #eee;';
                obj.onmouseout = function(e)
                {
                    this.style.cssText = '';
                }
            }
            else if (typeof(obj.href) != 'undefined' && obj.href.indexOf('listTable.sort') != -1)
            {
                obj.title = '点击对列表排序';
            }
        }
        <!--;


    var MyTodolist;
    function showTodoList(adminid)
    {
        if(!MyTodolist)
        {
            var global = $import("../js/global.js","js");
            global.onload = global.onreadystatechange= function()
            {
                if(this.readyState && this.readyState=="loading")return;
                var md5 = $import("js/md5.js","js");
                md5.onload = md5.onreadystatechange= function()
                {
                    if(this.readyState && this.readyState=="loading")return;
                    var todolist = $import("js/todolist.js","js");
                    todolist.onload = todolist.onreadystatechange = function()
                    {
                        if(this.readyState && this.readyState=="loading")return;
                        MyTodolist = new Todolist();
                        MyTodolist.show();
                    }
                }
            }
        }
        else
        {
            if(MyTodolist.visibility)
            {
                MyTodolist.hide();
            }
            else
            {
                MyTodolist.show();
            }
        }
    }

    if (Browser.isIE)
    {
        onscroll = function()
        {
            //document.getElementById('calculator').style.top = document.body.scrollTop;
            document.getElementById('popMsg').style.top = (document.body.scrollTop + document.body.clientHeight - document.getElementById('popMsg').offsetHeight) + "px";
        }
    }

    if (document.getElementById("listDiv"))
    {
        document.getElementById("listDiv").onmouseover = function(e)
        {
            obj = Utils.srcElement(e);

            if (obj)
            {
                if (obj.parentNode.tagName.toLowerCase() == "tr") row = obj.parentNode;
                else if (obj.parentNode.parentNode.tagName.toLowerCase() == "tr") row = obj.parentNode.parentNode;
                else return;

                for (i = 0; i < row.cells.length; i++)
                {
                    if (row.cells[i].tagName != "TH") row.cells[i].style.backgroundColor = '#F4FAFB';
                }
            }

        };

        document.getElementById("listDiv").onmouseout = function(e)
        {
            obj = Utils.srcElement(e);

            if (obj)
            {
                if (obj.parentNode.tagName.toLowerCase() == "tr") row = obj.parentNode;
                else if (obj.parentNode.parentNode.tagName.toLowerCase() == "tr") row = obj.parentNode.parentNode;
                else return;

                for (i = 0; i < row.cells.length; i++)
                {
                    if (row.cells[i].tagName != "TH") row.cells[i].style.backgroundColor = '#FFF';
                }
            }
        };

        document.getElementById("listDiv").onclick = function(e)
        {
            var obj = Utils.srcElement(e);

            if (obj.tagName == "INPUT" && obj.type == "checkbox")
            {
                if (!document.forms['listForm'])
                {
                    return;
                }
                var nodes = document.forms['listForm'].elements;
                var checked = false;

                for (i = 0; i < nodes.length; i++)
                {
                    if (nodes[i].checked)
                    {
                        checked = true;
                        break;
                    }
                }

                if(document.getElementById("btnSubmit"))
                {
                    document.getElementById("btnSubmit").disabled = !checked;
                }
                for (i = 1; i <= 10; i++)
                {
                    if (document.getElementById("btnSubmit" + i))
                    {
                        document.getElementById("btnSubmit" + i).disabled = !checked;
                    }
                }
            }
        }

    }

    //-->
</script>
</body>
</html>