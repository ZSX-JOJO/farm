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
<nav class="breadcrumb" style='height: 45px;line-height: 45px;font-size: 16px;'>发件箱</nav>  
<div class="page-container">
	<form action="" method="post" class="form form-horizontal SubmiForm" id="form-article-add" enctype="multipart/form-data">
            {__TOKEN__}
            <div class="row cl">
			<label class="form-label col-xs-3 col-sm-2"  style='text-align:right;'><span class="c-red">*</span>主题：</label>
			<div class="formControls col-xs-7 col-sm-9">
                            <input type="text" class="input-text subject" value="" maxlength="100" placeholder="" id="" name="subject" datatype="*10-100" nullmsg="主题不能为空！" >
			</div>
		</div>
                <div class="row cl">
			<label class="form-label col-xs-3 col-sm-2"  style='text-align:right;'><span class="c-red">*</span>上传图片：</label>
			<div class="formControls col-xs-7 col-sm-9">
                           <input type="file"  id='file' name='upfile' /> 
			</div>
		</div>
  
            
			<div class="row cl">
			<label class="form-label col-xs-3 col-sm-2" style='text-align:right;'><span class="c-red">*</span>内容：</label>
			<div class="formControls col-xs-7 col-sm-9">
                            <textarea name="content" cols="" rows="" maxlength="200" class="textarea content"  placeholder="说点什么..." datatype="*3-100" dragonfly="true" nullmsg="内容不能为空！" onKeyUp="textarealength(this,200)"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-secondary radius "   type="submit"><i class="Hui-iconfont">&#xe632;</i> 确认</button>
			
			</div>
		</div>
	</form>
</div>
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


<script src="/Public/js/admin/jquery.form.js" language="JavaScript" type="text/javascript"></script>
 <script type="text/javascript"> 
     $(".SubmiForm").Validform({
                callback:function(form){
		 $("#form-article-add").ajaxSubmit({
			//dataType:'script',
			type:'post',
			url: "/Home/Message/messageadd",    
			beforeSubmit: function(){
				layer.msg('正在上传中...',{icon:6,time:1000});
			},
			success: function(data){   
                                 data= JSON.parse(data);
				if(data.status==1){
				 layer.msg(data.msg,{icon: 1,time:1000},function(){
				 location.replace(location.href);
                                });
				}else {
				layer.msg(data.msg,{icon:2,time:1000});
				}
				
			},
			resetForm: false,
			clearForm: false
		});

                    return false;
		},
		tiptype:1,
         
	});	


        </script>