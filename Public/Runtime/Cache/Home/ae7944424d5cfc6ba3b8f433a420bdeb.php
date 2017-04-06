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
<script type="text/javascript">
    $(document).ready(function() { 
        buynum();
    });
    function buynum(){
         var number = $.trim($(".number").val());
         var money = $.trim($(".money").val());
       var total=number*money;
        $('#dprice').html(total);
    }
    
</script>
 </head>
 <body>
<!----购买商品start---->
<div id="fwin_gfarm3" class="fwinmask" style="position: fixed;    z-index: 201;top: 0px;bottom: 0px;" initialized="true">
<table cellpadding="0" cellspacing="0" class="fwin"><tbody><tr><td class="t_l"></td><td class="t_c" style="cursor:move" onmousedown="" ondblclick=""></td>
<td class="t_r"></td></tr><tr><td class="m_l" style="cursor:move" onmousedown="" ondblclick="">&nbsp;&nbsp;</td>
<td class="m_c" id="fwin_content_gfarm1" fwin="gfarm1">

<style>
#fwin_gfarm3 .m_c{background:url(/Public/images/home/shop/seed.png) no-repeat;}
</style>
<div style="padding:5px 10px;text-align: left;width: 380px;height: 301px;position: relative;" onmousedown="">
<div class="shopclose" onclick="close_ifrme();"></div>
<form id="shopbuyform" action="" method="post" target="myframe" fwin="gfarm1">
<div style="text-align: center;height: 170px;margin-top: 20px">	
<div style="float: left;width: 120px;color: #aaa;font-size: 12px;padding-left: 25px;padding-top: 40px">
<img src="/<?php echo ($row["large"]); ?>" width="120px" height="120px">
<input type="hidden" value="<?php echo ($row["money"]); ?>" class="money" >
<input type="text" name="dnum" id="dnum" size="5" value="1" onchange="buynum()" onpaste="this.value=this.value.replace(/\D/g,'')" style="text-align: center;ime-mode:disabled;margin-top: 10px;height: 14px;" fwin="gfarm1" class="number"><br>
剩余数量(不限)
</div>
<div style="float: right;width: 210px;background: url(/Public/images/home/shop/bgpage.png) no-repeat;height: 170px;margin-top:  30px;padding-top: 20px">
<font style="font-size: 17px;color: #7e4d06;margin-left: 10px;" class="listti"><?php echo ($row["title"]); ?></font>
<div style="text-align: left;width:200px;padding-left: 40px;padding-top: 5px;line-height: 20px;color: #a17e4f">
<div>
<span>使用等级：</span>
<span><font color="#7e4d06" style="margin-left: 5px"><?php echo ($row["level"]); ?></font></span>
</div>
<div>
<span>成熟时间：</span>
<span><font color="#7e4d06" style="margin-left: 5px"><?php echo ($row["hour"]); ?>小时</font></span>
</div>
<div>
<span>获得积分：</span>
<span><font color="#7e4d06" style="margin-left: 5px"><?php echo ($row["integral"]); ?></font></span>
</div>
<div>
<span>获得经验：</span>
<span><font color="#7e4d06" style="margin-left: 5px"><?php echo ($row["experience"]); ?></font></span>
</div>
			
<div>			
<span>单价：</span>
<span><font color="red"><img title="" src="/Public/images/home/shop/money-1.png"></font><font color="#7e4d06" style="margin-left: 5px"><?php echo ($row["money"]); ?></font></span>
</div>
<div>
<span>总计：</span>
<span><font color="red"><img title="" src="/Public/images/home/shop/money-1.png"></font><font id="dprice" color="#7e4d06" style="margin-left: 5px" fwin="gfarm1"></font></span>
</div>
</div>
</div>
</div>
<div class="shopbuy">
<img src="/Public/images/home/shop/yesbuy.png" onclick="buy(<?php echo ($row["id"]); ?>,<?php echo ($row["money"]); ?>)">
<img src="/Public/images/home/shop/nobuy.png" style="margin-left: 20px" onclick="close_ifrme();">
</div>
</form>
</div>
</td><td class="m_r" style="cursor:move"  ></td></tr><tr><td class="b_l"></td>
<td class="b_c" style="cursor:move" ></td><td class="b_r"></td></tr></tbody></table>
</div>

<!----购买商品end------>
 </body>
</html>