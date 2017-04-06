

/*弹出层*/
/*
 参数解释：
 title	标题
 url		请求的url
 id		需要操作的数据id
 w		弹出层宽度（缺省调默认值）
 h		弹出层高度（缺省调默认值）
 */
function layer_show(w, h, title, url) {
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
        type: 2,
        area: [w + 'px', h + 'px'],
        fix: false, //不固定
        shade: 0.4,
        title: title,
        content: url,
        //skin: 'home-class',
        maxmin: false,
    });

}




//弹窗
function showPage(w, h, title, url) {

    layer_show(w, h, title, url);


}
function  close_ifrme() {

    var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
    parent.layer.close(index);
}
function passwordedit_save()
{
    layer.confirm('确定要修改密码？', function (index) {
        var type = $('.type').val();
        var token = $("input[name='token']").val();
        var oldpassword = $('.oldpassword').val();
        var newpassword = $('.newpassword').val();
        $.ajax({
            type: "post",
            url: "/Home/Member/changepwd",
            data: {type: type, token: token, oldpassword: oldpassword, newpassword: newpassword},
            dataType: 'json',
            async: false, //设置为同步操作就可以给全局变量赋值成功 
            success: function (data) {
                if (data.status == 1)
                {
                    layer.msg(data.msg, {icon: 1, time: 1500}, function () {

                        location.replace(location.href);
                    });

                } else
                {
                    layer.msg(data.msg, {icon: 2, time: 1500}, function () {

                        location.replace(location.href);


                    });
                }
            }
        });
    });
}

function addbank() {

    var token = $("input[name='token']").val();
    var name = $('.name').val();
    var towpassword = $('.towpassword').val();
    var bankno = $('.bankno').val();
    var type = $('.type').val();
    var kaihubank=$('.kaihubank').val();
    $.ajax({
        type: "post",
        url: "/Home/Member/addbank",
        data: {
            token: token, type: type, towpassword: towpassword,
            name: name,bankno:bankno,kaihubank:kaihubank},
        dataType: 'json',
        async: false, //设置为同步操作就可以给全局变量赋值成功 
        success: function (data) {
            if (data.status == 1)
            {
                layer.msg(data.msg, {icon: 1, time: 1500}, function () {

                    location.replace(location.href);
                });

            } else
            {
                layer.msg(data.msg, {icon: 2, time: 1500}, function () {

                    location.replace(location.href);


                });
            }
        }
    });

}

function addfriends() {

    var token = $("input[name='token']").val();
    var username = $('.username').val();
    var towpassword = $('.towpassword').val();
 
    $.ajax({
        type: "post",
        url: "/Home/Member/addfriends",
        data: {
            token: token, towpassword: towpassword,
            username: username,},
        dataType: 'json',
        async: false, //设置为同步操作就可以给全局变量赋值成功 
        success: function (data) {
            if (data.status == 1)
            {
                layer.msg(data.msg, {icon: 1, time: 1500}, function () {

                    location.replace(location.href);
                });

            } else
            {
                layer.msg(data.msg, {icon: 2, time: 1500}, function () {

                    location.replace(location.href);


                });
            }
        }
    });

}

function allow(id){
     $.ajax({
        type: "post",
        url: "/Home/Member/allow",
        data: { id: id},
        dataType: 'json',
        async: false, //设置为同步操作就可以给全局变量赋值成功 
        success: function (data) {
            if (data.status == 1)
            {
                layer.msg(data.msg, {icon: 1, time: 1500}, function () {

                    location.replace(location.href);
                });

            } else
            {
                layer.msg(data.msg, {icon: 2, time: 1500}, function () {

                    location.replace(location.href);


                });
            }
        }
    });
    
}
function refuse(id){
     $.ajax({
        type: "post",
        url: "/Home/Member/refuse",
        data: { id: id},
        dataType: 'json',
        async: false, //设置为同步操作就可以给全局变量赋值成功 
        success: function (data) {
            if (data.status == 1)
            {
                layer.msg(data.msg, {icon: 1, time: 1500}, function () {

                    location.replace(location.href);
                });

            } else
            {
                layer.msg(data.msg, {icon: 2, time: 1500}, function () {

                    location.replace(location.href);


                });
            }
        }
    });
    
}

function register() {

    var token = $("input[name='token']").val();
    var username = $('.username').val();
    var password = $('.password').val();
    var name = $('.name').val();
    var mobile = $('.mobile').val();
    var code = $('.code').val();
    $.ajax({
        type: "post",
        url: "/Home/Reg/register",
        data: {
            token: token, username: username, password: password,
            name: name,mobile: mobile,code: code },
        dataType: 'json',
        async: false, //设置为同步操作就可以给全局变量赋值成功 
        success: function (data) {
            if (data.status == 1)
            {
                layer.msg(data.msg, {icon: 1, time: 1500}, function () {

                    location.replace(location.href);
                });

            } else
            {
                layer.msg(data.msg, {icon: 2, time: 1500}, function () {

                    location.replace(location.href);


                });
            }
        }
    });

}
function reg() {

    var token = $("input[name='token']").val();
    
    var username = $('.username').val();
    var password = $('.password').val();
    var name = $('.name').val();
    var mobile = $('.mobile').val();
    var code = $('.code').val();
     var recommend = $('.recommend').val();
    $.ajax({
        type: "post",
        url: "/Home/Reg/reg",
        data: {
            token: token, username: username, password: password,
            name: name,mobile: mobile,code: code,recommend:recommend},
        dataType: 'json',
        async: false, //设置为同步操作就可以给全局变量赋值成功 
        success: function (data) {
            if (data.status == 1)
            {
                layer.msg(data.msg, {icon: 1, time: 1500}, function () {
                    location.href = data.url;
                    //location.replace(location.href);
                });

            } else
            {
                layer.msg(data.msg, {icon: 2, time: 1500}, function () {

                    location.replace(location.href);


                });
            }
        }
    });

}
function password_add() {
    layer.confirm('确定要提交？', function (index) {
        var token = $("input[name='token']").val();
        var towpassword = $(".towpassword").val();
        $.ajax({
            type: "post",
            url: "/Home/Member/userpassword",
            data: {towpassword: towpassword, token: token},
            dataType: 'json',
            async: false, //设置为同步操作就可以给全局变量赋值成功 
            success: function (data) {
                if (data.status == 1)
                {
                    layer.msg(data.msg, {icon: 1, time: 1500}, function () {

                        location.replace(location.href);
                    });

                } else
                {
                    layer.msg(data.msg, {icon: 2, time: 1500}, function () {

                        location.replace(location.href);


                    });
                }
            }
        });

    });
}

function codes()
{


    var mobile = $.trim($('.mobile').val());
    $.ajax({
        type: "post",
        url: "/Home/Reg/code",
        data: {mobile: mobile},
        dataType: 'json',
        async: false, //设置为同步操作就可以给全局变量赋值成功 
        success: function (data) {
            if (data.status == 1)
            {

                layer.msg(data.msg, {icon: 1, time: 1500}, function () {
                    // location.replace(location.href);
                });

            } else
            {
                layer.msg(data.msg, {icon: 2, time: 1500}, function () {
                    //location.replace(location.href);
                });
            }

        }
    });
}
function findpwdcode(mobile)
{


  
    $.ajax({
        type: "post",
        url: "/Home/Reg/findpwdcode",
        data: {mobile: mobile},
        dataType: 'json',
        async: false, //设置为同步操作就可以给全局变量赋值成功 
        success: function (data) {
            if (data.status == 1)
            {

                layer.msg(data.msg, {icon: 1, time: 1500}, function () {
                    // location.replace(location.href);
                });

            } else
            {
                layer.msg(data.msg, {icon: 2, time: 1500}, function () {
                    //location.replace(location.href);
                });
            }

        }
    });
}
function petpwd_save()
{
	var mobile=$.trim($('.mobile').val());
	var codes=$.trim($('.codes').val());
	var password=$.trim($('.password').val());
		$.ajax({ 
				type:"post", 
				url:"/Home/Reg/petpwd", 
				data: {mobile:mobile,codes:codes,password:password}, 
				dataType: 'json', 
				async : false,//设置为同步操作就可以给全局变量赋值成功 
				success:function(data){ 
				 if(data.status==1)
					{ 
					 
					 layer.msg(data.msg,{icon: 1,time:1500},function(){
						var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
						 parent.location.reload();
						 parent.layer.close(index); 
					 });     
						
					}
					else
					{
						 layer.msg(data.msg,{icon: 2,time:1500},function(){
							location.replace(location.href);
						 });  
					}
				 
				} 
			});
}
function touzi() {
    var token = $("input[name='token']").val();
    var money = $.trim($('.money').val());
    var type=$.trim($('.type').val());
    var towpassword = $.trim($('.towpassword').val());

    $.ajax({
        type: "post",
        url: "/Home/Report/touzi",
        data: {money: money, towpassword: towpassword, token: token,type:type},
        dataType: 'json',
        async: false, //设置为同步操作就可以给全局变量赋值成功 
        success: function (data) {
            if (data.status == 1)
            {

                layer.msg(data.msg, {icon: 1, time: 1500}, function () {
                    location.replace(location.href);
                });

            } else
            {
                layer.msg(data.msg, {icon: 2, time: 1500}, function () {
                    location.replace(location.href);
                });
            }

        }
    });

}

function tixian() {
    var token = $("input[name='token']").val();
    var money = $.trim($('.money').val());
    var type = $.trim($('.type').val());
    var banktype = $.trim($('.banktype').val());
    layer.confirm('确认要提现？', function (index) {
        $.ajax({
            type: "post",
            url: "/Home/Report/reminbitixian",
            data: {money: money, type: type, token: token,banktype:banktype},
            dataType: 'json',
            async: false, //设置为同步操作就可以给全局变量赋值成功 
            success: function (data) {
                if (data.status == 1)
                {

                    layer.msg(data.msg, {icon: 1, time: 1500}, function () {
                        location.replace(location.href);
                    });

                } else
                {
                    layer.msg(data.msg, {icon: 2, time: 1500}, function () {
                        location.replace(location.href);
                    });
                }

            }
        });
    });

}


function chongzhi() {
    var token = $("input[name='token']").val();
    var money = $.trim($('.money').val());
    var bankapliyno = $.trim($('.bankapliyno').val());
    var bankapliyname = $.trim($('.bankapliyname').val());
    var bank = $.trim($('.bank').val());

    $.ajax({
        type: "post",
        url: "/Home/Report/renminbichongzhi",
        data: {money: money, token: token, bank: bank,bankapliyname:bankapliyname,bankapliyno:bankapliyno},
        dataType: 'json',
        async: false, //设置为同步操作就可以给全局变量赋值成功 
        success: function (data) {
            if (data.status == 1)
            {

                layer.msg(data.msg, {icon: 1, time: 1500}, function () {
                    location.replace(location.href);
                });

            } else
            {
                layer.msg(data.msg, {icon: 2, time: 1500}, function () {
                    location.replace(location.href);
                });
            }

        }
    });

}
function message() {
    var token = $("input[name='token']").val();
    var subject = $.trim($('.subject').val());
    var content = $.trim($('.content').val());

    $.ajax({
        type: "post",
        url: "/Home/Message/messageadd",
        data: {subject: subject, content: content, token: token},
        dataType: 'json',
        async: false, //设置为同步操作就可以给全局变量赋值成功 
        success: function (data) {
            if (data.status == 1)
            {

                layer.msg(data.msg, {icon: 1, time: 1500}, function () {
                    location.replace(location.href);
                });

            } else
            {
                layer.msg(data.msg, {icon: 2, time: 1500}, function () {
                    location.replace(location.href);
                });
            }

        }
    });

}
