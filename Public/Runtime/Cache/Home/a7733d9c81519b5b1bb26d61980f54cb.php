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
<body style='background-color: #DCE0EB;'>
<div class="" style='background: #fff;'>
<div class="page-container">
	<form action=""  class="form form-horizontal SubmiForm" id="form-article-add"  >
		{__TOKEN__}
              <div class="row cl">
			<label class="form-label col-xs-4 col-sm-4 " style="text-align: right;"><span class="c-red">*</span>对方账号：</label>
			<div class="formControls col-xs-5 col-sm-4">
                            <input type="text" class="input-text username"  value="" placeholder="" id="" name="username"   nullmsg="请输入对方账号！" datatype="*" ajaxurl="<?php echo U('/Home/Login/check_username');?>" >
			</div>
                           <div class="Validform_checktip"></div>
		</div>
                            
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-4 " style="text-align: right;"><span class="c-red text-r">*</span>二级密码：</label>
			<div class="formControls col-xs-5 col-sm-4">
				<input type="password" name="towpassword" id="" placeholder="" value="" class="input-text towpassword"  nullmsg="请输入二级密码！"  datatype="*"  >
			</div>
                           <div class="Validform_checktip"></div>
		</div>


		<div class="row cl text-c">
                    <button  class="btn btn-secondary radius"   type="submit"><i class="Hui-iconfont">&#xe632;</i> 添加</button>
		</div>
	</form>
</div>

<!--_footer 作为公共模版分离出去-->
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

<!--/_footer /作为公共模版分离出去-->
<script type="text/javascript">
$(function(){

$(".SubmiForm").Validform({
                callback:function(form){
                  addfriends();
                    return false;
		},
		tiptype:2,
         
	});	
});
</script>