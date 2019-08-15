<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>ECSHOP 管理中心 - 会员列表 </title>
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
        // 这里把JS用到的所有语言都赋值到这里
        var process_request = "正在处理您的请求...";
        var todolist_caption = "记事本";
        var todolist_autosave = "自动保存";
        var todolist_save = "保存";
        var todolist_clear = "清除";
        var todolist_confirm_save = "是否将更改保存到记事本？";
        var todolist_confirm_clear = "是否清空内容？";
        var no_username = "没有输入用户名。";
        var invalid_email = "没有输入邮件地址或者输入了一个无效的邮件地址。";
        var no_password = "没有输入密码。";
        var less_password = "输入的密码不能少于六位。";
        var passwd_balnk = "密码中不能包含空格";
        var no_confirm_password = "没有输入确认密码。";
        var password_not_same = "输入的密码和确认密码不一致。";
        var invalid_pay_points = "消费积分数不是一个整数。";
        var invalid_rank_points = "等级积分数不是一个整数。";
        var password_len_err = "新密码和确认密码的长度不能小于6";
        /*关闭按钮*/
        function get_certificate(){
            var panel = document.getElementById('panelCloud');
            var mask  = document.getElementById('CMask')||null;
            var frame = document.getElementById('CFrame');
            if(panel&&CMask&&frame){
                panel.style.display = 'block';
                mask.style.display = 'block';
                frame.src = '';
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
    <a class="btn btn-right" href="<?php echo U('User/add');?>">添加会员</a>
    <span class="action-span1"><a href="<?php echo U('Index/index');?>">ECSHOP 管理中心</a> </span>
    <span id="search_id" class="action-span1">&nbsp;&nbsp;>&nbsp;&nbsp;用户列表 </span>
    <div style="clear:both"></div>
</h1>

<script type="text/javascript" src="/Public/Backstage/js/utils.js">
</script><script type="text/javascript" src="/Public/Backstage/js/listtable.js"></script>

<div class="form-div">
    <form action="javascript:searchUser()" name="searchForm">
        &nbsp;会员等级
        <select name="user_rank">
            <option value="0">所有等级</option>
            <option value="1">注册用户</option>
            <option value="3">代销用户</option>
            <option value="2">vip</option>
        </select>
        &nbsp;会员积分大于&nbsp;<input type="text" name="pay_points_gt" size="8" />&nbsp;会员积分小于&nbsp;<input type="text" name="pay_points_lt" size="10" />
        &nbsp;会员名称 &nbsp;<input type="text" name="keyword" />
        <input type="submit" class="button" value=" 搜索 ">
    </form>
</div>

<form method="POST" action="" name="listForm" onsubmit="return confirm_bath()">
    <!-- start users list -->
    <div class="list-div" id="listDiv">
        <!--用户列表部分-->
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>
                    <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox">
                    <a href="javascript:listTable.sort('user_id'); ">编号</a><img src="/Public/Backstage/images/sort_desc.png">
                </th>
                <th><a href="javascript:listTable.sort('user_name'); ">会员名称</a></th>
                <th><a href="javascript:listTable.sort('email'); ">邮件地址</a></th>
                <th><a href="javascript:listTable.sort('is_validated'); ">是否已验证</a></th>
                <th>可用资金</th>
                <th>冻结资金</th>
                <th>等级积分</th>
                <th>消费积分</th>
                <th><a href="javascript:listTable.sort('reg_time'); ">注册日期</a></th>
                <th>操作</th>
            <tr>

            <tr>
                <td><input type="checkbox" name="checkboxes[]" value="2" notice="0"/>2</td>
                <td class="first-cell">vip</td>
                <td><span onclick="listTable.edit(this, 'edit_email', 2)">vip@ecshop.com</span></td>
                <td align="center"> <img src="images/yes.svg" width="20"> </td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0</td>
                <td>0</td>
                <td align="center">2017-09-13</td>
                <td align="center">
                    <a href="users.php?act=edit&id=2" title="编辑">编辑</a>
                    <a href="users.php?act=address_list&id=2" title="收货地址">收货地址</a>
                    <a href="order.php?act=list&user_id=2" title="查看订单">查看订单</a>
                    <a href="account_log.php?act=list&user_id=2" title="查看账目明细">查看账目明细</a>
                    <a href="javascript:confirm_redirect('您确定要删除该会员账号吗？', 'users.php?act=remove&id=2')" title="移除">移除</a>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="act" value="batch_remove" />
                    <input type="submit" id="btnSubmit" value="删除会员" disabled="true" class="button" /></td>
                <td align="right" nowrap="true" colspan="8">
                    <div id="turn-page">
                        <span id="pageCurrent">1</span> / <span id="totalPages">1</span>
                        页，每页 <input type='text' size='3' id='pageSize' value="15" onkeypress="return listTable.changePageSize(event)">
                        条记录，总共 <span id="totalRecords">1</span>
                        条记录
                        <span id="page-link">
                            <a href="javascript:listTable.gotoPageFirst()">第一页</a>
                            <a href="javascript:listTable.gotoPagePrev()">上一页</a>
                            <a href="javascript:listTable.gotoPageNext()">下一页</a>
                            <a href="javascript:listTable.gotoPageLast()">最末页</a>
                            <select id="gotoPage" onchange="listTable.gotoPage(this.value)">
                              <option value='1'>1</option>
                            </select>
                          </span>
                    </div>
                </td>
            </tr>
        </table>

    </div>
    <!-- end users list -->
</form>

<script type="text/javascript" language="JavaScript">
    listTable.recordCount = 1;
    listTable.pageCount = 1;

    listTable.filter.keywords = '';
    listTable.filter.rank = '0';
    listTable.filter.pay_points_gt = '0';
    listTable.filter.pay_points_lt = '0';
    listTable.filter.sort_by = 'user_id';
    listTable.filter.sort_order = 'DESC';
    listTable.filter.record_count = '1';
    listTable.filter.page_size = '15';
    listTable.filter.page = '1';
    listTable.filter.page_count = '1';
    listTable.filter.start = '0';

    onload = function()
    {
        document.forms['searchForm'].elements['keyword'].focus();
        // 开始检查订单
        startCheckOrder();
    };

    /**
     * 搜索用户
     */
    function searchUser()
    {
        listTable.filter['keywords'] = Utils.trim(document.forms['searchForm'].elements['keyword'].value);
        listTable.filter['rank'] = document.forms['searchForm'].elements['user_rank'].value;
        listTable.filter['pay_points_gt'] = Utils.trim(document.forms['searchForm'].elements['pay_points_gt'].value);
        listTable.filter['pay_points_lt'] = Utils.trim(document.forms['searchForm'].elements['pay_points_lt'].value);
        listTable.filter['page'] = 1;
        listTable.loadList();
    }

    function confirm_bath()
    {
        userItems = document.getElementsByName('checkboxes[]');

        cfm = '您确定要删除所有选中的会员账号吗？';

        for (i=0; userItems[i]; i++)
        {
            if (userItems[i].checked && userItems[i].notice == 1)
            {
                cfm = '选中的会员账户中仍有余额或欠款\n' + '您确定要删除所有选中的会员账号吗？';
                break;
            }
        }

        return confirm(cfm);
    }
</script>

<div id="footer">
    共执行 7 个查询，用时 0.028000 秒，Gzip 已禁用，内存占用 1.658 MB<br />
    版权所有 &copy; 2005-2019 上海商派软件有限公司，并保留所有权利。
</div>

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
        };
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
</script>
</body>
</html>