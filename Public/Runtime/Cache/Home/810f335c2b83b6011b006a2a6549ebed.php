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
<title>注册会员</title>
<style type="text/css">
.msgs{display:inline-block;width:104px;color:#fff;font-size:12px;border:1px solid #0697DA;text-align:center;height:30px;line-height:30px;background:#0697DA;cursor:pointer;}
.msgs1{background:#E6E6E6;color:#818080;border:1px solid #CCCCCC;}
</style>
</head>
<body style="background: 0;">
<div class="" style='margin-left:8px;background: #fff;height:725px;'>
 <nav class="breadcrumb" style='height: 45px;line-height: 45px;font-size: 16px;'>注册会员</nav>
    <article class="page-container">
        <form action="/index.php/Reg/index.html" method="" class="form form-horizontal registerform" id="form-member-add">
            {__TOKEN__} 
            
                <div class="row cl">
                    <label class="form-label col-xs-3 col-sm-3" style='text-align:right;'><span class="c-red">*</span>会员账号：</label>
                    <div class="formControls col-xs-7 col-sm-5">
                        <input type="text" class="input-text username" value="" ajaxurl="<?php echo U('/Home/Login/check_username_unique');?>"  placeholder="" errormsg="会员账号长度为6-16" nullmsg="请输入会员账号！"  id="username" name="username"  datatype="u6-16" >
                    </div><div>
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-3 col-sm-3" style='text-align:right;' ><span class="c-red">*</span>会员昵称：</label>
                    <div class="formControls col-xs-7 col-sm-5">
                        <input type="text" class="input-text name" value="" placeholder="" id="name" name="name"  nullmsg="请输入昵称！" datatype="*">
                    </div>

                    <div class="Validform_checktip"></div>
                </div>
             
                <div class="row cl">
                    <label class="form-label col-xs-3 col-sm-3" style='text-align:right;' ><span class="c-red">*</span>密码：</label>
                    <div class="formControls col-xs-7 col-sm-5">
                        <input type="password" class="input-text password" value="" placeholder="" id="password" name="password" errormsg="密码范围在6~12位之间！" nullmsg="请设置密码！" datatype="*6-12">
                    </div>
                    <div class="Validform_checktip"></div>
                </div>

                <div class="row cl">
                    <label class="form-label col-xs-3 col-sm-3" style='text-align:right;'><span class="c-red">*</span>确认密码：</label>
                    <div class="formControls col-xs-7 col-sm-5">
                        <input type="password" value="" class="input-text affirm_password" placeholder="" name="affirm_password" id="affirm_password" errormsg="您两次输入的密码不一致！" nullmsg="请再输入密码！" recheck="password" datatype="*" tip="test">
                    </div>
                    <div class="Validform_checktip"></div>
                </div>
<!--               <div class="row cl">
                    <label class="form-label col-xs-3 col-sm-3" style='text-align:right;' ><span class="c-red">*</span>二级密码：</label>
                    <div class="formControls col-xs-7 col-sm-5">
                        <input type="text" class="input-text towpassword" value="1111111" placeholder="" id="towpassword" name="towpassword" errormsg="密码范围在6~16位之间！" nullmsg="请设置一级密码！" datatype="*6-16">
                    </div>
                    <div class="Validform_checktip"></div>
                </div>

                <div class="row cl">
                    <label class="form-label col-xs-3 col-sm-3" style='text-align:right;'><span class="c-red">*</span>确认二级密码：</label>
                    <div class="formControls col-xs-7 col-sm-5">
                        <input type="text" value="1111111" class="input-text affirm_towpassword" placeholder="" name="affirm_towpassword" id="affirm_towpassword" errormsg="您两次输入的一级密码不一致！" nullmsg="请再输入一次一级密码！" recheck="towpassword" datatype="*" tip="test">
                    </div>
                    <div class="Validform_checktip"></div>
                </div>-->

<!--                <div class="row cl">
                    <label class="form-label col-xs-3 col-sm-3" style='text-align:right;'><span class="c-red">*</span>推荐人：</label>
                    <div class="formControls col-xs-7 col-sm-5">
                        <input type="text" value='<?php echo ($username); ?>' class="input-text recommend" placeholder=""    name="recommend" id="recommend"    >
                    </div>
                    <div class="Validform_checktip"></div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-3 col-sm-3" style='text-align:right;'><span class="c-red">*</span>开户银行：</label>
                    <div class="formControls col-xs-7 col-sm-5 ">
                        <select class="select bank select-box " size="1" name="bank"  datatype="*" nullmsg="请选择银行"  >
                            <option value=''>请选择银行</option>
                            <?php if(is_array($banklist)): $i = 0; $__LIST__ = $banklist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["bankname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>

                    </div>  <div class="Validform_checktip" id='quyi'></div>

                </div>
             <div class="row cl">
                    <label class="form-label col-xs-3 col-sm-3" style='text-align:right;' ><span class="c-red">*</span>开户姓名：</label>
                    <div class="formControls col-xs-7 col-sm-5">
                        <input type="text" class="input-text accountname" value="11111111" placeholder="" id="accountname" name="accountname"  nullmsg="请输入开户姓名！" datatype="*">
                    </div>

                    <div class="Validform_checktip"></div>
                </div>
             <div class="row cl">
                    <label class="form-label col-xs-3 col-sm-3" style='text-align:right;' ><span class="c-red">*</span>开户行账号：</label>
                    <div class="formControls col-xs-7 col-sm-5">
                        <input type="text" class="input-text bankno" value="11111111" placeholder="" ajaxurl="<?php echo U('/Home/Login/check_bankno_unique');?>"  id="bankno" name="bankno"  nullmsg="请输入开户行账号！" datatype="*">
                    </div>

                    <div class="Validform_checktip"></div>
                </div>
               <div class="row cl">
                    <label class="form-label col-xs-3 col-sm-3" style='text-align:right;' ><span class="c-red">*</span>开户行地址：</label>
                    <div class="formControls col-xs-7 col-sm-5">
                        <input type="text" class="input-text accountopeni" value="111111111" placeholder="" id="accountopeni" name="accountopeni"  nullmsg="请输入开户行地址！" datatype="*">
                    </div>

                    <div class="Validform_checktip"></div>
                </div>-->
                   <div class="row cl">
                    <label class="form-label col-xs-3 col-sm-3" style='text-align:right;' ><span class="c-red">*</span>手机号码：</label>
                    <div class="formControls col-xs-7 col-sm-5">
                       <input type="text" class="input-text mobile" value="" ajaxurl="<?php echo U('/Home/Login/check_mobile_unique');?>"  placeholder="" id="mobile" name="mobile" errormsg="手机号码格式不正确！" nullmsg="请输入数据号码！" datatype="mobile">  
                    </div>

                    <div class="Validform_checktip mobile_msg"></div>
                </div>
            
<!--               <div class="row cl">
                    <label class="form-label col-xs-3 col-sm-3" style='text-align:right;' ><span class="c-red">*</span>莱特币账号：</label>
                    <div class="formControls col-xs-7 col-sm-5">
                        <input type="text" class="input-text laitebino" value="11111111" placeholder="" id="laitebino" name="laitebino"  nullmsg="请输入莱特币账号！" datatype="*">
                    </div>

                    <div class="Validform_checktip"></div>
                </div>
            <div class="row cl">
                    <label class="form-label col-xs-3 col-sm-3" style='text-align:right;' ><span class="c-red">*</span>莱特币地址：</label>
                    <div class="formControls col-xs-7 col-sm-5">
                        <input type="text" class="input-text laitebidz" value="11111111" placeholder="" id="laitebidz" name="laitebidz"  nullmsg="请输入莱特币地址！" datatype="*">
                    </div>

                    <div class="Validform_checktip"></div>
                </div>-->
            <div class="row cl">
			<label class="form-label col-xs-3 col-sm-3" style="text-align:right;"><span class="c-red">*</span>短信验证码：</label>
			<div class="formControls col-xs-7 col-sm-9">
					<input type="text" class="input-text code" placeholder="" name="code" value="" style="width:120px;">&nbsp;&nbsp;<span class="msgs">获取短信验证码</span>
			</div>
		</div>
                
                <div class="row cl" style="padding:16px;">
                    <div class="col-xs-8 col-sm-4 col-xs-offset-4 col-sm-offset-5">
                        
                        <button class="btn btn-secondary radius" type="submit"><i class="Hui-iconfont"></i>  注 册 </button>
                    </div>
                </div>
        </form>
    </article>


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

<script type="text/javascript">
    


    $(function () {
        
      
    	//获取短信验证码
		var validCode=true;
		$(".msgs").click (function  () {
			  var mobile=$('.mobile').val();
                         if(mobile!==""){
			var time=60*3;
			var code=$(this);
			var flag=false;
			if (validCode) {
				validCode=false;
				code.addClass("msgs1");
				flag=true;
			var t=setInterval(function  () {
				time--;
				code.html(time+"秒");
				if (time==0) {
					clearInterval(t);
				code.html("重新获取");
					validCode=true;
				code.removeClass("msgs1");

				}
			},1000)
			}
			if(flag)
			{  
				flag=false;
				codes();
			}
                          }else{
                            $('.mobile_msg').html(' <span class="Validform_checktip Validform_wrong">请输入手机号码！</span>');

                       }
		})
	/****************************************/
       

      

        $.extend($.Datatype, {
          //  "z2-4":/^[\u4e00-\u9fa5]{2,4}$|^[a-zA-Z]{1,30}$/gi,
        });


        $(".registerform").Validform({
         
            callback: function (form) {
              
            
                var check = confirm("您确定要提交表单吗？");
                if (check) {
                 register();
                }
           

                return false;
            },
            tiptype: 2,
            datatype: {//传入自定义datatype类型【方式二】;
                "z2-4": /^[\u4e00-\u9fa5]{2,4}$|^[a-zA-Z]{2,30}$/gi,
                "yb-6": /[1-9]\d{5}(?!\d)/,
                "u6-16": /^[A-Za-z0-9]{6,12}$/,
                "yhno-16-19": /^(\d{16}|\d{19})$/,
                "xxdz": /^(?=.*?[\u4E00-\u9FA5])[\d\u4E00-\u9FA5]+/,
                'mobile':/^1[34578]\d{9}$/,
            }
        });


    })


</script>