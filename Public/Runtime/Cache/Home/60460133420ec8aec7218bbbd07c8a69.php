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
#ulmenu  .open { background: url(/Public/images/home/shop/select.png) no-repeat;}
#ranking_gfarm .m_c{background:url(/Public/images/home/ranking/bg-mid.png) no-repeat;}
</style>
<!----排行榜start------>
<div id="ranking_gfarm" class="fwinmask" style=" position: fixed;z-index: 201;top: 0;bottom: 0;" initialized="true">
<table cellpadding="0" cellspacing="0" class="fwin">
<tbody>
        <tr>
            <td class="t_l"></td>
            <td class="t_c" style="cursor:move" onmousedown="" ondblclick=""></td>
<td class="t_r"></td>
        </tr>
        <tr>
            <td class="m_l" style="cursor:move" >&nbsp;&nbsp;</td>
            <td class="m_c" id="fwin_content_gfarm" fwin="gfarm">
<div class="depotclass" onmousedown="">
<div class="depotclose" onclick="close_ifrme();"></div>
<img src="/Public/images/home/ranking/rankt.png" class="depottitle">
<ul class="line listti" id="ulmenu" fwin="gfarm">
<li class="open"><a href="javascript:;" onclick="" class="">等级</a></li>
<!--<li><a href="javascript:;" onclick="">农场币</a></li>
<li><a href="javascript:;" onclick="">爱心</a></li>-->
</ul>

<div id="rankcontent" fwin="gfarm"  class="ranking_cntorder">
<div class="ranknum">您当前排名为：<span id="userrank"></span></div>
<div class="rankinfo">
<table id="ranktable" fwin="gfarm">
<tbody id="tbodys">

</tbody>
</table>
<div class="rankbottom">
</div>
</div>
</div>





</div>

</td>
<td class="m_r" style="cursor:move" ></td></tr><tr><td class="b_l"></td>
<td class="b_c" style="cursor:move" onmousedown="" ondblclick="">   </td>
<td class="b_r"></td>
</tr>
</tbody>
</table>
</div>
   
<!----排行榜end-------->  


<script type="text/javascript"> 
//选项卡切换 
$(function () { 
$("#ulmenu li ").click(function () { 
var index_tab = $(this).parent().children().index($(this)); //选项卡的索引值 
$(this).parent().find(".open").removeClass("open").addClass("close"); //选项卡背景处理 
$(this).removeClass("close").addClass("open"); 

//排行榜选项卡切换
var rankcontent_obj = $(".ranking_cntorder"); //内容节点 
rankcontent_obj.hide(); 
rankcontent_obj.eq(index_tab).show(); 
}); 
}); 
</script>