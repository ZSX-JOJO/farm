<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Cache-Control" content="no-cache,no-store, must-revalidate">
<title>我的农场</title>
<link rel="stylesheet" type="text/css" href="/Public/style/home/main.css" />
<link rel="stylesheet" type="text/css" href="/Public/style/home/gd.css" />
<link rel="stylesheet" type="text/css" href="/Public/style/home/rightlist.css" />
<link rel="stylesheet" type="text/css" href="/Public/style/home/jdt.css" />
<script type="text/javascript" src="/Public/js/home/jquery.js"></script>
<script  type="text/javascript" src='/Public/js/home/jquery.cookie.js'></script>
<script  type="text/javascript" src='/Public/js/home/farm.js'></script>
<script  type="text/javascript" src='/Public/js/home/gd.js'></script>
<script type="text/javascript"  src="/Public/js/home/rightlist.js" ></script>
<script type="text/javascript" src="/Public/H-ui/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" >
$(document).ready(function () {//30秒
setInterval(autotime, 30000);  //
});



</script>




 

</head>

<body id='body' onload="load()">

  <div class="main"> 
   <div class="bg"> 
    <div class="userinfo" style=""> 
     <img class="yuanbao01" src="/Public/images/home/yuanbao01.png"  title="积分"/> 
     <img class="money01" src="/Public/images/home/money01.png" title="现金" /> 
     <img class="streng01" src="/Public/images/home/streng01.png" title="果实数量"/> 
     <div style="width: 65px;height: 70px;float: left;"> 
      <img style="margin-top:16px;margin-left: 3px" src="/Public/images/home/t.jpg" width="55px" height="55px" /> 
      <span style="margin-top: 5px;   display: inline-block;"> <a href="<?php echo U('Member/userinfo');?>" style="color: white">[查看详情]</a> </span> 
     </div> 
     <div style="width: 145px;float: left;line-height: 17px;"> 
      <div id="userinfo">
       <?php echo ($userinfo["username"]); ?>
       <br />
       <span style="position: relative;"> <span id="userlevel"><?php echo ($level["title"]); ?></span><img src="/Public/images/home/up_alt.png" style=" display:none" /></span>(
       <span id="upexperience"><?php echo ($uplevel["experience"]); ?></span>/<span id='experience'><?php echo ($userinfo["experience"]); ?></span>)
      </div> 
      <div style="width: 145px;float: left;"> 
       <div style="height: 30px;margin-left: 28px"> 
        <span id="usermoney"><?php echo ($userinfo["principal"]); ?></span>
        <br /> 
        <span id="integral"><?php echo ($userinfo["integral"]); ?></span>
        <br /> 
        <span id="fruitbalance"><?php echo ($number); ?></span>
       </div> 
      </div> 
      <div style="height: 10px;text-align: right;float:right;">
       <!--<a href="" onclick=""><img src="/Public/images/home/exchange.png" /></a>-->
      </div> 
     </div> 
    </div> 
    <div id="righttop"> 
     <span><a href="javascript:void(0);" onclick="layer_page('590','450','个人仓库','<?php echo U('index/depot');?>')" ><img src="/Public/images/home/depot.png" /></a></span> 
     <span><a href="javascript:void(0);" onclick="layer_page('690','510','商店','<?php echo U('index/shop');?>')" ><img src="/Public/images/home/shop.png" /></a></span> 
     <span><a  href="javascript:void(0);" onclick="layer_page('590','450','排序榜','<?php echo U('index/ranking');?>')"><img src="/Public/images/home/ranking.png" /></a></span> 
    </div> 
<!--    <div id="leftcenter"> 
     <span><a href="" onclick=""><img src="/Public/images/home/signin.png" /></a></span> 
     <span><a href="" onclick=""><img src="/Public/images/home/ad.png" /></a></span> 
     <span><a href="" onclick=""><img src="/Public/images/home/mess.png" /></a></span> 
    </div> -->
    <div class="plate"> 
     <img src="/Public/images/home/15.png" width="120" height="120" /> 
    </div> 
    <div class="didiv"> 
     <ul class="diul" id='land'> 
      
     </ul> 
       
    </div> 
    
    
    
<!--    <div id="bottomleft"> 
     <span><img src="/Public/images/home/maintask.png" /></span> 
     <span><img src="/Public/images/home/basetask.png" /></span> 
     <span><img src="/Public/images/home/active.png" /></span> 
    </div> -->
    <!--<div id="refresh" title="刷新"></div>--> 

    <div id="bottomcenter"> 
     <div id="itemsul" style="display: none"> 
     </div> 
     <div id="closemenu"></div> 
     <div id="usermenu"> 
      <span onclick="basket()"><img src="/Public/images/home/setgerm.png" /><font>种植</font></span> 
      <span onclick="mico('kaiico',1)"><img src="/Public/images/home/shovel.png" /><font>铲除</font></span> 
      <span onclick="mico('caiico',3)"><img src="/Public/images/home/hand.png" /><font>收获</font></span> 
      <span onclick="tool()"><img src="/Public/images/home/huafeis.png" /><font>道具</font></span> 
     </div> 
    </div> 
    
    
    <!-- 种子栏 --> 
    <div class="scroll" style="margin:0 auto;width:550px;" id="scroll"> 
     <!-- "prev page" link --> 
     <a class="prev" href="#"></a> 
     <div class="box"> 
      <div class="scroll_list"> 
       <ul id="framseed"> 
       </ul> 
      </div> 
     </div> 
     <!-- "next page" link --> 
     <a class="next" href="#"></a> 
    </div> 
    <!-- 工具栏 --> 
    <div class="scroll" style="margin:0 auto;width:550px;" id="scrolls"> 
     <!-- "prev page" link --> 
     <a class="prev" href="#"></a> 
     <div class="box"> 
      <div class="scroll_list"> 
       <ul id="tool"> 
        
       </ul> 
      </div> 
     </div> 
     <!-- "next page" link --> 
     <a class="next" href="#"></a> 
    </div> 
    
    
<div id="rightcenter" style="width: 30px; display: block;">
<div class="friendiv">
<span class="clickfriend">
<input type="hidden" id="friendflag" value="0"></span>
我的直推人数：<span id="mysort"><?php echo ($count); ?></span><br>
<input type="text" size="17" style="height:16px" id="friendname" onkeyup="">
    <img src="/Public/images/home/search.png" style="vertical-align: top; cursor: pointer"  onclick="search()" ><br>
<div id="sortmenu">
<input id="act" type="hidden">
<input id="ordertype" type="hidden">
<span style="background: #fff2d7">
<a style="color: #897654" onclick="userlevellist('1')">我的直推</a></span>
<span><a onclick="friends('1')">我的好友</a></span>
<!--<span><a onclick="">按金钱</a></span>-->
</div>
<div id="out">
<div id="insul">
<table width="100%">
<tbody id='tbody'>
</tbody>
</table>
</div>
<div id="insulbottom">
</div>
</div>
</div>
</div>
   </div> 
  </div>
   
</body>
</html>