<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">  

            <link rel="stylesheet" type="text/css" href="/Public/style/home/base.css" >
                <link rel="stylesheet" type="text/css" href="/Public/style/home/framework.css">
                    <script type="text/javascript" src="/Public/js/home/jquery.js"></script>
                    <script type="text/javascript" src="/Public/H-ui/lib/layer/2.1/layer.js"></script>
                    <title></title>
                    <script type="text/javascript">
                        $(function () {
                            $('.main_left h3').click(function () {
                                $(this).siblings('div').toggle('fast', 'linear').parent('li').siblings('li').children('div').hide('fast', 'linear');
                            });
                            $('.header_nav a').click(function () {
                                $(this).addClass('hot').siblings('a').removeClass('hot');
                            });
                        });
                    </script>

                    <style type="text/css">
                        .userInfo {position:absolute;bottom:0px;left:0;max-width:700px;overflow:hidden;}
                        .userInfo span {display:inline-block;padding:10px 20px;color:#414141;font-size:16px; }
                    </style>

                    </head>

                    <body >
                        <div style="background:url(/Public/images/home/bg.jpg)  no-repeat center; background-size: cover; /*display: inline-block;*/">
                            <!--头部-->

                            <div class="main_top">

                                <div class="header">

                                    <div class="viewport admin_bg">

                                        <!--<img src="/Public/images/home/admin_logo.png" alt="logo" />
                                        -->
                                        <div class="userInfo">

                                            <img src="/Public/images/home/logo2.png" alt="logo"/>

                                            <!--<span>姓名：test666</span>
                            
                                            <span>用户名:test666</span>
                            
                                            <span>级别：
                            
                                                                                            二星会员				</span>
                            
                                            <span>状态：正常</span>-->

                                        </div>  
                                        <span style="    position: absolute; left: 300px;top: 25px; color: #fff;">
                                            玩法：充值-购买种子-（开垦土地）种植-成熟（收获）-（仓库）卖出-提现
                                        </span>

                                        <div class="header_nav">

                                            <a class="hot"  href="<?php echo U('Index/fram');?>" target="container"><i class="icon-user"> </i> 我的农场</a>
                                            <a class="hot"  href="<?php echo U('Home/Article/toziguizelist');?>" target="container"><i class="icon-help"> </i> 游戏帮助</a>
                                            <a class="hot"  href='javascript:onclick=logout();' target="container"><i class="icon-logout2"> </i> 安全退出</a>
                                            <!--<a class="hot"  href="<?php echo U('Home/index/fram');?>" target="container"><i class="icon-gameset"> </i> 游戏设置</a>-->
                                            <!--<a class="hot"  href="<?php echo U('Home/Article/toziguizelist');?>" target="container"><i class="icon-jifen"> </i> 积分兑换</a>-->
                                            <!--<a class="hot"  href="<?php echo U('Home/Article/toziguizelist');?>" target="container"><i class="icon-help"> </i> 游戏帮助</a>-->
                                            <!--<a  class="hot" href="<?php echo U('Home/index/fram');?>" target="container"><i class="icon-upgrade"> </i> VIP升级</a>-->

                                            <!--  <a   href='/index.php/member/Index/notice.html' target="container">通知公告</a>-->

                                            <!--<a  class="hot"  href='javascript:onclick=logout();'><i class="icon-logout2"> </i>  安全退出</a>-->

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!--头部End-->
                            <!--中间-->
                            <div class="viewport" style="overflow: hidden;padding: 10px 0px; height: 724px;">
                                <!--左边菜单栏-->

                                <div class="main_left" id="main_left">

                                    <ul>
                                        <li>
                                            <h3><i class="icon-home"></i> 市场开拓</h3>
                                            <div>
                                                <a href="<?php echo U('Member/userlist');?>" target="container">会员列表<i class="icon-jt"></i></a>
                                                <a href="<?php echo U('Reg/index');?>" target="container">注册会员<i class="icon-jt"></i></a>
                                                <a href="<?php echo U('Member/listcontactman');?>" target="container">团队列表<i class="icon-jt"></i></a>
                                                <a href="<?php echo U('Member/friends');?>" target="container">添加好友<i class="icon-jt"></i></a>
                                                <a href="<?php echo U('Reg/fenxianglianjie');?>" target="container">分享链接<i class="icon-jt"></i></a>
                                            </div>

                                        </li>

                                        <li>
                                            <h3><i class="icon-setting"></i> 基本信息</h3>
                                            <div style="display: none;">
                                                <a href="<?php echo U('Member/userinfo');?>" target="container">个人信息<i class="icon-jt"></i></a>
                                                <a href="<?php echo U('Member/changepwd');?>" target="container">修改密码<i class="icon-jt"></i></a>
                                            </div>

                                        </li>
                                        <li>
                                            <h3 class="tixian"><i class="icon-cz"></i>充值投资</h3>
                                            <div style="display: none;">
                                                <a href="/index.php/Home/Report/renminbichongzhi.html" target="container" style="color:red;">我要充值</a>
                                                <a href="/index.php/Home/Report/chongzhilist.html" target="container">充值记录</a>

                                            </div>
                                        </li>
                                        <li>
                                            <h3 class="caiwu"><i class="icon-tx"></i>我要提现</h3>
                                            <div style="display: none;">
                                                <a href="/index.php/Home/Report/reminbitixian.html" target="container" style="color:red;">收益提现</a>
                                                <a href="/index.php/Home/Report/tixianlist.html" target="container">提现记录</a>
                                            </div>
                                        </li>
                                        <li>
                                            <h3><i class="icon-briefcase"></i> 财务管理</h3>
                                            <div style="display: none;">

                                                <a href="/index.php/Home/Report/zijinlist.html" target="container">资金明细</a>
                                                <a href="/index.php/Home/Farm/grow.html" target="container">种植记录</a>
                                                <a href="/index.php/Home/Farm/pick.html" target="container">摘取记录</a>
                                                <a href="/index.php/Home/Farm/steal.html" target="container">被摘记录</a>

                                            </div>
                                        </li>
                                        <li>

                                            <h3><i class="icon-write"></i> 留言反馈</h3>
                                            <div style="display: none;">

                                                <!--<a href="/index.php/member/index/contribute.html" target="container">提供帮助<i class="icon-jt"></i></a>
                        
                                                <a href="/index.php/member/index/sell.html" target="container">接受帮助<i class="icon-jt"></i></a>-->

                                                <a href="<?php echo U('Message/messageadd');?>" target="container">发件箱<i class="icon-jt"></i></a>

                                                <a href="<?php echo U('Message/index');?>" target="container">信件箱<i class="icon-jt"></i></a>
                                            </div>

                                        </li>
                                        <!--<li>
                        
                                            <h3>短信中心</h3>
                        
                                            <div style="display: none;">
                        
                                                <a href="/index.php/member/member/addsend.html" target="container">发件箱<i class="icon-jt"></i></a>
                        
                                                <a href="/index.php/member/index/receive.html" target="container">信件箱<i class="icon-jt"></i></a>
                        
                                                
                        
                                            </div>
                        
                                        </li>-->
                                        <li>
                                            <h3><i class="icon-gg"></i> 通知公告</h3>

                                            <div style="display: none;"> 
                                                <a href="<?php echo U('Article/toziguizelist');?>" target="container">游戏帮助<i class="icon-jt"></i></a>
                                                <a href="<?php echo U('Article/newslist');?>" target="container">公告列表<i class="icon-jt"></i></a>
                                            </div>

                                        </li>
                                        <li>
                                            <h3  onclick='logout()'><i class="icon-logout"></i> 安全退出</h3>
                                            <div style="display: none;">
                                            </div>

                                        </li>
                                    </ul>



                                </div>

                                <!--左边菜单栏End-->



                                <!--右边内容区-->

                                <div class="main_container" >

                                    <iframe id="container" src="<?php echo U('index/fram');?>" name="container" marginheight="0" marginwidth="0" frameborder="0" scrolling="no" style="overflow-x:hidden;width:100%;"  ></iframe> 
                                </div>

                                <!--右边内容区End-->

                                <script type="text/javascript" language="javascript">
                                    function iFrameHeight() {
                                        var ifm = document.getElementById("container");
                                        var ifm2 = document.getElementById("main_left");
                                        var subWeb = document.frames ? document.frames["container"].document : ifm.contentDocument;
                                        if (ifm != null && subWeb != null) {
                                            ifm.height = subWeb.body.scrollHeight;
                                            $('#main_left').height(subWeb.body.scrollHeight);
                                        }
                                    }
                                </script> 

                            </div>

                            <!--中间End-->

                            <!--底部-->


                            <!--底部-->
                        </div>

                    </body>

                    </html>
                    <script type="text/javascript">
                        function logout() {
                            if (confirm("您确定要退出吗?") == true) {
                            location.href = '<?php echo U('Login/logout');?>';
                            }
                        }
                 

                    </script>