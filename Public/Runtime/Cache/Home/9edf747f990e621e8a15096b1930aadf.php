<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <link rel="stylesheet" type="text/css" href="/Public/style/home/style.css" />
<script type="text/javascript" src="/Public/js/home/jquery.js"></script>
<script type="text/javascript" src="/Public/H-ui/lib/layer/2.1/layer.js"></script>
<script  type="text/javascript" src='/Public/js/home/farm.js'></script>
<style type="text/css">
.black_overlay{
display: none;
position: absolute;
top: 0%;
left: 0%;
width: 100%;
height: 100%;
-moz-opacity: 0.8;
opacity:.80;
filter: alpha(opacity=80);
}
.fwinmask {

position: absolute;
}
.white_content_small {
display: none;
position: absolute;
top: 20%;
left: 30%;
width: 40%;
height: 50%;
border: 16px solid lightblue;
background-color: white;
z-index:1002;
overflow: auto;
}
</style>
  <title>Document</title>
 </head>
 <body >
  <!--弹出层时背景层DIV-->
<div id="fade" class="black_overlay"></div>
<!----仓库商店start---->
<div id="fwin_gfarm" class="fwinmask" initialized="true" style="position: fixed; z-index: 201; top:0; bottom:0;">
<table cellpadding="0" cellspacing="0" class="fwin">
<tbody>
<tr><td class="t_l"></td>
<td class="t_c" style="cursor:move" ></td>
<td class="t_r"></td></tr><tr><td class="m_l" style="cursor:move">&nbsp;&nbsp;</td>
<td class="m_c" id="fwin_content_gfarm" fwin="gfarm">
<style>
ul{ margin: 0px; padding: 0px;}
#fwin_gfarm .m_c{background:url(/Public/images/home/shop/bg-mid.png) no-repeat;}
#ulmenu  .open { background: url(/Public/images/home/shop/select.png) no-repeat;} 
</style>

<div class="depotclass" onmousedown="">
<div class="depotclose" onclick="close_ifrme();"></div>
<img src="/Public/images/home/shop/depott.png" class="depottitle">
<ul class="line listti" id="ulmenu" fwin="gfarm">
<li class="open">果实</li>
<!--<li>种子</li>
<li>道具</li>-->

</ul>

<!------果实start------>
<div id="outdepots" fwin="gfarm" class="cntorder">
<div id="indepots" fwin="gfarm">
<ul class="line" id="ul3" fwin="gfarm">




</ul>
</div>
</div>

<!------果实end------>




<div class="footdepot">
<span style="color: #946412;font-weight: bold;">总价值：</span>
<!--<span style="color: #696969"><img src="/Public/images/home/shop/money01.png"><span id="jin" fwin="gfarm">0</span></span>-->
<span style="color: #696969">
    <!--<img src="/Public/images/home/shop/yuanbao01.png">-->
    <span id="totalmoney" fwin="gfarm"></span></span>
<div class="footdepotright">
<span><a href="javascript:;" onclick="locktotal()">一键锁定</a></span><span><a href="javascript:;" onclick="selltotal()">一键卖出</a></span>
</div>
</div>
</div>
</td>
<td class="m_r" style="cursor:move" onmousedown="" ondblclick=""></td>
</tr>
<tr>
<td class="b_l"></td>
<td class="b_c" style="cursor:move" onmousedown="" ondblclick=""></td>
<td class="b_r"></td>
</tr>
</tbody>
</table>
</div>
 </body>
</html>
<script type="text/javascript"> 
//选项卡切换 
$(function () { 
$("#ulmenu li ").click(function () { 
var index_tab = $(this).parent().children().index($(this)); //选项卡的索引值 
$(this).parent().find(".open").removeClass("open").addClass("close"); //选项卡背景处理 
$(this).removeClass("close").addClass("open"); 
//仓库选项卡切换
var content_obj = $(".cntorder"); //内容节点 
content_obj.hide(); 
content_obj.eq(index_tab).show(); 

//排行榜选项卡切换
var rankcontent_obj = $(".ranking_cntorder"); //内容节点 
rankcontent_obj.hide(); 
rankcontent_obj.eq(index_tab).show(); 
}); 
}); 


</script>