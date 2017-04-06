<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
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
<style>
ul{ margin: 0px; padding: 0px;}
#fwin_gfarm .m_c{background:url(/Public/images/home/shop/bg-mid.png) no-repeat;}
#ulmenu  .open { 
background: url(/Public/images/home/shop/select.png) no-repeat;
}
#fwin_gfarm2 .m_c{background:url(/Public/images/home/shop/bg-big.png) no-repeat;}
</style>
<!----商店start-------->   
<div id="fwin_gfarm2" class="fwinmask" initialized="true" style="position: fixed;z-index: 201;left: 0px;right: 0px;top: 0px;bottom: 0px;">
<table cellpadding="0" cellspacing="0" class="fwin"><tbody>
<tr><td class="t_l"></td><td class="t_c" style="cursor:move" onmousedown="" ondblclick=""></td><td class="t_r"></td></tr>
<tr><td class="m_l" style="cursor:move" onmousedown="" ondblclick="">&nbsp;&nbsp;</td><td class="m_c" id="fwin_content_gfarm" fwin="gfarm">
<div class="shopclass" onmousedown="">
<img src="/Public/images/home/shop/shopt.png" class="shoptitle">
<div class="shopclose" onclick="close_ifrme();"></div>
<ul class="line listti" id="ulmenu" fwin="gfarm">
<li class="open"><a href="javascript:;" style="color: white;" class="acolor" >种子</a></li>
<li><a href="javascript:;" >道具</a></li>
</ul>

<!--------------------------------------商店种子start-------------------------------------------------------------------->
<div id="outs" fwin="gfarm" class="shop_cntorder">
<div id="ins" fwin="gfarm">
<ul class="line" id="ul2" fwin="gfarm"style="margin: 0;padding: 0;">
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
<div class="shopbottom listti">
<span class="shopname" id="shopname"><?php echo ($vo["title"]); ?></span>
<span id="12" class="buybotton" onclick="layer_page('420','320','购买','<?php echo U('buy',array('id'=>$vo['id']));?>')" fwin="gfarm">购买</span></div>
<div style="padding-top: 10px">
<div style="float: left;width: 75px;text-align: center;position: relative;">
    <img class="showimg" src="/<?php echo ($vo["small"]); ?>">			
<span>LV.<?php echo ($vo["level"]); ?></span>
</div>
<div style="float: left;text-align: left;">售价：<img title="农场币" src="/Public/images/home/shop/money-1.png"><?php echo ($vo["money"]); ?><br>
存货：<span id="still_12" fwin="gfarm">不限</span><br>
时间：<?php echo ($vo["hour"]); ?>小时</div>			
</div>
</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</div>
</div>

<!--------------------------------------商店道具start-------------------------------------------------------------------->
<div id="outs" fwin="gfarm" class="shop_cntorder" style="display: none;">
<div id="ins" fwin="gfarm">
<ul class="line" id="ul2" fwin="gfarm"style="margin: 0;padding: 0;">
   <?php if(is_array($toollist)): $i = 0; $__LIST__ = $toollist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
<div class="shopbottom listti">
<span class="shopname" id="shopname"><?php echo ($vo["title"]); ?></span>
<span id="12" class="buybotton" onclick="layer_page('420','320','购买','<?php echo U('buytool',array('id'=>$vo['id']));?>')" fwin="gfarm">购买</span></div>
<div style="padding-top: 10px">
<div style="float: left;width: 75px;text-align: center;position: relative;">
    <img class="showimg" src="/<?php echo ($vo["small"]); ?>">			
<span>LV.<?php echo ($vo["level"]); ?></span>
</div>
<div style="float: left;text-align: left;">售价：<img title="农场币" src="/Public/images/home/shop/money-1.png"><?php echo ($vo["money"]); ?><br>
存货：<span id="still_12" fwin="gfarm">不限</span><br>
时间：<?php echo ($vo["hour"]); ?>小时</div>			
</div>
</li><?php endforeach; endif; else: echo "" ;endif; ?>

</ul>
</div>
</div>

<!--------------------------------------商店道具end-------------------------------------------------------------------->
<!--  <div id='shopallnum'>当前总共有<span id='shopbottom'>13款种子</span>出售</div>-->
<script type="text/javascript"> 
//选项卡切换 
$(function () { 
$("#ulmenu li ").click(function () { 
var index_tab = $(this).parent().children().index($(this)); //选项卡的索引值 
$(this).parent().find(".open").removeClass("open").addClass("close"); //选项卡背景处理 
$(this).removeClass("close").addClass("open"); 

//商店选项卡切换
var shopcontent_obj = $(".shop_cntorder"); //内容节点 
shopcontent_obj.hide(); 
shopcontent_obj.eq(index_tab).show(); 
}); 
}); 
</script>