<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/H-ui/lib/html5.js"></script>
<script type="text/javascript" src="/Public/H-ui/lib/respond.min.js"></script>
<script type="text/javascript" src="/Public/H-ui/lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Public/H-ui/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/H-ui/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Public/H-ui/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Public/H-ui/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/Public/H-ui/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Public/H-ui/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<style type="text/css">
    td{font-size: 14px;}
    
</style>
<title></title>
</head>
<body style='background:0;'>
    <div class="" style='margin-left:8px;background: #fff;height:725px;'>
        <nav class="breadcrumb" style='height: 45px;line-height: 45px;font-size: 16px;'>个人信息</nav>
        <form action="/index.php/Member/userinfo.html" method="post" class="form form-horizontal userinfo" id="form-member-add">

            <div class="pd-20">
                <table class="table  table-border table-bordered table-hover table-bg">
                    <tbody> 
                        <tr>
                            <th class="text-l" colspan="2">基本信息：</th>

                        </tr>
                        <tr>
                            <th class="text-r" style="width:30%">会员账号：</th>
                            <td class="text-l" style="width:70%"><?php echo ($userInfo["username"]); ?></td>
                        </tr>
                        <tr>
                            <th class="text-r" style="width:30%">会员昵称：</th>
                            <td class="text-l" style="width:70%"><?php echo ($userInfo["name"]); ?></td>
                        </tr>
                        <tr>
                            <th class="text-r" style="width:30%">手机号码：</th>
                            <td class="text-l" style="width:70%"><?php echo ($userInfo["mobile"]); ?></td>
                        </tr>  
                        <tr>
                            <th class="text-r" style="width:30%">推荐人：</th>
                            <td class="text-l" style="width:70%"><?php echo ($userInfo["recommend"]); ?></td>
                        </tr>  
                        <tr>
                            <th class="text-r" style="width:30%">本金钱袋：</th>
                            <td class="text-l" style="width:70%"><?php echo ($userInfo["principal"]); ?></td>
                        </tr>
                        <tr>
                            <th class="text-r" style="width:30%">积分：</th>
                            <td class="text-l" style="width:70%"><?php echo ($userInfo["integral"]); ?></td>
                        </tr>
                      
                        <tr>
                            <th class="text-r" style="width:30%">直推人数：</th>
                            <td class="text-l" style="width:70%"><?php echo ($userInfo["directnum"]); ?></td>
                        </tr>
                        <tr>
                            <th class="text-r" style="width:30%">团队人数：</th>
                            <td class="text-l" style="width:70%"><?php echo ($userInfo["group"]); ?></td>
                        </tr>
                        <tr>
                            <th class="text-r" style="width:30%">注册日期：</th>
                            <td class="text-l" style="width:70%"><?php echo (date('Y-m-d',$userInfo["regtime"])); ?></td>
                        </tr>
                        <tr>
                            <th class="text-l" colspan="2">银行信息：</th>

                        </tr>

                        <tr>
                            <th class="text-r" style="width:30%" colspan="2">
                                <button type="button" class="btn btn-secondary radius" onclick="showPage('700','355','添加银行卡','<?php echo U("Member/addbank");?>')" href="javascript:;"><i class="Hui-iconfont"></i> 添加银行卡</button>
                               
                            </th>
                        </tr>
                    <?php if(is_array($userbanklist)): $i = 0; $__LIST__ = $userbanklist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <th class="text-r" style="width:30%">银行名称：</th>
                            <td class="text-l" style="width:70%"><?php echo ($vo["bank"]); ?></td>
                        </tr>
                         <tr>
                            <th class="text-r" style="width:30%">开户姓名：</th>
                            <td class="text-l" style="width:70%"><?php echo ($vo["username"]); ?></td>
                        </tr>
                         <tr>
                            <th class="text-r" style="width:30%">银行卡号：</th>
                            <td class="text-l" style="width:70%"><?php echo ($vo["bankno"]); ?></td>
                        </tr>
                        <tr>
                            <th class="text-r" style="width:30%">开户银行网点地址：</th>
                            <td class="text-l" style="width:70%"><?php echo ($vo["kaihubank"]); ?></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </form>
        </div>
<script type="text/javascript" src="/Public/H-ui/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/H-ui/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Public/H-ui/lib/laypage/1.2/laypage.js"></script> 
<script type="text/javascript" src="/Public/H-ui/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/Public/H-ui/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Public/H-ui/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/Public/H-ui/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="/Public/H-ui/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/Public/H-ui/lib/jquery.validation/1.14.0/messages_zh.min.js"></script>
<script type="text/javascript" src="/Public/H-ui/lib/Validform/5.3.2/Validform_v5.3.2_min.js"></script>
<script type="text/javascript" src="/Public/H-ui/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/js/home/H-ui.home.js"></script> 
</body>
</html>