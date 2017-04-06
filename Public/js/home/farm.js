
function layer_page(w, h, title, url) {
    if (title == null || title == '') {
        title = false;
    }
    ;
    if (url == null || url == '') {
        url = "404.html";
    }
    ;
    if (w == null || w == '') {
        w = 800;
    }
    ;
    if (h == null || h == '') {
        h = ($(window).height() - 50);
    }
    ;

    layer.open({
        offset: '100px',
        type: 2,
        area: [w + 'px', h + 'px'],
        fix: false, //不固定
        shade: false,
        title: false,
        content: url,
        closeBtn: 0,
        maxmin: false,
        skin: 'layui-layer1',
    });

}

function  close_ifrme() {

    var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
    parent.layer.close(index);
}
var url = 'http://192.168.1.86';

/*点击工具栏改变鼠标样式*/
var imgsrc = url + '/Public/images/home';
function mico(ico, type) {
    msico = ico;
    if (type != 2 && type != 4) {
        if (type == 1) {
            $("#body").css({cursor: "url('" + imgsrc + "/" + msico + ".ico'),auto "});
        } else {
            $("#body").css({cursor: "url('" + imgsrc + "/" + msico + ".ico'),auto "});
        }
    }
    $.cookie("tooltype", type);
}

function onclickevent(obj, type) {

    var data;
    var relust;

    var tooltype = $.cookie("tooltype");

    if (tooltype == 1) {
       
        data = {framlandtype: type};
        relust = ajax('/Home/Index/plowing', data);
        if (relust.status == 1) {//翻地
          //  $(obj).css("background-image", 'url(' + imgsrc + '/dibg01.png)');
          //  $(obj).children("img").remove();
          //  $(obj).children(".diinfo").remove();
            autotime();
            showImg("<img src='"+imgsrc+"/shovel.png' style='width:48px;height:48px;left:0px;top:0px;'/>",type,'-42px');
      
            msg(relust.msg, type);
        } else if (relust.status == 3) {//开垦
            layer.confirm(relust.msg, {
                btn: ['开垦', '取消'] //按钮
            }, function () {

                data = {framlandtype: type, reclaim: 1};
                relust = ajax('/Home/Index/plowing', data);
                if (relust.status == 1) {
                   // $(obj).css("background-image", 'url(' + imgsrc + '/dibg01.png)');
                    //$(obj).children("img").remove();
                    //$(obj).children(".diinfo").remove();
                    autotime() ;
                    msg(relust.msg, type);
                     showImg("<img src='"+imgsrc+"/shovel.png' style='width:48px;height:48px;left:0px;top:0px;'/>",type,'-42px');
      
                    $("#usermoney").html($("#usermoney").html() -relust.money);
                    
                } else {
                    msg(relust.msg, type);
                }
                layer.closeAll('dialog');
            }, function () {

            });
        } else {
            msg(relust.msg, type);
        }

    } else if (tooltype == 2) {
        var planttype = $.cookie("planttype");
        if (planttype > 0) {
            data = {type: planttype, framlandtype: type};
            relust = ajax('/Home/Index/plant', data);
            if (relust.status == 1) {
                $(obj).append("<img src=\"" + imgsrc + "/shu0.png\">");
                $(obj).append("<div class=\"diinfo\" style=\"opacity: 0;\"> " + relust.title + " <br/>" + relust.hour + "小时后成熟 <br />总：" + relust.fruitnumber + " 余："+relust.fruitbalance+"</div>");
                msg(relust.msg, type);
                var num = Number($("#plantdiv" + planttype).html());
                if (num - 1 <= 0) {
                    $("#plantli" + planttype).remove();

                } else {
                    $("#plantdiv" + planttype).html(num - 1);
                }

            } else {
                msg(relust.msg, type);
            }
        } else {
            msg('请先选择种子', type);
        }

    } else if (tooltype == 3) {
        data = {framlandtype: type};
        relust = ajax('/Home/Index/pick', data);
        if (relust.status == 1) {
            $(obj).css("background-image", 'url(' + imgsrc + '/dibg01.png)');
            $(obj).children("img").attr("src", imgsrc + '/shu6.png');
            $(obj).children(".diinfo").remove();
            
           

            $("#integral").html(Number($("#integral").html()) + Number(relust.integral));
            $("#experience").html(Number($("#experience").html()) + Number(relust.experience));
            $("#fruitbalance").html(Number($("#fruitbalance").html()) + Number(relust.fruitbalance));
            
            showImg("<img src='"+imgsrc+"/hand.png' style='width:48px;height:48px;left:0px;top:0px;'/>",type,'10px'); 
            
            text('果实+'+relust.fruitbalance, type);
        } else if (relust.status == 3) {
            //升级
            $(obj).css("background-image", 'url(' + imgsrc + '/dibg01.png)');
            $(obj).children("img").attr("src", imgsrc + '/shu6.png');
            $(obj).children(".diinfo").remove();
           
           

            $("#integral").html(Number($("#integral").html()) + Number(relust.integral));
            $("#experience").html(Number($("#experience").html()) + Number(relust.experience));
            $("#fruitbalance").html(Number($("#fruitbalance").html()) + Number(relust.fruitbalance));
            $("#userlevel").html(relust.title);
            $("#upexperience").html(relust.upexperience);
            
            showImg("<img src='"+imgsrc+"/hand.png' style='width:48px;height:48px;left:0px;top:0px;'/>",type,'10px'); 
            
            text(relust.fruitbalance, type);
        } 
        else if(relust.status == 4){
            //偷取成功
            //刷新田地
             autotime();
            
             $("#fruitbalance").html(Number($("#fruitbalance").html()) + Number(relust.fruitbalance));
             
            
             
            text(relust.msg, type); 
            
            showImg("<img src='"+imgsrc+"/hand.png' style='width:48px;height:48px;left:0px;top:0px;'/>",type,'10px');
            
        }
        else {
            //错误提示
            msg(relust.msg, type);
        }

    } else if (tooltype == 4) {
        var tool = $.cookie("tool");//选中的道具
        if (tool > 0) {
            data = {framlandtype: type, tool: tool};
            relust = ajax('/Home/Index/usetool', data);
            if (relust.status == 1) {
                $('#shifei').remove();
                $(obj).append("<div id=\"shifei\" style=\"display: none;\"><img style=\"width: 0px;\" src=\"" + imgsrc + "/huafei.png\" /></div>");
                shifei();
                msg(relust.msg, type);
                var num = Number($("#tooldiv" + tool).html());
                if (num - 1 <= 0) {
                    $("#toolli" + tool).remove();

                } else {
                    $("#tooldiv" + tool).html(num - 1);
                }
                autotime();
            } else {
                msg(relust.msg, type);
            }

        } else {
            msg('请先选择道具', type);
        }
    } else {

        layer.msg('请先选择操作工具', {icon: 2, time: 1500}, function () {});
    }


}


$(document).ready(function () {
    userlevellist(1);
    ranking(1);
    depot(1);

    $('#friendname').blur(function () {
        search();
    });
    window.onload = function () {
        autotime();
        $(".gaidiv").css({display: "none"});
        $("#load").css({display: "none"});
    };


    window.onbeforeunload = function () {
        $.cookie('tooltype', null);
        $.cookie("planttype", null);
    }




});

function autotime() {
    var data = {p: '1'};
    var relust = ajaxpage('/Home/Index/lands', data);
    $("#land").empty();
    $("#land").append(relust.list);
    $(".diinfo").fadeTo("fast", 0.0);
    $(".di").hover(
            function () {
                $(this).find(".diinfo").fadeTo("fast", 0.8);
            },
            function () {
                $(this).find(".diinfo").fadeTo("fast", 0.0);
            });
}

function  shifei() {
    $("#shifei").fadeTo(1000, 1);
    $("#shifei img").animate({height: "100px", width: "100px", marginTop: "0px"}, 80, function () {
        $("#shifei img").animate({marginTop: "0px"}, 50);
    });
    $("#shifei").fadeTo(1000, 0.0, function () {
        $("#shifei").css({display: "none"});

    });
}

function text(msg, type) {

    temobj = $("#di" + type).find(".zeng");
    temobj.html(msg);
    temobj.fadeTo(100, 0.9);
    temobj.animate({top: "-6px"}, 400);
    temobj.fadeTo(1100, 0.0);
}
function msg(msg, type) {

    temobj = $("#di" + type).find(".msg");
    temobj.html(msg);
    temobj.fadeTo(50, 0.9);
    temobj.animate({top: "0px"}, 400);
    temobj.fadeTo(900, 0.0);
}
function ajax(url, data) {
    var relust
    $.ajax({
        type: "Post",
        url: url,
        data: data,
        dataType: 'json',
        async: false, //设置为同步操作就可以给全局变量赋值成功 
        success: function (response) {
            return relust = response;
        }
    });
    return relust;
}

function basket() {
    //
    var display = $('#scroll').css('display');
    var scrolls = $('#scrolls').css('display');
    if (display == 'none') {
        if (scrolls == 'block')
            $('#scrolls').hide();

        mico('jiaico', 2);
        $("#scroll").show();
        //
        var data = {id: null};
        var relust = ajaxpage('/Home/Index/framseed', data);
        $("#framseed").empty();
        if (relust.list.length != 0) {
            $("#framseed").append(relust.list);
        } else {
            $("#framseed").append("<li style=\'border:0px;text-align:center;width:300px;height:50px;line-height:50px;color:#fff; background:0 0\'>没有种子，到商店瞧瞧吧</li>");
        }

    } else {
        if (scrolls == "block")
            $("#scrolls").hide();

        $.cookie('tooltype', null);
        $.cookie("planttype", null);
        $("#body").css("cursor", "default");
        $("#scroll").hide();
    }
}

function tool() {

    var display = $('#scroll').css('display');
    var scrolls = $('#scrolls').css('display');
    if (scrolls == 'none') {
        if (display == "block")
            $("#scroll").hide();

        mico('hfico', 4);
        $("#scrolls").show();

        var data = {id: null};
        var relust = ajaxpage('/Home/Index/tool', data);
        $("#tool").empty();
        if (relust.list.length != 0) {//有没有数据
            $("#tool").append(relust.list);
        } else {
            $("#tool").append("<li style=\'border:0px;text-align:center;width:300px;height:50px;line-height:50px;color:#fff; background:0 0\'>没有道具，到商店瞧瞧吧</li>");
        }

    } else {
        $.cookie('tooltype', null);
        $.cookie("tool", null);
        $("#body").css("cursor", "default");
        if (display == "block")
            $("#scroll").hide();
        $("#scrolls").hide();
    }
}
function tooltype(planttype) {
    $.cookie("tool", planttype);
    $.cookie("tooltype", 4);
    data = {tooltype: planttype};
    relust = ajax('/Home/Index/tooltype', data);
    if (relust.status == 1) {
        $("#body").css({cursor: "url('" + url + "/" + relust.ico + "'),auto "});

    } else {
        layer.msg(relust.msg, {icon: 2, time: 1500}, function () {});
    }
}

function buybasket(type) {
    //

    var obj = parent;
    if (type == 1) {//种子栏
        var display = $('#scroll').css('display');
        if (display != 'none') {
            var objs = obj.parent.$("#framseed");
            var data = {id: null};
            var relust = ajaxpage('/Home/Index/framseed', data);
            objs.empty();
            objs.append(relust.list);
        }
    } else if (type == 2) {//工具栏
        var scrolls = $('#scrolls').css('display');
        if (scrolls != 'none') {
            var objs = obj.parent.$("#tool");
            var data = {id: null};
            var relust = ajaxpage('/Home/Index/tool', data);
            objs.empty();
            objs.append(relust.list);
        }
    }
}

function plant(planttype) {
    $.cookie("planttype", planttype);
    $.cookie("tooltype", 2);
    var msico = 'jiaico';
    $("#body").css({cursor: "url('" + imgsrc + "/" + msico + ".ico'),auto "});
}

function ajaxpage(url, data) {
    var relust
    $.ajax({
        type: "get",
        url: url,
        data: data,
        dataType: 'json',
        async: false, //设置为同步操作就可以给全局变量赋值成功 
        success: function (response) {
            return relust = response;
        }
    });
    return relust;
}
function userlevellist(page) {
    var data = {p: page};
    var relust = ajaxpage('/Home/Index/userlevellist', data);
    $("#tbody").empty();
    $("#tbody").append(relust.list);
    $("#insulbottom").empty();
    $("#insulbottom").append(relust.page);

}

function friends(page) {
    var data = {p: page};
    var relust = ajaxpage('/Home/Index/friends', data);
    $("#tbody").empty();
    $("#tbody").append(relust.list);
    $("#insulbottom").empty();
    $("#insulbottom").append(relust.page);

}

function ranking(page) {
    var data = {p: page};
    var relust = ajaxpage('/Home/Index/ranking', data);
    $("#tbodys").empty();
    $(".rankbottom").empty();
    $("#userrank").empty();
    $("#tbodys").append("<tr class=\"thead\">"
            + "<td width=\"13%\">NO</td>"
            + "<td width=\"13%\">排名</td>"
            + "<td width=\"46%\">用户</td>"
            + "<td>等级</td>"
            + "</tr>"
            + "");
    $("#tbodys").append(relust.list);
    $(".rankbottom").append(relust.page);
    $("#userrank").append(relust.rank);


}
function search() {
    var username = $.trim($("#friendname").val());
    if (username.replace(/\s/g, "") == null || username == "") {
        userlevellist(1);
    } else {
        var data = {username: username};
        var relust = ajax('/Home/Index/search', data);
        $("#tbody").empty();
        $("#tbody").append(relust.list);
        $("#insulbottom").empty();
    }

}
function buy(type, money) {
    var number = $.trim($(".number").val());
    var data = {number: number, type: type};
    var relust = ajax('/Home/Index/buy', data);
    if (relust.status == 1) {
        layer.msg(relust.msg, {icon: 1, time: 1500}, function () {
            var obj = parent;

            obj.parent.$("#usermoney").html(obj.parent.$("#usermoney").html() - money * number);

            buybasket(relust.type);
        });
    } else {
        layer.msg(relust.msg, {icon: 2, time: 1500}, function () {});
    }
}
function depot(page) {
    var data = {p: page};
    var relust = ajaxpage('/Home/Index/depot', data);
    $("#ul3").empty();
    $("#ul3").append(relust.list);
    $("#totalmoney").empty();
    $("#totalmoney").append(relust.totalmoney);
    parent.$("#usermoney").empty();
    parent.$("#usermoney").append(relust.principal);
    parent.$("#fruitbalance").empty();
    parent.$("#fruitbalance").append(relust.fruitbalance);
}
function depots(page) {
    var data = {p: page};
    var relust = ajaxpage('/Home/Index/depot', data);
    parent.$("#ul3").empty();
    parent.$("#ul3").append(relust.list);
    parent.$("#totalmoney").empty();
    parent.$("#totalmoney").append(relust.totalmoney);
    parent.parent.$("#usermoney").empty();
    parent.parent.$("#usermoney").append(relust.principal);
    parent.parent.$("#fruitbalance").empty();
    parent.parent.$("#fruitbalance").append(relust.fruitbalance);
}

function lock(obj, id) {
    var data = {id: id};
    var relust = ajaxpage('/Home/Index/lock', data);
    if (relust.status == 1) {
        $(obj).css("background-image", 'url(' + imgsrc + '/shop/lock.png)');
    } else {
        $(obj).css("background-image", 'url(' + imgsrc + '/shop/jiesuo.png)');

    }
}
function lockone(id) {
    var data = {id: id};
    var relust = ajaxpage('/Home/Index/lock', data);
    if (relust.status == 1) {
        $(".lockbutton").empty();
        $(".lockbutton").append("<span id=\"suo\" fwin=\"gfarm1\">\n\<img src=\"/Public/images/home/shop/lock.png\" style=\"vertical-align: bottom\" />\n\已锁定<a onclick=\"lockone(" + id + ")\">解锁</a> \n\</span> ");
        parent.$("#lock_" + id).css("background-image", 'url(' + imgsrc + '/shop/lock.png)');
    } else {
        $(".lockbutton").empty();
        $(".lockbutton").append("<span id=\"suo\" fwin=\"gfarm1\">\n\<img src=\"/Public/images/home/shop/jiesuo.png\" style=\"vertical-align: bottom\" />\n\未锁定<a onclick=\"lockone(" + id + ")\">锁定</a> \n\</span> ");
        parent.$("#lock_" + id).css("background-image", 'url(' + imgsrc + '/shop/jiesuo.png)');
    }
}
function locktotal() {
    var data = {id: null};
    var relust = ajax('/Home/Index/locktotal', data);
    if (relust.status == 1) {
        layer.msg(relust.msg, {icon: 1, time: 1500}, function () {
            depot(1);
        });
    }


}
function sell(id) {
    var number = $(".number").val();
    var data = {id: id, number: number};
    var relust = ajax('/Home/Index/sell', data);
    if (relust.status == 1) {
        layer.msg(relust.msg, {icon: 1, time: 1500}, function () {
            depots(1);
        });
    } else {
        layer.msg(relust.msg, {icon: 2, time: 1500}, function () {});
    }
}

function selltotal() {
    var data = {id: null};
    var relust = ajax('/Home/Index/totalsell', data);
    if (relust.status == 1) {
        layer.msg(relust.msg, {icon: 1, time: 1500}, function () {
            depot(1);
        });
    } else {
        layer.msg(relust.msg, {icon: 2, time: 1500}, function () {});
    }
}
function showImg(src,type,px){
temobj = $("#di"+type).find(".ico");
temobj.html(src);
temobj.fadeTo(120,0.9);
temobj.animate({top:px},500);
temobj.fadeTo(1100,0.0)	;
			
}