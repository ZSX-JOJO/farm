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
<style type="text/css">
.msgs{display:inline-block;width:104px;color:#fff;font-size:12px;border:1px solid #0697DA;text-align:center;height:30px;line-height:30px;background:#0697DA;cursor:pointer;}
.msgs1{background:#E6E6E6;color:#818080;border:1px solid #CCCCCC;}
</style>
</head>
<body style="background: 0;">
<div class="" style='margin-left:8px;background: #fff;height:725px;'>
 <nav class="breadcrumb" style='height: 45px;line-height: 45px;font-size: 16px;'>分享链接</nav>
<table class="table table-border table-bordered table-hover table-bg ">
<div class="page-container">

        <div class="mt-0">
            <table class="table table-border table-bordered table-hover table-bg ">
                
                <tbody>
                <tr class="text-c"> 
                        <td class="text-c"> 
                            <span class='info_font_span'>推广链接：</span><input name="" type="text" value='http://<?php echo ($url); ?>' style='width: 400px;font-weight: initial;height:30px;line-height:30px;' id='fe_text'>
                            &nbsp;<input type="button" value='复制' style='background: #d00000; color: #fff; width: 50px;border:0px;height:30px;line-height:30px;font-weight: initial;' id="d_clip_button" class="my_clip_button" data-clipboard-target="fe_text" /><br /></td>
                      
                    </tr>
                    <tr class="text-c"> 
                        <td class="text-c" colspan="2" >    <img src="<?php echo U('Reg/qrcode');?>"  width='180' height='180'/></td>
                    
                    </tr>
                </tbody>
            </table>  
            <div id="pageNav" class="pageNav"><div>    </div></div>
        </div>
    </div>
<script type="text/javascript" src="/Public/js/home/ZeroClipboard/ZeroClipboard.js"></script>
		<script type="text/javascript">
// 定义一个新的复制对象
var clip = new ZeroClipboard( document.getElementById("d_clip_button"), {
  moviePath: "/Public/js/home/ZeroClipboard/ZeroClipboard.swf"
} );

// 复制内容到剪贴板成功后的操作
clip.on( 'complete', function(client, args) {
   alert("复制成功，复制内容为："+ args.text);
} );

</script>